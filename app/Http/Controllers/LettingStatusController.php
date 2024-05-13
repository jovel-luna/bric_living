<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LettingStatus;
use Illuminate\Support\Facades\DB;
use Auth;
class LettingStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $isExist = LettingStatus::where('letting_status_name', '=', $request['letting_status_name'])
            ->first();
            if($isExist){
                return [
                    "status" => 0,
                    "message" => 'Name already exist'
                ];
            }else{
                $letting_statuses = LettingStatus::create([
                    'letting_status_name' => $request['letting_status_name'], 
                ]);

                $data = LettingStatus::all();
                return [
                    "status" => 1,
                    "data" => $data,
                    "message" => 'Success'
                ];
            }
            
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
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
}
