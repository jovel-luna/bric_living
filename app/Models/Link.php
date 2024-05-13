<?php

namespace App\Models;

use App\ActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'path',
        'type',
        'attachment_type',
    ];

    public function storeLink($request){
        $userID = Auth::user()->id;

        $links = new Link();
        $links->property_id = $request['formData']['pid'];
        $links->name = $request['formData']['url_name'];
        $links->path = $request['formData']['url_link'];
        $links->type = $request['formData']['type'];
        $links->attachment_type = '3D';
        $links->save();

        // save activity log here
        insertActivityLog($userID, 'Added entry Link to 3D', 'Lettings Gallery Tab');

        $links = Link::find($links->id);
        return $links;
    }
    public function removeLink($id){
        $userID = Auth::user()->id;

        $links = Link::where('id', '=', $id)->delete();

        // save activity log here
        insertActivityLog($userID, 'Removed an entry on Link to 3D', 'Lettings Gallery Tab');

        return $links;
    }
}
