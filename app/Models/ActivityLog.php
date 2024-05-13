<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'location'
    ];

    public function getAllActivity(){

        $activity = DB::table('activity_logs')
        ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->select(
            'activity_logs.id AS id',
            'roles.role',
            DB::raw("CONCAT_WS(' ', users.first_name, users.middle_name, users.last_name) AS user_name"),
            'activity_logs.description',
            'activity_logs.location',
            'activity_logs.created_at',
        )->orderBy('created_at','desc')->get();

        return $activity;
    }
}
