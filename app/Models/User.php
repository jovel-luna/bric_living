<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use LogsActivity;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'username',
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'phone',
        'status',
        'email',
        'profile_image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected static $logName = 'User';
    protected static $logFillable = true;


    public function getDescriptionForEvent(string $eventName): string
    {
        return "User has been {$eventName} ";
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if($eventName == 'updated'){
            $activity->location = "User Edit Page";
        }
        if($eventName == 'created'){ 
            $activity->location = "Create User Page";
        }
        if($eventName == 'deleted') {
            $activity->location = "User Edit Page";
        }

    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }
    public function getUserAccounts($authid)
    {
        $users = DB::table('users')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->selectRaw('
                    users.id as id,
                    users.first_name,
                    users.middle_name,
                    users.last_name,
                    users.username,
                    users.email,
                    users.status,
                    roles.role
                ')
                ->where('users.id', '!=', $authid)
                ->get();
        
        return $users;
    }

    public function updateProfileImage($filePath, $id){
        DB::table('users')
        ->where('users.id', '=', $id)
        ->update([
            'users.profile_image' => $filePath,
        ]);


    }
}
