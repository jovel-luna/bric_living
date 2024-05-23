<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'postcode',
        'city',
        'area'
    ];


    public function import($data){
        foreach ($data[0] as $pck => $pcVal) {
            $location = new Location();
            $location->postcode = $pcVal[0];
            $location->area = $pcVal[1];
            $location->city = $pcVal[2];
            $location->save();
        }
        return true;
    }
}
