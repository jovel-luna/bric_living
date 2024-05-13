<ul class="nav nav-tabs" id="custom-sub-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="operations-info-tab" data-toggle="pill"
            href="#operations-info" role="tab" aria-controls="operations-info"
            aria-selected="true"><i class="fa-solid fa-circle-info"></i> Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="operations-documnet-tab" data-toggle="pill"
            href="#operations-document" role="tab" aria-controls="operations-document"
            aria-selected="false"><i class="fa-solid fa-file"></i> Documents</a>
    </li>
</ul>
<div class="tab-content" id="custom-tab-content">
    <div class="tab-pane fade active show" id="operations-info" role="tabpanel" aria-labelledby="operations-info-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('Utilities and Services') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <label class="col-form-label document-label">Gas</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Provider</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['gas_provider'] != null ? $data['operation_utility']['gas_provider'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Contract Start Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['gas_contract_start_date'] != null ? $data['operation_utility']['gas_contract_start_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Contract End Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['gas_contract_end_date'] != null ? $data['operation_utility']['gas_contract_end_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Account No.</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['gas_account_number'] != null ? $data['operation_utility']['gas_account_number'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-form-label document-label">Electric</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Provider</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['electric_provider'] != null ? $data['operation_utility']['electric_provider'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Contract Start Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['electric_contract_start_date'] != null ? $data['operation_utility']['electric_contract_start_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Contract End Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['electric_contract_end_date'] != null ? $data['operation_utility']['electric_contract_end_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Account No.</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['electric_account_number'] != null ? $data['operation_utility']['electric_account_number'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-form-label document-label">Water</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Provider</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['water_provider'] != null ? $data['operation_utility']['water_provider'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Account No.</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['water_account_number'] != null ? $data['operation_utility']['water_account_number'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-form-label document-label">TV</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>TV Licence</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ ($data['operation_utility']['tv_licence'] == 1) ? 'Yes' : (($data['operation_utility']['tv_licence'] == 0) ? 'No' : 'N/A') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Contract Start Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['tv_licence_contract_start_date'] != null ? $data['operation_utility']['tv_licence_contract_start_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Contract End Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['tv_licence_contract_end_date'] != null ? $data['operation_utility']['tv_licence_contract_end_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-form-label document-label">Broadband</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Provider</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['broadband_provider'] != null ? $data['operation_utility']['broadband_provider'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Account No.</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['broadband_account_number'] != null ? $data['operation_utility']['broadband_account_number'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-form-label document-label">Property Insurance</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Provider</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['insurance_provider'] != null ? $data['operation_utility']['insurance_provider'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Insurance Start Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['insurance_start_date'] != null ? $data['operation_utility']['insurance_start_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Insurance End Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['insurance_end_date'] != null ? $data['operation_utility']['insurance_end_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Policy No.</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['insurance_policy_no'] != null ? $data['operation_utility']['insurance_policy_no'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-form-label document-label">Council tax</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Account No.</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['council_account_no'] != null ? $data['operation_utility']['council_account_no'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Exempt.</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ ($data['operation_utility']['exempt'] == 1) ? 'Yes' : (($data['operation_utility']['tv_licence'] == 0) ? 'No' : 'N/A') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Exemption Applied for.</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ $data['operation_utility']['exemption_date'] != null ? $data['operation_utility']['exemption_date'] : 'N/A'; }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-form-label document-label">Log</label>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <p><strong>Operation Log.</strong></p>
                            </div>
                            <div class="col-md-9">
                                {{-- @if($data['operation_utility']['operation_log'] != null)
                                    <textarea class="form-control" rows="5" readonly>{{$data['operation_utility']['operation_log']}}</textarea>
                                @else
                                    N/A
                                @endif --}}
                                <div class="d-flex gap-1">
                                    <div>
                                        <a href="#" type="button" data-id="{{ $data['id'] }}" data-logtype="operations" class="btn btn-success btn-xs mb-1 add-logs" data-toggle="modal" data-target="#addLogs">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 5l0 14"></path>
                                                <path d="M5 12l14 0"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#" type="button" data-id="{{ $data['id'] }}" data-logtype="operations" class="btn btn-info btn-xs view-logs">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                                                <path d="M9 7l6 0"></path>
                                                <path d="M9 11l6 0"></path>
                                                <path d="M9 15l4 0"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Budget') }}</h6>
                    <a href="{{ url('operations/budget/'. $pid) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-1"><i class="fas fa-plus fa-sm text-white-50"></i>
                        New
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <?php
                    if (sizeof($data['operation_budget']) != 0) { ?>
                    <div class="card card-secondary shadow card-outline card-outline-tabs mb-0">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                @foreach($data['operation_budget'] as $bKey => $budget)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $bKey == 0 ? 'active' : '' }}" id="{{str_replace('/','-',$budget['budget_year'])}}-tab" data-toggle="pill" href="#tab-{{str_replace('/','-',$budget['budget_year'])}}" role="tab" aria-controls="{{str_replace('/','-',$budget['budget_year'])}}" aria-selected="{{ $bKey == 0 ? 'true' : 'false' }}">{{$budget['budget_year']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                @foreach($data['operation_budget'] as $bKey => $budget)
                                    <div class="tab-pane fade {{ $bKey == 0 ? 'show active' : '' }}" id="tab-{{str_replace('/','-',$budget['budget_year'])}}" role="tabpanel" aria-labelledby="{{str_replace('/','-',$budget['budget_year'])}}-tab">
                                        <!-- <div class="row mb-3">
                                            <div class="edit-btn-cont text-end">
                                                <a id="details-edit" href="#" data-id="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm edit-btn"><i class="fas fa-edit fa-sm text-white-50"></i>
                                                    EDIT
                                                </a>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>HMO Licence Fee</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['hmo_licence_fee']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>HMO Licence Period</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['hmo_licence_period']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>HMO Fee per year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['hmo_fee_per_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Maintenance/property/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['maintenance_property_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Maintenance/bed/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['maintenance_bed_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Gas/property/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['gas_property_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Gas/bed/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['gas_bed_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Electricity/property/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['electric_property_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Electricity/bed/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['electric_bed_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Water/proprty/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['water_property_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Water/bed/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['water_bed_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Internet/property/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['internet_property_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Internet/bed/year</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['internet_bed_year']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>TV Licence per house</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['tv_licence_per_house']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Property Insurance Annual Cost</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['property_insurance_annual_cost']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p><strong>Total OPEX Budget</strong></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{$budget['total_opex_budget']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                <?php } else{ ?>
                    <div class="no-result">No Current Data</div>
                <?php }
                ?>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Expenditure') }}</h6>
                    <a href="{{ url('operations/expenditure/'. $pid) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-1"><i class="fas fa-plus fa-sm text-white-50"></i>
                        New
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <?php
                    if (sizeof($data['operation_expenditure']) != 0) { ?>
                        <div class="card card-secondary shadow card-outline card-outline-tabs mb-0">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    @foreach($data['operation_expenditure'] as $eKey => $expenditure)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $eKey == 0 ? 'active' : '' }}" id="{{str_replace('/','-',$budget['expenditure_year'])}}-tab" data-toggle="pill" href="#tab-{{str_replace('/','-',$budget['expenditure_year'])}}" role="tab" aria-controls="{{str_replace('/','-',$budget['expenditure_year'])}}" aria-selected="{{ $eKey == 0 ? 'true' : 'false' }}">{{$expenditure['expenditure_year']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    @foreach($data['operation_expenditure'] as $eKey => $expenditure)
                                        <div class="tab-pane fade {{ $eKey == 0 ? 'show active' : '' }}" id="tab-{{str_replace('/','-',$budget['expenditure_year'])}}" role="tabpanel" aria-labelledby="{{str_replace('/','-',$budget['expenditure_year'])}}-tab">
                                            <!-- <div class="row mb-3">
                                                <div class="edit-btn-cont text-end">
                                                    <a id="details-edit" href="#" data-id="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm edit-btn"><i class="fas fa-edit fa-sm text-white-50"></i>
                                                        EDIT
                                                    </a>
                                                </div>
                                            </div> -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>HMO Licence Fee</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['hmo_licence_fee']}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>HMO Licence Period</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['hmo_licence_period']}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>HMO Fee per year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['hmo_fee_per_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Maintenance/property/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['maintenance_property_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Maintenance/bed/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['maintenance_bed_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Gas/property/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['gas_property_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Gas/bed/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['gas_bed_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Electricity/property/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['electric_property_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Electricity/bed/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['electric_bed_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Water/proprty/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['water_property_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Water/bed/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['water_bed_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Internet/property/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['internet_property_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Internet/bed/year</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['internet_bed_year']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>TV Licence per house</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['tv_licence_per_house']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Property Insurance Annual Cost</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['property_insurance_annual_cost']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p><strong>Total OPEX Budget</strong></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            {{$expenditure['total_opex_budget']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    <?php } else{ ?>
                        <div class="no-result">No Current Data</div>
                    <?php }
                ?>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="operations-document" role="tabpanel" aria-labelledby="operations-document-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Operations Files') }}</h6>
                    <div class="col">
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <div class="loading-container hide col p-0 text-end">
                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                            </div>
                            <button type="button" class="addFileModalBtn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addFileModal" data-cat="operations">
                                <i class="fas fa-plus"></i>
                                Add File
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table id="operations-documents-table" class="table documents-table table-striped m-0" style="width: 100%;">
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
</div>