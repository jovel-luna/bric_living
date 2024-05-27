<?php

namespace App\Models;

use App\ActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Note extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'property_id',
        'user_id',
        'type',
        'description',
    ];
    public function saveNotes($request){
        $userID = Auth::user()->id;

        $notes = new Note();
        $notes->property_id = $request['formData']['nid'];
        $notes->user_id = $userID;
        $notes->type = $request['formData']['type'];
        $notes->description = $request['formData']['note_details'];
        $notes->save();

        // save activity log here
        $id = insertActivityLog($userID, 'Added note on Lettings page', 'Lettings List Page', 'CREATE');

        DB::table('detailed_activity_logs')->insert([
            [ 'log_id' => $id , 'activity_field' => 'Property', 'details' => $request['formData']['nid'] ],
            [ 'log_id' => $id , 'activity_field' => 'Note Type', 'details' => $request['formData']['type'] ],
            [ 'log_id' => $id , 'activity_field' => 'Note Description', 'details' => $request['formData']['note_details'] ],
        ]);

        return $notes;
    }
    public function getNotes($request){
        $notes = DB::table('notes')
        ->leftJoin('users','notes.user_id', '=', 'users.id')
        ->selectRaw("users.first_name, users.middle_name, users.last_name, notes.*")
        ->where('notes.property_id', $request['nid']);
        if ($request['type']) {
            $notes = $notes->where(function($t) use ($request) {
                $t->orWhere('notes.type', '=', $request['type']);
            }); 
        }
        $notes = $notes->orderBy('id', 'DESC')->get();
        return $notes;
    }
    public function getSingleNotes($request, $id){
        $notes = DB::table('notes')
        ->leftJoin('users','notes.user_id', '=', 'users.id')
        ->selectRaw("users.first_name, users.middle_name, users.last_name, notes.*")
        ->where('notes.id', $id)->first();
        return $notes;
    }
    public function updateNotes($request, $id){
        $userID = Auth::user()->id;

        // $notes = DB::table('notes')
        // ->where('notes.id', $id)
        // ->update([
        //     'user_id' => $userID,
        //     'description' => $request['formData']['update_note_details']
        // ])->touch();

        $notes = Note::find($id);
        $notes->user_id = $userID;
        $notes->description = $request['formData']['update_note_details'];
        $notes->save();
        $notes->touch();


        $notes = DB::table('notes')
        ->leftJoin('users','notes.user_id', '=', 'users.id')
        ->selectRaw("users.first_name,' ',users.middle_name,' ',users.last_name ,notes.*")
        ->where('notes.id', $id)->first();
        return $notes;
    }
    public function removeNotes($id){
        $notes = Note::where('id', '=', $id)->delete();
        return $notes;
    }
    
}
