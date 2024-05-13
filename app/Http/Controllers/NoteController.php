<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class NoteController extends Controller
{
    public function createNotes(Request $request){
        try {
            $notes = Note::saveNotes($request);
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
    public function getNotes(Request $request){
        try {
            $notes = Note::getNotes($request);
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
    public function getSingleNotes(Request $request, $id){
        try {
            $notes = Note::getSingleNotes($request, $id);
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
    public function updateNotes(Request $request, $id){
        if ($request->ajax()) {            
            try {
                $notes = Note::updateNotes($request, $id);
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
    public function removeNotes(Request $request, $id){
        if ($request->ajax()) {            
            try {
                $notes = Note::removeNotes($id);
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
