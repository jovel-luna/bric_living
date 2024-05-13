<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use DataTables;
use Validator;
use Auth;

class SystemSettingController extends Controller
{
    public function updateSystemLogo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'system_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validation->passes()){
            $folderPath = 'system';
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }
            
            $file = $request->file('system_logo');
            $fileName = 'system_logo.'.pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filePath  = $file->storeAs($folderPath, $fileName, 'public');

            $logoPath = 'storage/'.$filePath;
            $systemLogo = SystemSetting::updateLogoImage($logoPath, 1);
            
            return [
                "status" => 1,
                "data" => 'Success',
                "logo" => $logoPath,
            ];
            
        }
    }
}
