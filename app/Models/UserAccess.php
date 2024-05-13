<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAccess extends Model
{
    use HasFactory;

    public function checkAccess($type)
    {
        $userid = Auth::user()->id;
        $access = DB::table('user_accesses')
            ->select($type)
            ->where('user_accesses.user_id', '=', $userid)
            ->first();
        return json_encode($access->$type == 1 ? true : false);
    }
}
