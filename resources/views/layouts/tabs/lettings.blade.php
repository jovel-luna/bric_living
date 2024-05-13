<?php
    $calcTAR = 0;
    $calcAAR = 0;
    if ($data['letting']['target_weekly_rent']) {
        $twrAmount = $data['letting']['target_weekly_rent'];
        $twrNumber = str_replace(',', '', $twrAmount);
        $calcTAR = intval($twrNumber) * 52;
    }
    if ($data['letting']['achieved_weekly_rent']) {
        $awrAmount = $data['letting']['achieved_weekly_rent'];
        $awrNumber = str_replace(',', '', $awrAmount);
        $calcAAR = intval($awrNumber) * 52;
    }
?>

<ul class="nav nav-tabs" id="custom-sub-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="lettings-info-tab" data-toggle="pill"
            href="#lettings-info" role="tab" aria-controls="lettings-info"
            aria-selected="true"><i class="fa-solid fa-circle-info"></i> Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="lettings-contract-tab" data-toggle="pill"
            href="#lettings-contract" role="tab" aria-controls="lettings-contract"
            aria-selected="true"><i class="fa-solid fa-file-contract"></i> Contract Status</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="lettings-documnet-tab" data-toggle="pill"
            href="#lettings-document" role="tab" aria-controls="lettings-document"
            aria-selected="false"><i class="fa-solid fa-file"></i> Documents</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="lettings-gallery-tab" data-toggle="pill"
            href="#lettings-gallery" role="tab" aria-controls="lettings-gallery"
            aria-selected="false"><i class="fa-solid fa-photo-film"></i> Gallery</a>
    </li>
</ul>
<div class="tab-content" id="custom-tab-content">
    <div class="tab-pane fade active show" id="lettings-info" role="tabpanel" aria-labelledby="lettings-info-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Lettings Details') }}</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center gy-2">
                    <div class="col-md-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <strong>Floorplan:</strong>
                            </div>
                            <div class="col-md-6">
                                <span class="info-floorplan">
                                    @if(count($data['gallery']['floorplan']))
                                        <a class="popup-link" href="{{ url($data['gallery']['floorplan'][0]['path']) }}">
                                            <img width="30" height="30" src="{{ url($data['gallery']['floorplan'][0]['path']) }}" alt="Floorplan" style="border: 1px solid #c3c3c3;">
                                        </a>
                                        {{-- <a href="#" class="edit icon ml-2 change-floorplan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </a> --}}
                                    @else
                                        N/A
                                        {{-- <input type="file" id="floorplan" class="d-none" />
                                        <a href="#" class="add icon add-floorplan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M15 8h.01"></path>
                                                <path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5"></path>
                                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4"></path>
                                                <path d="M14 14l1 -1c.67 -.644 1.45 -.824 2.182 -.54"></path>
                                                <path d="M16 19h6"></path>
                                                <path d="M19 16v6"></path>
                                            </svg>
                                        </a> --}}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <strong>Date of Refurb:</strong>
                            </div>
                            <div class="col-md-6">
                                @if(hasAccess('lettings_table_edit') === 'true')
                                    <input id="date_of_refurb" type="text" class="form-control has-datepicker text-center" name="date_of_refurb" placeholder="dd-mm-yyyy" value="{{$data['letting']['date_of_refurb']}}" style="height: 30px; padding: 0;">
                                @else
                                    <span class="date_of_refurb">{{$data['letting']['date_of_refurb'] ? $data['letting']['date_of_refurb'] : 'N/A'}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <strong>Tvs</strong>
                            </div>
                            <div class="col-md-6">
                                @if(hasAccess('lettings_table_edit') === 'true')
                                    <select name="tv" id="tv" class="form-control text-center" required="required" style="height: 30px; padding: 0;">
                                        <option value="">Please Select</option>
                                        <option value="1" {{ $data['letting']['tv'] == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $data['letting']['tv'] == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                @else
                                    <span class="tv">{{$data['letting']['tv'] ? $data['letting']['tv'] : 'N/A'}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Lettings Finance') }}</h6>
                    <!-- <button type="button" id="save-letting-details" class="save-btn d-flex align-items-middle gap-1 btn btn-sm btn-primary shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                        </svg>
                        Save
                    </button> -->
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Target Weekly Rent:</strong>
                                </div>
                                <div class="col-md-6">
                                    @if(hasAccess('lettings_table_edit') === 'true')
                                        <input type="text" id="target_weekly_rent" name="target_weekly_rent" class="form-control text-center" onkeyup="formatNumber(this.id)" value="{{$data['letting']['target_weekly_rent']}}" placeholder="Enter amount" style="height: 30px; padding: 0;">
                                    @else
                                        <span class="target_weekly_rent">{{$data['letting']['target_weekly_rent'] ? $data['letting']['target_weekly_rent'] : 'N/A'}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Target Monthly Rent:</strong>
                                </div>
                                <div class="col-md-6">
                                    @if($data['letting']['target_weekly_rent'])
                                        <span class="target_monthly_rent">{{ number_format(($calcTAR/12), 2, '.', ',') }}</span>
                                    @else
                                        <span class="target_monthly_rent">N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Target Quarterly Rent:</strong>
                                </div>
                                <div class="col-md-6">
                                    @if($data['letting']['target_weekly_rent'])
                                        <span class="target_quarterly_rent">{{ number_format(($calcTAR/4), 2, '.', ',') }}</span>
                                    @else
                                        <span class="target_quarterly_rent">N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Target Annual Rent:</strong>
                                </div>
                                <div class="col-md-6">
                                    @if($data['letting']['target_weekly_rent'])
                                        <span class="target_annual_rent">{{ number_format($calcTAR, 2, '.', ',') }}</span>
                                    @else
                                        <span class="target_annual_rent">N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Achieved Weekly Rent:</strong>
                                </div>
                                <div class="col-md-6">
                                    @if(hasAccess('lettings_table_edit') === 'true')
                                        <input type="text" id="achieved_weekly_rent" name="achieved_weekly_rent" class="form-control text-center" onkeyup="formatNumber(this.id)" value="{{$data['letting']['achieved_weekly_rent']}}" placeholder="Enter amount" style="height: 30px; padding: 0;">
                                    @else
                                        <span class="achieved_weekly_rent">{{$data['letting']['achieved_weekly_rent'] ? $data['letting']['achieved_weekly_rent'] : 'N/A' }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Achieved Monthly Rent:</strong>
                                </div>
                                <div class="col-md-6">
                                    @if($data['letting']['achieved_weekly_rent'])
                                        <span class="achieved_monthly_rent">{{ number_format(($calcAAR/12), 2, '.', ',') }}</span>
                                    @else
                                        <span class="achieved_monthly_rent">N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Achieved Quarterly Rent:</strong>
                                </div>
                                <div class="col-md-6">
                                    @if($data['letting']['achieved_weekly_rent'])
                                        <span class="achieved_quarterly_rent">{{ number_format(($calcAAR/4), 2, '.', ',') }}</span>
                                    @else
                                        <span class="achieved_quarterly_rent">N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <strong>Achieved Annual Rent:</strong>
                                </div>
                                <div class="col-md-6">
                                    @if($data['letting']['achieved_weekly_rent'])
                                        <span class="achieved_annual_rent">{{ number_format($calcAAR, 2, '.', ',') }}</span>
                                    @else
                                        <span class="achieved_annual_rent">N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="lettings-contract" role="tabpanel" aria-labelledby="lettings-contract-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('23/24') }}</h6>
                    <div class="col">
                        <div class="d-flex gap-3 justify-content-end align-items-center">
                            <div class="total-capacity col p-0 text-end">
                                <span><span class="no-of-tenants">{{ count($data['tenants']) }}</span>/6</span>
                            </div>
                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                <button type="button" class="btn btn-sm btn-primary shadow-sm add-tenant">
                                    <i class="fas fa-plus"></i>
                                    Add New Tenant
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="accordion"class="ct-accordion">
                    @if(count($data['tenants']) != 0)
                        @foreach($data['tenants'] as $t => $tenant)
                            <div data-id="{{$tenant['id']}}" class="col-md-12 accordion-item">
                                <div class="card card-{{$tenant['status'] == 1 ? 'success' : 'warning'}} card-outline mb-1">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse{{$tenant['id']}}" aria-expanded="false">
                                        <div class="card-header">
                                            <h6 class="card-title w-100">
                                                TENANT #{{$t + 1}} - <span class="tenant-name">{{$tenant['name']}}</span>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="collapse{{$tenant['id']}}" class="collapse" data-parent="#accordion" style="">
                                        <div class="card-body p-0">
                                            <table class="table table-striped m-0" data-id="{{$tenant['id']}}">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Name</td>
                                                        <td>
                                                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                                                <input type="text" class="form-control form-control-sm name" name="name" value="{{$tenant['name']}}" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;" placeholde="Enter name">
                                                            @else
                                                                {{$tenant['name']}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Source</td>
                                                        <td>
                                                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                                                <input type="text" class="form-control form-control-sm source" name="source" value="{{$tenant['source']}}" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;" placeholde="Enter source">
                                                            @else
                                                                {{$tenant['source'] ? $tenant['source']: 'N/A'}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Contract Status</td>
                                                        <td>
                                                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                                                <select class="form-control form-control-sm tenant_contract_status" name="tenant_contract_status" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">
                                                                    <option value="">Please Select</option>
                                                                    <option value="App Sent" {{$tenant['tenant_contract_status'] == 'App Sent' ? 'selected' : ''}}>App Sent</option>
                                                                    <option value="Contract Sent" {{$tenant['tenant_contract_status'] == 'Contract Sent' ? 'selected' : ''}}>Contract Sent</option>
                                                                    <option value="Contract Signed" {{$tenant['tenant_contract_status'] == 'Contract Signed' ? 'selected' : ''}}>Contract Signed</option>
                                                                    <option value="Pending Info" {{$tenant['tenant_contract_status'] == 'Pending Info' ? 'selected' : ''}}>Pending Info</option>
                                                                </select>
                                                            @else
                                                                {{$tenant['tenant_contract_status'] ? $tenant['tenant_contract_status']: 'N/A'}}
                                                            @endif
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>ID Certified</td>
                                                        <td>
                                                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                                                <select class="form-control form-control-sm id_certified" name="id_certified" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">
                                                                    <option value="">Please Select</option>
                                                                    <option value="1" {{$tenant['id_certified'] == 1 ? 'selected' : ''}}>Yes</option>
                                                                    <option value="0" {{$tenant['id_certified'] == 0 ? 'selected' : ''}}>No</option>
                                                                </select>
                                                            @else
                                                                {{$tenant['id_certified'] == 1 ? 'Yes': 'No'}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>POA's</td>
                                                        <td>
                                                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                                                <select class="form-control form-control-sm poa" name="poa" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">
                                                                    <option value="">Please Select</option>
                                                                    <option value="1" {{$tenant['poa'] == 1 ? 'selected' : ''}}>Yes</option>
                                                                    <option value="0" {{$tenant['poa'] == 0 ? 'selected' : ''}}>No</option>
                                                                </select>
                                                            @else
                                                                {{$tenant['poa'] == 1 ? 'Yes': 'No'}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Contract Notes</td>
                                                        <td>
                                                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                                                <button class="btn btn-success btn-xs add-tenant-notes"  data-id="{{$tenant['id']}}" data-toggle="modal" data-target="#addTenantNotes">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M12 5l0 14"></path>
                                                                        <path d="M5 12l14 0"></path>
                                                                    </svg>
                                                                </button>
                                                            @endif
                                                            <button class="btn btn-info btn-xs view-tenant-notes ml-1" data-id="{{$tenant['id']}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                                                                    <path d="M9 7l6 0"></path>
                                                                    <path d="M9 11l6 0"></path>
                                                                    <path d="M9 15l4 0"></path>
                                                                 </svg>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Deposits Paid</td>
                                                        <td>
                                                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                                                <select class="form-control form-control-sm deposits_paid" name="deposits_paid" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">
                                                                    <option value="">Please Select</option>
                                                                    <option value="1" {{$tenant['deposits_paid'] == '1' ? 'selected' : ''}}>Yes</option>
                                                                    <option value="0" {{$tenant['deposits_paid'] == '0' ? 'selected' : ''}}>No</option>
                                                                </select>
                                                            @else
                                                                {{$tenant['deposits_paid'] == '1' ? 'Yes': 'No'}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Complete Documents</td>
                                                        <td>
                                                            @if(hasAccess('lettings_table_edit') === 'true'? true: false)
                                                                <select class="form-control form-control-sm document_outstanding" name="document_outstanding" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">
                                                                    <option value="">Please Select</option>
                                                                    <option value="1" {{$tenant['document_outstanding'] == '1' ? 'selected' : ''}}>Yes</option>
                                                                    <option value="0" {{$tenant['document_outstanding'] == '0' ? 'selected' : ''}}>No</option>
                                                                </select>
                                                            @else
                                                                {{$tenant['document_outstanding'] == '1' ? 'Yes': 'No'}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <button class="btn btn-success btn-xs" title="Renew">
                                                                Renew
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h4 class="text-center">No Tenants Available</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="lettings-document" role="tabpanel" aria-labelledby="lettings-document-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Lettings Files') }}</h6>
                    <div class="col">
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <div class="loading-container hide col p-0 text-end">
                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                            </div>
                            <button type="button" class="addFileModalBtn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addFileModal" data-cat="lettings">
                                <i class="fas fa-plus"></i>
                                Add File
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table id="lettings-documents-table" class="table documents-table table-striped m-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date Added</th>
                            <th>File Name</th>
                            <th>File Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="lettings-gallery" role="tabpanel" aria-labelledby="lettings-gallery-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Link to 3D') }}</h6>
                </div>
            </div>
            <div class="card-body">
                <form id="form-links">
                    <div class="row align-items-center mb-3">
                        @csrf
                        <input type="hidden" id="pid" name="pid" value="{{$data['property']['id']}}">
                        <div class="col-md-3">
                            <input type="text" name="url_name" id="url_name" class="form-control" placeholder="Name" style="height: 30px;" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="url_link" id="url_link" class="form-control" placeholder="https://" style="height: 30px;" required>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                </form>
                <ul id="links" class="m-0">
                    @if(count($data['links']) != 0)
                        @foreach($data['links'] as $l => $link)
                            <li class="link-item">
                                <div class="d-flex gap-2">
                                    <a href="{{ $link['path'] }}" target="_blank" style="font-size: 15px!important;">{{ $link['name'] }}</a> 
                                    <span class="action-section d-flex gap-1 align-items-center">
                                        <span class="copy-link" style="color: #007bff;" title="Copy">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                                                <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                                             </svg>
                                        </span>
                                        <span data-id="{{ $link['id'] }}" class="remove-link" style="color: #ff0000;" title="Remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7l16 0"></path>
                                                <path d="M10 11l0 6"></path>
                                                <path d="M14 11l0 6"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                             </svg>
                                        </span>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <h5>No Links Available</h5>
                    @endif
                </ul>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Floorplan') }}</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="lettings-floorplan-parent d-flex gap-1">
                    @if(hasAccess('lettings_table_edit'))
                        @if(count($data['gallery']['floorplan']) == 0)
                            <div class="addNewToGallery">
                                <a type="button" href="#" class="addPropertyFloorplanModal" data-toggle="modal" data-target="#addPropertyFloorplanModal" data-cat="floorplan">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                        @endif
                    @endif
                    @if(count($data['gallery']['floorplan']) != 0)
                        @foreach($data['gallery']['floorplan'] as $fp => $floorplan)
                            <div class="img-item">
                                <a class="lettings-floorplan-img" href="{{url($floorplan['path'])}}">
                                    <img width="100" height="100" src="{{url($floorplan['path'])}}" data-filename="{{$floorplan['file_name']}}" alt="Image" style="border: 1px solid #c3c3c3;">
                                </a>
                                <a href="#" class="remove-file" data-id="{{$floorplan['id']}}" data-cat="floorplan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('download.file', $floorplan['id']) }}" class="download-file" data-cat="floorplan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 11l5 5l5 -5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Videos') }}</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="lettings-video-parent d-flex gap-1">
                    @if(hasAccess('lettings_table_edit'))
                        <div class="addNewToGallery">
                            <a type="button" href="#" class="addPropertyVideoModal" data-toggle="modal" data-target="#addPropertyVideoModal" data-cat="video">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                    @endif
                    @if(count($data['gallery']['video']) != 0)
                        @foreach($data['gallery']['video'] as $fp => $video)
                            <div class="img-item">
                                <a class="popup-player" href="{{url($video['path'])}}">
                                    <video width="100" height="100" src="{{url($video['path'])}}" data-filename="{{$video['file_name']}}" alt="Video"><i class="fa-regular fa-circle-play"></i></video>
                                </a>
                                <a href="#" class="remove-file" data-id="{{$video['id']}}" data-cat="video">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('download.file', $video['id']) }}" class="download-file" data-cat="video">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 11l5 5l5 -5"></path>
                                        <path d="M12 4l0 12"></path>
                                     </svg>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Photos') }}</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="lettings-gallery-parent d-flex gap-1">
                    @if(hasAccess('lettings_table_edit'))
                        <div class="addNewToGallery">
                            <a type="button" href="#" class="addPropertyPhotoModal" data-toggle="modal" data-target="#addPropertyPhotoModal" data-cat="photo">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                    @endif
                    @if(count($data['gallery']['photo']) != 0)
                        @foreach($data['gallery']['photo'] as $p => $photo)
                            <div class="img-item">
                                <a class="lettings-gallery-img" href="{{url($photo['path'])}}">
                                    <img width="100" height="100" src="{{url($photo['path'])}}" data-filename="{{$photo['file_name']}}" alt="Image" style="border: 1px solid #c3c3c3;">
                                </a>
                                <a href="#" class="remove-file" data-id="{{$photo['id']}}" data-cat="photo">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('download.file', ['id' => $photo['id'], 'type' => 'Photo', 'filename' => $photo['file_name']]) }}" class="download-file" data-cat="photo">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 11l5 5l5 -5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>