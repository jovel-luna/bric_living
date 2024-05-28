<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
use Auth;
use Illuminate\Support\Facades\Log;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'source',
        'tenant_contract_status',
        'id_certified',
        'poa',
        'deposits_paid',
        'document_outstanding'
    ];

    public function storeTenant($request){
        $id_certified;
        $poa;
        $deposits_paid;
        $document_outstanding;


        $tenants = new Tenant();
        $property = Property::where('id', $request['formData']['pid'])->first();
        $tenants->property_id = $request['formData']['pid'];
        $tenants->name = $request['formData']['name'];
        $tenants->source = $request['formData']['source'];
        $tenants->tenant_contract_status = $request['formData']['tenant_contract_status'];
        if ($request['formData']['id_certified'] != null) {
            $tenants->id_certified = $request['formData']['id_certified'];
        }
        if ($request['formData']['poa'] != null) {
            $tenants->poa = $request['formData']['poa'];
        }
        if ($request['formData']['deposits_paid'] != null) {
            $tenants->deposits_paid = $request['formData']['deposits_paid'];
        }
        if ($request['formData']['document_outstanding'] != null) {
            $tenants->document_outstanding = $request['formData']['document_outstanding'];
        }
        $tenants->save();
        $tenants = Tenant::find($tenants->id);

        if ($tenants['tenant_contract_status'] == 'Signed' && $tenants['id_certified'] == 1 && $tenants['poa'] == 1 && $tenants['deposits_paid'] == '1' && $tenants['document_outstanding'] == '1') {
            $tenants['status'] = 1;
        }else{
            $tenants['status'] = 0;
        }

        if($request['formData']['id_certified'] == 1) {
            $id_certified = 'Yes';
        }
        else {
            $id_certified  = 'No';
        }
        if($request['formData']['poa'] == 1) {
            $poa = 'Yes';
        }
        else {
            $poa = 'No';
        }
        if($request['formData']['deposits_paid'] == 1) {
            $deposits_paid = 'Yes';
        }
        else {
            $deposits_paid = 'No';
        }
        if($request['formData']['document_outstanding'] == 1) {
            $document_outstanding = 'Yes';
        }
        else {
            $document_outstanding = 'No';
        }


        $activity = insertActivityLog(Auth::user()->id, 'Added a new tenant on property '. $property->ref_no , 'Add new tenant section in property details page' , 'CREATE');
        DB::table('detailed_activity_logs')->insert([
            [ 'log_id' => $activity, 'activity_field' => 'Name', 'details' => $request['formData']['name']],
            [ 'log_id' => $activity, 'activity_field' => 'Source', 'details' => $request['formData']['source']],
            [ 'log_id' => $activity, 'activity_field' => 'Contract Status', 'details' => $request['formData']['tenant_contract_status']],

            [ 'log_id' => $activity, 'activity_field' => 'ID Certified', 'details' => $id_certified],
            [ 'log_id' => $activity, 'activity_field' => 'POA', 'details' => $poa],
            [ 'log_id' => $activity, 'activity_field' => 'Deposits Paid', 'details' => $deposits_paid],
            [ 'log_id' => $activity, 'activity_field' => 'Outstanding Documents', 'details' => $document_outstanding],
        ]);

        return $tenants;
    }
    public function updateTenant($request, $id){

        $tenants_old = DB::table('tenants')
        ->select($request['field'])
        ->where('id', $id)
        ->get();

        $old_value = $tenants_old->pluck($request['field']);

        $tenants = DB::table('tenants')
        ->where('id', $id)
        ->update([
            $request['field'] => $request['value']
        ]);

        $activity = insertActivityLog(Auth::user()->id, 'Updated a tenant' , 'Update tenant section in property details page' , 'UPDATE');
        DB::table('detailed_activity_logs')->insert([
            [ 'log_id' => $activity, 'activity_field' =>  $request['field'], 'details' => $request['value'], 'details_old' => $old_value[0]],
        
        ]);

        $tenants = $tenants = Tenant::find($id);
        
        if ($tenants) {
            if ($tenants->name != null && $tenants->source != null && $tenants->tenant_contract_status == "Contract Signed" && $tenants->id_certified != 0 && $tenants->deposits_paid != 0 && $tenants->document_outstanding != 0) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function import($data, $entitiy){
        foreach ($data[0] as $pck => $pcVal) {            
            $propertyID = DB::table('properties')->where('ref_no', $pcVal[0])->select('properties.id')->first();
            if ($propertyID) {
                // update contract status
                $tenants = new Tenant();
                $tenants->property_id = $propertyID->id;
                $tenants->name = $pcVal[1] ? $pcVal[1] : null;
                $tenants->source = $pcVal[2] ? $pcVal[2] : null;
                $tenants->tenant_contract_status = $pcVal[3] === 'Yes' ? 1 : 0;
                $tenants->id_certified = $pcVal[4] === 'Yes' ? 1 : 0;
                $tenants->poa = $pcVal[5] === 'Yes' ? 1 : 0;
                $tenants->deposits_paid = $pcVal[6] === 'Yes' ? 1 : 0;
                $tenants->document_outstanding = $pcVal[7] === 'Yes' ? 1 : 0;
                $tenants->save();
            }
        }

        return true;
    }
}
