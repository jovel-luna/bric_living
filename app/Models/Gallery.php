<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'propert_id',
        'path',
        'type',
        'attachment_type',
    ];

    public function uploadPropertyFloorplan($request){
        $uploadedFiles = [];
        $propertyPath = 'files/property_'.$request->id;
        if (!Storage::disk('public')->exists($propertyPath)) {
            Storage::disk('public')->makeDirectory($propertyPath);
        }
        $folderPath = 'files/property_'.$request->id.'/floorplan';
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }
        if ($request->hasFile('file')) {
            $files = $request->file('file');

            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath  = $file->storeAs($folderPath, $fileName, 'public');

                
                $file_no_ext = str_replace('-', ' ', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $fileNameFormat = preg_replace('/[^A-Za-z0-9. -]/', '', $file_no_ext);
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
                $floorplan = new Gallery();
                $floorplan->property_id = $request->id;
                $floorplan->path = "storage/".$filePath;
                $floorplan->file_name = ucwords($fileNameFormat);
                $floorplan->type = 'Floorplan';
                $floorplan->attachment_type = $fileType;
                $floorplan->save();

                $uploadedFiles[] = [
                    'id' => $floorplan->id,
                    'file-orig-name' => $file->getClientOriginalName(),
                    'file-name' => ucwords($fileNameFormat),
                    'file-path' => "storage/".$filePath,
                    'file-type' => $fileType,
                    'file-date' => date('d-m-Y', time()),
                ];
            }

            return $data = [
                'success' => true,
                'file_names' => $uploadedFiles
            ];
        }

        return $data = [
            'success' => true,
            'file_names' => $uploadedFiles
        ];
    }
    public function uploadPropertyVideo($request){
        $uploadedFiles = [];
        $propertyPath = 'files/property_'.$request->id;
        if (!Storage::disk('public')->exists($propertyPath)) {
            Storage::disk('public')->makeDirectory($propertyPath);
        }
        $folderPath = 'files/property_'.$request->id.'/video';
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }
        if ($request->hasFile('file')) {
            $files = $request->file('file');

            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath  = $file->storeAs($folderPath, $fileName, 'public');

                
                $file_no_ext = str_replace('-', ' ', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $fileNameFormat = preg_replace('/[^A-Za-z0-9. -]/', '', $file_no_ext);
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
                $floorplan = new Gallery();
                $floorplan->property_id = $request->id;
                $floorplan->path = "storage/".$filePath;
                $floorplan->file_name = ucwords($fileNameFormat);
                $floorplan->type = 'Video';
                $floorplan->attachment_type = $fileType;
                $floorplan->save();

                $uploadedFiles[] = [
                    'id' => $floorplan->id,
                    'file-orig-name' => $file->getClientOriginalName(),
                    'file-name' => ucwords($fileNameFormat),
                    'file-path' => "storage/".$filePath,
                    'file-type' => $fileType,
                    'file-date' => date('d-m-Y', time()),
                ];
            }

            return $data = [
                'success' => true,
                'file_names' => $uploadedFiles
            ];
        }

        return $data = [
            'success' => true,
            'file_names' => $uploadedFiles
        ];
    }
    public function uploadPropertyPhoto($request){
        $uploadedFiles = [];
        $propertyPath = 'files/property_'.$request->id;
        if (!Storage::disk('public')->exists($propertyPath)) {
            Storage::disk('public')->makeDirectory($propertyPath);
        }
        $folderPath = 'files/property_'.$request->id.'/photo';
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath  = $file->storeAs($folderPath, $fileName, 'public');

                
                $file_no_ext = str_replace('-', ' ', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $fileNameFormat = preg_replace('/[^A-Za-z0-9. -]/', '', $file_no_ext);
                $fileType = pathinfo($filePath, PATHINFO_EXTENSION);
                $floorplan = new Gallery();
                $floorplan->property_id = $request->id;
                $floorplan->path = "storage/".$filePath;
                $floorplan->file_name = ucwords($fileNameFormat);
                $floorplan->type = 'Photo';
                $floorplan->attachment_type = $fileType;
                $floorplan->save();

                $uploadedFiles[] = [
                    'id' => $floorplan->id,
                    'file-orig-name' => $file->getClientOriginalName(),
                    'file-name' => ucwords($fileNameFormat),
                    'file-path' => "storage/".$filePath,
                    'file-type' => $fileType,
                    'file-date' => date('d-m-Y', time()),
                ];
            }

            return $data = [
                'success' => true,
                'file_names' => $uploadedFiles
            ];
        }

        return $data = [
            'success' => true,
            'file_names' => $uploadedFiles
        ];
    }
}
