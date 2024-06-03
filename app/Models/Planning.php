<?php

namespace App\Models;

use App\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class Planning extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'bric_planning_ref_no',
        'date_submitted',
        'approved',
        'application_desc'
    ];
    protected static $logName = 'Planning';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "Planning has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "Planning Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create Planning Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "Planning Edit Page";
        }

    }


    public function getPlanning($id){
        $plannings = DB::table('plannings')->where('plannings.property_id', '=', $id)->get();
        return $plannings;
    }
    public function getSinglePlanning($id){
        $plannings = DB::table('plannings')->where('plannings.id', '=', $id)->get();
        return $plannings;
    }
    public function updatePlanning($data, $id){
        try {
            $plannings = DB::table('plannings')
            ->where('plannings.id', '=', $id)
            ->update([
                'plannings.bric_planning_ref_no' => $data->formData['bric_planning_ref_no'],
                'plannings.date_submitted' => $data->formData['date_submitted'],
                'plannings.approved' => $data->formData['approved'],
                'plannings.application_desc' => $data->formData['application_desc'],
            ]);
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
        return $plannings;
    }
}
