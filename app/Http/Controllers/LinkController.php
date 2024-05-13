<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class LinkController extends Controller
{
    public function storeLink(Request $request)
    {
        try {
            $links = Link::storeLink($request);
            return [
                "status" => 1,
                "data" => $links,
                "message" => 'Success'
            ];
        }  catch (\Throwable $th) { 
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }
    public function removeLink(Request $request)
    {
        try {
            $links = Link::removeLink($request->id);
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
}
