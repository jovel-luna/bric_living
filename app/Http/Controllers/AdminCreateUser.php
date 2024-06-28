<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminCreateUser extends Controller
{
    function create_user(Request $request) {
        Log::info('create user');
        Log::info($request);

        User::create([
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

        return redirect('/setting');
    }
}
