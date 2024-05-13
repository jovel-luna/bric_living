<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenantNote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TenantNoteController extends Controller
{
    public function createTenantNotes(Request $request){
        try {
            $notes = TenantNote::saveTenantNotes($request);
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
    public function getTenantNotes(Request $request){
        try {
            $notes = TenantNote::getTenantNotes($request);
            return [
                "status" => 1,
                "data" => $notes,
                "message" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }
    public function getSingleTenantNotes(Request $request, $id){
        try {
            $notes = TenantNote::getSingleTenantNotes($request, $id);
            return [
                "status" => 1,
                "data" => $notes,
                "message" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }
    public function updateTenantNotes(Request $request, $id){
        if ($request->ajax()) {            
            try {
                $notes = TenantNote::updateTenantNotes($request, $id);
                return response()->json([
                    'status' => 1,
                    'data' => $notes,
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
    public function removeTenantNotes(Request $request, $id){
        if ($request->ajax()) {            
            try {
                $notes = TenantNote::removeTenantNotes($id);
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
