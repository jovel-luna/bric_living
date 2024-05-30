<ul class="nav nav-tabs" id="custom-sub-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="acquisition-info-tab" data-toggle="pill"
            href="#acquisition-info" role="tab" aria-controls="acquisition-info"
            aria-selected="true"><i class="fa-solid fa-circle-info"></i> Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="acquisition-documnet-tab" data-toggle="pill"
            href="#acquisition-document" role="tab" aria-controls="acquisition-document"
            aria-selected="false"><i class="fa-solid fa-file"></i> Documents</a>
    </li>
</ul>
<div class="tab-content" id="custom-tab-content">
    <div class="tab-pane fade active show" id="acquisition-info" role="tabpanel" aria-labelledby="acquisition-info-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('ACQUISITION') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Acquisition Status:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['acquisition_status'] ? $data['acquisition']['acquisition_status'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Single Asset / Portfolio:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['single_asset_portfolio'] ? $data['acquisition']['single_asset_portfolio'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Portfolio:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['portfolio'] ? $data['acquisition']['portfolio'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Existing Bedroom No.:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['existing_bedroom_no'] ? $data['acquisition']['existing_bedroom_no'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Stamp Duty:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['stamp_duty'] ? $data['acquisition']['stamp_duty'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Agent:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['agent'] ? $data['acquisition']['agent'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Agent Fee % (excl. VAT):</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['agent_fee_percentage'] ? $data['acquisition']['agent_fee_percentage'] . '%' : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Agent £:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['agent_fee'] ? $data['acquisition']['agent_fee'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Estimated TPC:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['estimated_tpc'] ? $data['acquisition']['estimated_tpc'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Offer Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['offer_date'] ? $data['acquisition']['offer_date'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Target Completion Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['target_completion_date'] ? $data['acquisition']['target_completion_date'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Completion Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['completion_date'] ? $data['acquisition']['completion_date'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Purchase Financing Status:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['financing_status'] ? $data['acquisition']['financing_status'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('PLANNING') }}</h6>
                    <div class="col">
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <div class="loading-container hide col p-0 text-end">
                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                            </div>
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPlanningModal">
                                <i class="fas fa-plus"></i>
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>COL Status:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['col_status'] ? $data['acquisition']['col_status'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>COL Log:</strong></p>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex gap-1">
                                    <div>
                                        <a href="#" type="button" data-id="{{ $data['id'] }}" data-logtype="acquisition" class="btn btn-success btn-xs mb-1 add-logs" data-toggle="modal" data-target="#addLogs">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 5l0 14"></path>
                                                <path d="M5 12l14 0"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#" type="button" data-id="{{ $data['id'] }}" data-logtype="acquisition" class="btn btn-info btn-xs view-logs">
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
                <div class="card card-secondary shadow mb-0 p-0">
                    <div class="card-body p-0">
                        <table id="planning-table" class="table planning-table table-striped m-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Bric Planning Ref #</th>
                                    <th>Date Submitted</th>
                                    <th>Approved</th>
                                    <th>Application Description</th>
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
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('ACQUISITION FINANCE') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Asking £:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['asking_price'] ? $data['acquisition']['asking_price'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Offer £:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['offer_price'] ? $data['acquisition']['offer_price'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Agreed £:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['agreed_purchase_price'] ? $data['acquisition']['agreed_purchase_price'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Price Difference +/-:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['difference'] ? $data['acquisition']['difference'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Acquisition Cost £:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['acquisition_cost'] ? $data['acquisition']['acquisition_cost'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Equity Required:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['equity'] ? $data['acquisition']['equity'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Bridge Loan %:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['bridge_loan'] ? $data['acquisition']['bridge_loan'] . '%' : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Bridge Loan Status:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['bridge_loan_status'] ? $data['acquisition']['bridge_loan_status'] . '%' : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Estimated bridge loan period (months):</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['estimated_period'] ? $data['acquisition']['estimated_period'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Loan Interest Rate:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['loan_percentage'] ? $data['acquisition']['loan_percentage'] . '%' : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Estimated Interest £:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['estimated_interest'] ? $data['acquisition']['estimated_interest'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('CAPEX') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>CAPEX Budget:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['capex_budget'] ? $data['acquisition']['capex_budget'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('INVESTMENT') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Valuation Yield %:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['bric_purchase_yield_percentage'] ? $data['acquisition']['bric_purchase_yield_percentage'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>TPC / Bed Space:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['tpc_bedspace'] ? $data['acquisition']['tpc_bedspace'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Purchase Price / Bed Space:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['purchase_price_bedspace'] ? $data['acquisition']['purchase_price_bedspace'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Bric Y1 proposed rent PPPW:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['bric_y1_proposed_rent_pppw'] ? $data['acquisition']['bric_y1_proposed_rent_pppw'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Tenancy length (weeks):</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['tenancy_length_weeks'] ? $data['acquisition']['tenancy_length_weeks'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('LAND REGISTRY') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Tennure:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['tennure'] ? $data['acquisition']['tennure'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Ground Rent:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['ground_rent'] ? $data['acquisition']['ground_rent'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Grand Rent Due:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['acquisition']['ground_rent_due'] ? $data['acquisition']['ground_rent_due'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('INSURANCE') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Insurance in Place:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['operation_utility']['insurance_in_place'] == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Insurance Value:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['operation_utility']['insurance_value'] ? $data['operation_utility']['insurance_value'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Insurance Cost:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['operation_utility']['insurance_annual_cost'] ? $data['operation_utility']['insurance_annual_cost'] : 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Insurance Renewal Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['operation_utility']['insurance_renewal_date'] ? $data['operation_utility']['insurance_renewal_date'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="acquisition-document" role="tabpanel" aria-labelledby="acquisition-document-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Acquisition Files') }}</h6>
                    <div class="col">
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <div class="loading-container hide col p-0 text-end">
                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                            </div>
                            <button type="button" class="addFileModalBtn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addFileModal" data-cat="acquisition">
                                <i class="fas fa-plus"></i>
                                Add File
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table id="acquisition-documents-table" class="table documents-table table-striped m-0" style="width: 100%;">
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