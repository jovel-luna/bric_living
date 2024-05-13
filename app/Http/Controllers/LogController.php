<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class LogController extends Controller
{
    public function createLogs(Request $request){
        try {
            $notes = Log::saveLogs($request);
            return [
                "status" => 1,
                "message" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }
    public function getLogs(Request $request){
        try {
            $logs = Log::getLogs($request);
            return [
                "status" => 1,
                "data" => $logs,
                "message" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }
    public function getSingleLogs(Request $request, $id){
        try {
            $logs = Log::getSingleLogs($request, $id);
            return [
                "status" => 1,
                "data" => $logs,
                "message" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }
    public function updateLogs(Request $request, $id){
        if ($request->ajax()) {            
            try {
                $logs = Log::updateLogs($request, $id);
                return response()->json([
                    'status' => 1,
                    'data' => $logs,
                    'message' => 'Success'
                ]);
            }  catch (\Throwable $th) { 
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }
    public function removeLogs(Request $request, $id){
        if ($request->ajax()) {            
            try {
                $logs = Log::removeLogs($id);
                return response()->json([
                    'success' => 1,
                    'message' => 'Success'
                ]);
            }  catch (\Throwable $th) { 
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 200);
            }
        }
    }
}
