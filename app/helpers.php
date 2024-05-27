<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\UserAccess;
if (!function_exists('user_email')) {
    function user_email(){
        $user = Auth::user();

        return $user->email;
    }
}

if (!function_exists('role_list')) {
    function role_list(){
        $roles = DB::table('roles')
                 ->select('id', 'role')
                 ->get();
        return $roles;
    }
}

if (!function_exists('hasAccess')) {
    function hasAccess($type){
        if (Auth::check()) {
            $access = UserAccess::checkAccess($type);
            return $access;
        }else{
            return json_encode(false);
        }
    }
}

if (!function_exists('checkRole')) {
    function checkRole(){
        $userid = Auth::user()->id;
        $acquisition = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->selectRaw('roles.role')
            ->where('users.id', '=', $userid)
            ->first();                             
        return $acquisition->role;
    }
}
if (!function_exists('getSettings')) {
    function getSettings($type){
        $portalSettings = DB::table('system_settings')
                ->select('*')
                ->where('system_settings.id', '=', 1)
                ->first();
                
        switch ($type) {
            case 'portal-title':
                return $portalSettings->system_name;
                break;
            case 'portal-logo':
                return $portalSettings->system_logo;
                break;
        }                     
    }
}

if (!function_exists('insertActivityLog')) {
    function insertActivityLog($id, $description, $location, $type="Not Specified"){
        $log = new ActivityLog();
        $log->user_id = $id;
        $log->description = $description;
        $log->location = $location;
        $log->type = $type;
        $log->save();

        return $log->id; 
    }
}
if (!function_exists('format_date')) {
    function format_date($data){
        if ($data) {
            if (gettype($data) == 'double') {
                $dateFormat = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data)->format('d-m-Y');
            }else {
                $dateFormat = $data;
            }
        }else{
            $dateFormat = null;
        }

        return $dateFormat;
    }
}

if (!function_exists('number_abv')) {
    function number_abv($data){
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($data % 100) >= 11) && (($data%100) <= 13))
            return $data. 'th';
        else
            return $data. $ends[$data % 10];
    }
}

?>