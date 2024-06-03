<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class TenantNote extends Model
{
    use HasFactory;

    use LogsActivity;


    public $timestamps = true;
    protected $fillable = [
        'tenant_id',
        'user_id',
        'description',
    ];

    protected static $logName = 'Tenant Note';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Tenant Note has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Tenant Note Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Tenant Note Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Tenant Note Edit Page";
        }

    }


    public function saveTenantNotes($request){
        $userID = Auth::user()->id;

        $notes = new TenantNote();
        $notes->tenant_id = $request['formData']['tid'];
        $notes->user_id = $userID;
        $notes->description = $request['formData']['tenant_note_details'];
        $notes->save();

        // save activity log here
        insertActivityLog($userID, 'Added tenant notes', 'Lettings > Contract Status');
        
        return $notes;
    }
    public function getTenantNotes($request){
        $notes = DB::table('tenant_notes')
        ->leftJoin('users','tenant_notes.user_id', '=', 'users.id')
        ->selectRaw("users.first_name, users.middle_name, users.last_name, tenant_notes.*")
        ->where('tenant_notes.tenant_id', $request['tnid']);
        $notes = $notes->orderBy('id', 'DESC')->get();
        return $notes;
    }
    public function getSingleTenantNotes($request, $id){
        $notes = DB::table('tenant_notes')
        ->leftJoin('users','tenant_notes.user_id', '=', 'users.id')
        ->selectRaw("users.first_name, users.middle_name, users.last_name, tenant_notes.*")
        ->where('tenant_notes.id', $id)->first();
        return $notes;
    }
    public function updateTenantNotes($request, $id){
        $userID = Auth::user()->id;

        $notes = TenantNote::find($id);
        $notes->user_id = $userID;
        $notes->description = $request['formData']['update_tenant_note_details'];
        $notes->save();
        $notes->touch();


        $notes = DB::table('tenant_notes')
        ->leftJoin('users','tenant_notes.user_id', '=', 'users.id')
        ->selectRaw("users.first_name,' ',users.middle_name,' ',users.last_name ,tenant_notes.*")
        ->where('tenant_notes.id', $id)->first();
        return $notes;
    }
    public function removeTenantNotes($id){
        $notes = TenantNote::where('id', '=', $id)->delete();
        return $notes;
    }
}
