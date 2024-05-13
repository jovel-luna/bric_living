<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Models\Gallery;
use DataTables;
use File;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        // dd($request->type);
        // dd(public_path('files/uploads'));
        $uploadedFiles = [];
        $folderPath = 'files/property_'.$request->id;
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
                $documents = new Document();
                $documents->property_id = $request->id;
                $documents->type = $request->type;
                $documents->file_name = ucwords($fileNameFormat);
                $documents->file_path = "storage/".$filePath;
                $documents->file_type = $fileType;
                // $documents->file_type = Storage::disk('public')->mimeType($filePath);
                $documents->file_date = date('d-m-Y', time());
                $documents->save();

                $uploadedFiles[] = [
                    'file-orig-name' => $file->getClientOriginalName(),
                    'file-name' => ucwords($fileNameFormat),
                    'file-path' => "storage/".$filePath,
                    'file-type' => $fileType,
                    // 'file-type' => Storage::disk('public')->mimeType($filePath),
                    'file-date' => date('d-m-Y', time()),
                ];
            }

            return response()->json([
                'success' => true,
                'file_names' => $uploadedFiles
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Files not found.'
        ]);
    }

    public function uploadPropertyPhoto(Request $request)
    {
        $photo = Gallery::uploadPropertyPhoto($request);
        return response()->json($photo);
    }
    public function uploadPropertyVideo(Request $request)
    {
        $video = Gallery::uploadPropertyVideo($request);
        return response()->json($video);
    }
    public function uploadPropertyFloorplan(Request $request)
    {
        $floorplan = Gallery::uploadPropertyFloorplan($request);
        return response()->json($floorplan);
    }

    public function getDocument(Request $request)
    {
        if ($request->ajax()) {
            /* This is the query that is being used to get the data from the database. */
            $documents = Document::where('documents.property_id', '=', $request->id)
            ->where('documents.type', '=', $request->type)
            ->orderBy('documents.file_name', 'ASC');
            
            $documents = $documents->get();
            // dd($documents);
            /* This is the code that is being used to return the data to the datatable. */
            return Datatables::of($documents)
                    ->addIndexColumn()
                    ->make(true);
        }
    }
    public function removeDocument(Request $request, $id)
    {
        if ($request->ajax()) {
            $documentRemove = Document::where('id', '=', $id)->delete();
            return response()->json([
                'success' => 1,
                'message' => 'Success'
            ]);
        }
    }
    public function download($id)
    {
        $file = Gallery::where('id', $id)->select('path')->first();
        $path = public_path($file->path);
 
        return response()->download($path);
        
    }
    public function remove($id)
    {
        $file = Gallery::where('id', $id)->select('path')->first();
        $path = public_path($file->path);
        if(File::exists(public_path($file->path))){
            File::delete(public_path($file->path));
            Gallery::where('id', '=', $id)->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Success'
            ]);
        }else{
            return response()->json([
                'success' => 0,
                'message' => 'Failed'
            ]);
        }
        
    }
}


?>