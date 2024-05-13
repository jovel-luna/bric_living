<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LettingStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'letting_status_name',
    ];
}
