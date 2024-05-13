<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_logo',
        'system_name',
    ];

    public function updateLogoImage($logoPath, $id){
        DB::table('system_settings')
        ->where('system_settings.id', '=', $id)
        ->update([
            'system_settings.system_logo' => $logoPath,
        ]);
    }
}
