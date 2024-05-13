<?php

?>
<div class="modal fade" id="addTenant" tabindex="-1" role="dialog" aria-labelledby="addTenantTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-tenant" data-action="create">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTenantTitle">New Tenant</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="pid" name="pid" value="{{$data['property']['id']}}">
                    <!-- Name -->
                    <div class="mb-1">
                        <label for="col_status" class="col-form-label">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter tenant name">           
                    </div>
                    <!-- Source -->
                    <div class="mb-1">
                        <label for="col_status" class="col-form-label">{{ __('Source') }}</label>
                        <input type="text" id="source" name="source" class="form-control" placeholder="Enter source">           
                    </div>
                    <!-- Tenant Contract Status -->
                    <div class="mb-1">
                        <label for="col_status" class="col-form-label">{{ __('Tenant Contract Status') }}</label>
                        <select name="tenant_contract_status" id="tenant_contract_status" class="form-control form-control-alternative{{ $errors->has('tenant_contract_status') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="Pending Info">Pending Info</option>
                            <option value="App Sent">App Sent</option>
                            <option value="Contract Sent">Contract Sent</option>
                            <option value="Contract Signed">Contract Signed</option>
                        </select>            
                    </div>
                    <!-- ID Certified -->
                    <div class="mb-1">
                        <label for="col_status" class="col-form-label">{{ __('ID Certified') }}</label>
                        <select name="id_certified" id="id_certified" class="form-control form-control-alternative{{ $errors->has('id_certified') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>            
                    </div>
                    <!-- POA's -->
                    <div class="mb-1">
                        <label for="col_status" class="col-form-label">POA's</label>
                        <select name="poa" id="poa" class="form-control form-control-alternative{{ $errors->has('poa') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>            
                    </div>
                    <!-- Deposits Paid -->
                    <div class="mb-1">
                        <label for="col_status" class="col-form-label">{{ __('Deposits Paid') }}</label>
                        <select name="deposits_paid" id="deposits_paid" class="form-control form-control-alternative{{ $errors->has('deposits_paid') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>            
                    </div>
                    <!-- Document Outstanding -->
                    <div class="mb-1">
                        <label for="col_status" class="col-form-label">{{ __('Document Outstanding') }}</label>
                        <select name="document_outstanding" id="document_outstanding" class="form-control form-control-alternative{{ $errors->has('document_outstanding') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>            
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="save-tenant" type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>