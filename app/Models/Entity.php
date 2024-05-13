<?php

namespace App\Models;
use App\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_registration_number',
        'entity',
        'registered_address',
        'entity_date_created',
        'statement_due_date',
        'financial_year_start_date',
        'financial_year_end_date',
        // 'no_of_properties',
        // 'no_of_beds',
        // 'pipeline',
        // 'current_rent_role',
    ];

    public function properties(){
        return $this->belongsToMany(Property::class);
    }
    public function getEntities(){
        $entity = DB::table('entities')->select('entities.id as id','entity')->distinct()->orderBy('entity', 'asc')->get();
        return $entity;
    }
}
