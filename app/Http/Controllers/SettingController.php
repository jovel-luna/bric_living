<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Validator;
use Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $users = User::getUserAccounts(Auth::user()->id);

            // dd($users);

            return Datatables::of($users)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('setting.index');
    }

    public function updateUserProfileImage(Request $request, $id){
        $validation = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validation->passes()){
            $folderPath = 'profiles';
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }
            
            $file = $request->file('profile_image');
            $fileName = $id.'_'.Auth::user()->username.'.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filePath  = $file->storeAs($folderPath, $fileName, 'public');

            $profilePath = 'storage/'.$filePath;
            $userProfile = User::updateProfileImage($profilePath, $id);
            
            return [
                "status" => 1,
                "data" => 'Success',
                "profile" => $profilePath,
            ];
            
        }
    }
    public function updateUserInfo(Request $request, $id){
        if ($request->ajax()) {
            try {
                DB::table('users')
                ->where('users.id', '=', $id)
                ->update([
                    'users.first_name' => $request->formData['first_name'],
                    'users.middle_name' => $request->formData['middle_name'],
                    'users.last_name' => $request->formData['last_name'],
                    'users.address' => $request->formData['address'],
                    'users.phone' => $request->formData['phone'],
                ]);
    
                return [
                    "status" => 1,
                    "data" => 'Success',
                ];
            }  catch (\Throwable $th) { 
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }
    public function updateUserPassword(Request $request, $id){
        if ($request->ajax()) {
            try {
                $validator = Validator::make($request->all(),[
                    'current_password' => 'required',
                    'new_password' => 'required|min:8',
                    'confirm_new_password' => 'required|same:new_password',
                ]);
                
                if($validator->fails()){
                    return response()->json([
                        'success'=>false,
                        'errors'=>($validator->getMessageBag()->toArray()),
                    ],400);
                }
                $user = Auth::user();

                if (!Hash::check($request->input('current_password'), $user->password)) {
                    return response()->json([
                        "status" => false,
                        "data" => 'The current password is incorrect',
                    ]);
                }
        
                $user->update(['password' => Hash::make($request->input('new_password'))]);
        
                return response()->json([
                    "status" => 1,
                    "data" => 'Success',
                ]);
            }  catch (\Throwable $th) { 
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function setting(Request $request)
    {
        $data = [
            [
              "DT_RowId" => "row_1",
              "first_name" => "Tiger",
              "last_name" => "Nixon",
              "position" => "System Architect",
              "email" => "t.nixon@datatables.net",
              "office" => "Edinburgh",
              "extn" => "5421",
              "age" => "61",
              "salary" => "320800",
              "start_date" => "2011-04-25"
            ],
            [
              "DT_RowId" => "row_2",
              "first_name" => "Garrett",
              "last_name" => "Winters",
              "position" => "Accountant",
              "email" => "g.winters@datatables.net",
              "office" => "Tokyo",
              "extn" => "8422",
              "age" => "63",
              "salary" => "170750",
              "start_date" => "2011-07-25"
            ]
        ];
        dd(response()->json($data));
    }
}
