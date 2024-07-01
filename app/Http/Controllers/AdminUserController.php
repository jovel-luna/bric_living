<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    function create_user(Request $request) {

        $user = User::create([
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'status' => 1,
            'email' => $request['email'],
            'role_id' => 2,
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);

        UserAccess::create([
            'user_id' => $user->id,
            'can_import' => 1,
            'lettings_table_edit' => 1,
        ]);

        return redirect('/setting');
    }
    
    function delete_user($id) {

        $user = User::find($id);
        $user->delete();
        UserAccess::where('user_id' , $id)->delete();
        
        return redirect('/setting');
    }

    function reset_user_password($id) {

    }

    function edit_user($id) {

    }

    function set_user_permissions($id) {

    }
}
