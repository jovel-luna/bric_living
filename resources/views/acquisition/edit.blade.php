@extends('layouts.app', ['pageSlug' => 'acquisition-edit'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Acquisition</h1>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Acquisition View</li>
                </ol>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="d-sm-flex align-items-center justify-content-end mb-3 gap-2">
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                    </a>
                </div>
                <div class="card card-secondary shadow mb-4 p-0">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Edit Acquisition</h6>
                    </div>
                    <div class="card-body">
                        <!-- {{ route('get.update-acquisition', $data) }} -->
                        <form method="POST" id="acquisition-edit" autocomplete="off" enctype="multipart/form-data">
                            <!-- @method('PATCH') -->
                            @csrf
                            <!-- <h6 class="mb-3">Acquisition Info</h6> -->
                            <div class="card card-secondary shadow mb-4 p-0">
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold">{{ __('Acquisition Info') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="col-form-label document-label">{{ __('Acquisition') }}</label>
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <!-- Aquisition Status -->
                                                        <div class="mb-3">
                                                            
                                                            <input type="hidden" name="property_id" value="{{ $data->property_id }}">
                                                        
                                                            <label for="acquisition_status" class="col-form-label">{{ __('Acquisition Status') }}<span class="isRequired"> * </span></label>
                                                            <select name="acquisition_status" id="acquisition_status" class="form-control form-control-alternative{{ $errors->has('acquisition_status') ? ' is-invalid' : '' }}">
                                                                <option value="">Please Select</option>

                                                                @if(old('acquisition_status'))
                                                                @foreach($acquisition_status as $acquisition_status_key => $acquisition_status_val)
                                                                <option value="{{ $acquisition_status_key }}" {{ $acquisition_status_key === old('acquisition_status') ? 'selected' : '' }}>{{ $acquisition_status_val }}</option>
                                                                @endforeach
                                                                @else
                                                                @foreach($acquisition_status as $acquisition_status_key => $acquisition_status_val)
                                                                <option value="{{ $acquisition_status_key }}" {{ $acquisition_status_key === $data->acquisition_status ? 'selected' : '' }}>{{ $acquisition_status_val }}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>

                                                            <span class="invalid-feedback acquisition_status" role="alert"></span>
                                                        </div>
                                                        <!-- Single Asset or Portfolio -->
                                                        <div class="mb-3">
                                                            <label for="single_asset_portfolio" class="col-form-label">{{ __('Single Asset / Portfolio') }}<span class="isRequired"> * </span></label>
                                                            <select name="single_asset_portfolio" id="single_asset_portfolio" class="form-control form-control-alternative{{ $errors->has('single_asset_portfolio') ? ' is-invalid' : '' }}">
                                                                <option value="">Please Select</option>
                                                                @if(old('single_asset_portfolio'))
                                                                @foreach($single_asset_portfolio as $single_asset_portfolio_key => $single_asset_portfolio_val)
                                                                <option value="{{ $single_asset_portfolio_key }}" {{ $single_asset_portfolio_key === old('single_asset_portfolio') ? 'selected' : '' }}>{{ $single_asset_portfolio_val }}</option>
                                                                @endforeach
                                                                @else
                                                                @foreach($single_asset_portfolio as $single_asset_portfolio_key => $single_asset_portfolio_val)
                                                                <option value="{{ $single_asset_portfolio_key }}" {{ $single_asset_portfolio_key === $data->single_asset_portfolio ? 'selected' : '' }}>{{ $single_asset_portfolio_val }}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            <span class="invalid-feedback single_asset_portfolio" role="alert"></span>
                                                        </div>
                                                        <!-- Portfolio -->
                                                        <div class="mb-3">
                                                            <label for="portfolio" class="col-form-label">{{ __('Portfolio') }}</label>
                                                            <input id="portfolio" type="text" class="form-control @error('portfolio') is-invalid @enderror" name="portfolio" value="{{ old('portfolio', $data->portfolio) }}" autocomplete="portfolio">

                                                            <span class="invalid-feedback portfolio" role="alert"></span>
                                                        </div>
                                                        <!-- Existing Bedroom No. -->
                                                        <div class="mb-3">
                                                            <label for="existing_bedroom_no" class="col-form-label">{{ __('Existing Bedroom No.') }}<span class="isRequired"> * </span></label>

                                                            <div class="">
                                                                <input id="existing_bedroom_no" type="number" min="1" max="99" placeholder="1-99" class="form-control @error('existing_bedroom_no') is-invalid @enderror" name="existing_bedroom_no" value="{{ old('existing_bedroom_no', $data->existing_bedroom_no) }}" autocomplete="existing_bedroom_no">

                                                                <span class="invalid-feedback existing_bedroom_no" role="alert"></span>
                                                            </div>
                                                        </div>
                                                        <!-- Stamp Duty -->
                                                        <div class="mb-3">
                                                            <label for="stamp_duty" class="col-form-label">{{ __('Stamp Duty') }}</label>
                                                            <input id="stamp_duty" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('stamp_duty') is-invalid @enderror" name="stamp_duty" value="{{ old('stamp_duty', $data->stamp_duty) }}" autocomplete="stamp_duty">

                                                            <span class="invalid-feedback stamp_duty" role="alert"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <!-- Agent -->
                                                        <div class="mb-3">
                                                            <label for="agent" class="col-form-label">{{ __('Agent') }}<span class="isRequired"> * </span></label>
                                                            <input id="agent" type="text" class="form-control @error('agent') is-invalid @enderror" name="agent" value="{{ old('agent', $data->agent) }}" autocomplete="agent">

                                                            <span class="invalid-feedback agent" role="alert"></span>
                                                        </div>
                                                        <!-- Agent Fee % (excl. VAT) -->
                                                        <div class="mb-3">
                                                            <label for="agent_fee_percentage" class="col-form-label">{{ __('Agent Fee % (excl. VAT)') }}</label>
                                                            <input id="agent_fee_percentage" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('agent_fee_percentage') is-invalid @enderror" name="agent_fee_percentage" value="{{ old('agent_fee_percentage', $data->agent_fee_percentage) }}" autocomplete="agent_fee_percentage">

                                                            <span class="invalid-feedback agent_fee_percentage" role="alert"></span>
                                                        </div>
                                                        <!-- Agent Fee £ -->
                                                        <div class="mb-3">
                                                            <label for="agent_fee" class="col-form-label">{{ __('Agent £') }}</label>
                                                            <input id="agent_fee" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('agent_fee') is-invalid @enderror is-disabled" name="agent_fee" value="{{ old('agent_fee', $data->agent_fee) }}" autocomplete="agent_fee">

                                                            <span class="invalid-feedback agent_fee" role="alert"></span>

                                                        </div>
                                                        <!-- Estimated TPC -->
                                                        <div class="mb-3">
                                                            <label for="estimated_tpc" class="col-form-label">{{ __('Estimated TPC') }}</label>
                                                            <input id="estimated_tpc" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('estimated_tpc') is-invalid @enderror is-disabled" name="estimated_tpc" value="{{ old('estimated_tpc', $data->estimated_tpc) }}" autocomplete="estimated_tpc">

                                                            <span class="invalid-feedback estimated_tpc" role="alert"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <!-- Offer Date -->
                                                        <div class="mb-3">
                                                            <label for="offer_date" class="col-form-label">{{ __('Offer Date') }}</label>
                                                            <input id="offer_date" type="text" class="form-control @error('offer_date') is-invalid @enderror has-datepicker" name="offer_date" value="{{ old('offer_date', $data->offer_date) }}" placeholder="dd-mm-yyyy" autocomplete="offer_date">

                                                            <span class="invalid-feedback offer_date" role="alert"></span>
                                                        </div>
                                                        <!-- Target Completion Date -->
                                                        <div class="mb-3">
                                                            <label for="target_completion_date" class="col-form-label">{{ __('Target Completion Date') }}</label>
                                                            <input id="target_completion_date" type="text" class="form-control @error('target_completion_date') is-invalid @enderror has-datepicker" name="target_completion_date" value="{{ old('target_completion_date', $data->target_completion_date) }}" placeholder="dd-mm-yyyy" autocomplete="target_completion_date">

                                                            <span class="invalid-feedback target_completion_date" role="alert"></span>
                                                        </div>
                                                        <!-- Completion Date -->
                                                        <div class="mb-3">
                                                            <label for="completion_date" class="col-form-label">{{ __('Completion Date') }}
                                                                @if($data->acquisition_status === 'Completed')
                                                                <span class="isRequired"> * </span>
                                                                @endif
                                                            </label>
                                                            <input id="completion_date" type="text" class="form-control @error('completion_date') is-invalid @enderror {{ $data->acquisition_status === 'Completed' ? '' : 'is-disabled' }} has-datepicker" name="completion_date" value="{{ old('completion_date', $data->completion_date) }}" placeholder="dd-mm-yyyy" autocomplete="completion_date">

                                                            <span class="invalid-feedback completion_date" role="alert"></span>
                                                        </div>
                                                        <!-- COL Status -->
                                                        <div class="mb-3">
                                                            <label for="col_status" class="col-form-label">{{ __('COL Status') }}</label>
                                                            <select name="col_status" id="col_status" class="form-control form-control-alternative{{ $errors->has('col_status') ? ' is-invalid' : '' }}">
                                                                <option value="">Please Select</option>

                                                                @if(old('col_status'))
                                                                @foreach($col_status as $col_status_key => $col_status_val)
                                                                <option value="{{ $col_status_key }}" {{ $col_status_key === old('col_status') ? 'selected' : '' }}>{{ $col_status_val }}</option>
                                                                @endforeach
                                                                @else
                                                                @foreach($col_status as $col_status_key => $col_status_val)
                                                                <option value="{{ $col_status_key }}" {{ $col_status_key === $data->col_status ? 'selected' : '' }}>{{ $col_status_val }}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>

                                                            <span class="invalid-feedback col_status" role="alert"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <!-- COL Status Log -->
                                                        {{-- <div class="mb-3">
                                                            <label for="col_status_log" class="col-form-label">{{ __('COL Log') }}</label>
                                                        <textarea id="col_status_log" rows="5" type="text" class="form-control @error('col_status_log') is-invalid @enderror" name="col_status_log" value="{{ old('col_status_log', $data->col_status_log) }}" autocomplete="col_status_log" placeholder="Enter new COL Log...">{{$data->col_status_log}}</textarea>

                                                        <span class="invalid-feedback col_status_log" role="alert"></span>

                                                    </div> --}}
                                                    <!-- Financing Status -->
                                                    <div class="mb-3">
                                                        <label for="financing_status" class="col-form-label">{{ __('Purchase Financing Status') }}</label>
                                                        <select name="financing_status" id="financing_status" class="form-control form-control-alternative{{ $errors->has('financing_status') ? ' is-invalid' : '' }}">
                                                            <option value="">Please Select</option>
                                                            @if(old('financing_status'))
                                                            @foreach($financing_status as $financing_status_key => $financing_status_val)
                                                            <option value="{{ $financing_status_key }}" {{ $financing_status_key === old('financing_status') ? 'selected' : '' }}>{{ $financing_status_val }}</option>
                                                            @endforeach
                                                            @else
                                                            @foreach($financing_status as $financing_status_key => $financing_status_val)
                                                            <option value="{{ $financing_status_key }}" {{ $financing_status_key === $data->financing_status ? 'selected' : '' }}>{{ $financing_status_val }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <span class="invalid-feedbac financing_statusk" role="alert"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="col-form-label document-label">{{ __('Acquisition Finance') }}</label>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <!-- Asking Price -->
                                                    <div class="mb-3">
                                                        <label for="asking_price" class="col-form-label">{{ __('Asking £') }}<span class="isRequired"> * </span></label>
                                                        <input id="asking_price" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('asking_price') is-invalid @enderror" name="asking_price" value="{{ old('asking_price', $data->asking_price) }}" autocomplete="asking_price">

                                                        <span class="invalid-feedback asking_price" role="alert"></span>
                                                    </div>
                                                    <!-- Offer Price -->
                                                    <div class="mb-3">
                                                        <label for="offer_price" class="col-form-label">{{ __('Offer £') }}</label>
                                                        <input id="offer_price" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('offer_price') is-invalid @enderror" name="offer_price" value="{{ old('offer_price', $data->offer_price) }}" autocomplete="offer_price">

                                                        <span class="invalid-feedbac offer_pricek" role="alert"></span>
                                                    </div>
                                                    <!-- Agreed Purchase -->
                                                    <div class="mb-3">
                                                        <label for="agreed_purchase_price" class="col-form-label">{{ __('Agreed £') }}</label>
                                                        <input id="agreed_purchase_price" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('agreed_purchase_price') is-invalid @enderror" name="agreed_purchase_price" value="{{ old('agreed_purchase_price', $data->agreed_purchase_price) }}" autocomplete="agreed_purchase_price">

                                                        <span class="invalid-feedback agreed_purchase_price" role="alert"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Price Difference +/- -->
                                                    <div class="mb-3">
                                                        <label for="difference" class="col-form-label">{{ __('Price Difference +/-') }}</label>
                                                        <input id="difference" type="text" onkeyup="formatNumber(this.id)" class="form-control is-disabled @error('difference') is-invalid @enderror" name="difference" value="{{ old('difference', $data->difference) }}" autocomplete="difference">

                                                        <span class="invalid-feedback difference" role="alert">
                                                        </span>
                                                    </div>
                                                    <!-- Acquisition Cost -->
                                                    <div class="mb-3">
                                                        <label for="acquisition_cost" class="col-form-label">{{ __('Acquisition Cost £') }}</label>
                                                        <input id="acquisition_cost" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('acquisition_cost') is-invalid @enderror" name="acquisition_cost" value="{{ old('acquisition_cost', $data->acquisition_cost) }}" autocomplete="acquisition_cost">

                                                        <span class="invalid-feedback acquisition_cost" role="alert"></span>
                                                    </div>
                                                    <!-- Bridge Loan % -->
                                                    <div class="mb-3">
                                                        <label for="bridge_loan" class="col-form-label">{{ __('Bridge Loan %') }}</label>
                                                        <input id="bridge_loan" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('bridge_loan') is-invalid @enderror" name="bridge_loan" value="{{ old('bridge_loan', $data->bridge_loan) }}" autocomplete="bridge_loan">

                                                        <span class="invalid-feedback bridge_loan" role="alert"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Estimated Period (months) -->
                                                    <div class="mb-3">
                                                        <label for="estimated_period" class="col-form-label">{{ __('Estimated bridge loan period (months)') }}<span class="isRequired"> * </span></label>
                                                        <input id="estimated_period" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('estimated_period') is-invalid @enderror" name="estimated_period" value="{{ old('estimated_period', $data->estimated_period) }}" autocomplete="estimated_period">

                                                        <span class="invalid-feedback estimated_period" role="alert"></span>
                                                    </div>
                                                    <!-- Loan % -->
                                                    <div class="mb-3">
                                                        <label for="loan_percentage" class="col-form-label">{{ __('Loan %') }}</label>
                                                        <input id="loan_percentage" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('loan_percentage') is-invalid @enderror" name="loan_percentage" value="{{ old('loan_percentage', $data->loan_percentage) }}" autocomplete="loan_percentage">

                                                        <span class="invalid-feedback loan_percentage" role="alert"></span>
                                                    </div>
                                                    <!-- Estimated Interest £ -->
                                                    <div class="mb-3">
                                                        <label for="estimated_interest" class="col-form-label">{{ __('Estimated Interest £') }}</label>
                                                        <input id="estimated_interest" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('estimated_interest') is-invalid @enderror is-disabled" name="estimated_interest" value="{{ old('estimated_interest', $data->estimated_interest) }}" autocomplete="estimated_interest">

                                                        <span class="invalid-feedback estimated_interest" role="alert"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="col-form-label document-label">{{ __('CAPEX') }}</label>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <!-- CAPEX Budget -->
                                                    <div class="mb-3">
                                                        <label for="capex_budget" class="col-form-label">{{ __('CAPEX Budget') }}<span class="isRequired"> * </span></label>
                                                        <input id="capex_budget" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('capex_budget') is-invalid @enderror" name="capex_budget" value="{{ old('capex_budget', $data->capex_budget) }}" autocomplete="capex_budget">

                                                        <span class="invalid-feedback capex_budget" role="alert">

                                                        </span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="col-form-label document-label">{{ __('Investment') }}</label>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <!-- Valuation Yield % -->
                                                    <div class="mb-3">
                                                        <label for="bric_purchase_yield_percentage" class="col-form-label">{{ __('Valuation Yield %') }}</label>
                                                        <input id="bric_purchase_yield_percentage" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('bric_purchase_yield_percentage') is-invalid @enderror is-disabled" name="bric_purchase_yield_percentage" value="{{ old('bric_purchase_yield_percentage', $data->bric_purchase_yield_percentage) }}" autocomplete="bric_purchase_yield_percentage">

                                                        <span class="invalid-feedback bric_purchase_yield_percentage" role="alert"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- TPC / Bed Space -->
                                                    <div class="mb-3">
                                                        <label for="tpc_bedspace" class="col-form-label">{{ __('TPC / Bed Space') }}</label>
                                                        <input id="tpc_bedspace" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('tpc_bedspace') is-invalid @enderror is-disabled" name="tpc_bedspace" value="{{ old('tpc_bedspace', $data->tpc_bedspace) }}" autocomplete="tpc_bedspace">

                                                        <span class="invalid-feedback tpc_bedspace" role="alert"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Purchase Price / Bed Space -->
                                                    <div class="mb-3">
                                                        <label for="purchase_price_bedspace" class="col-form-label">{{ __('Purchase Price / Bed Space') }}</label>
                                                        <input id="purchase_price_bedspace" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('purchase_price_bedspace') is-invalid @enderror is-disabled" name="purchase_price_bedspace" value="{{ old('purchase_price_bedspace', $data->purchase_price_bedspace) }}" autocomplete="purchase_price_bedspace">

                                                        <span class="invalid-feedback purchase_price_bedspace" role="alert"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Bric Y1 proposed rent PPPW -->
                                                    <div class="mb-3">
                                                        <label for="bric_y1_proposed_rent_pppw" class="col-form-label">{{ __('Bric Y1 proposed rent PPPW') }}</label>
                                                        <input id="bric_y1_proposed_rent_pppw" type="text" onkeyup="formatNumber(this.id)" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('bric_y1_proposed_rent_pppw') is-invalid @enderror" name="bric_y1_proposed_rent_pppw" value="{{ old('bric_y1_proposed_rent_pppw', $data->bric_y1_proposed_rent_pppw) }}" autocomplete="bric_y1_proposed_rent_pppw">

                                                        <span class="invalid-feedback bric_y1_proposed_rent_pppw" role="alert"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Tenancy length (weeks) -->
                                                    <div class="mb-3">
                                                        <label for="tenancy_length_weeks" class="col-form-label">{{ __('Tenancy length (weeks)') }}</label>
                                                        <input id="tenancy_length_weeks" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('tenancy_length_weeks') is-invalid @enderror" name="tenancy_length_weeks" value="{{ old('tenancy_length_weeks', $data->tenancy_length_weeks) }}" autocomplete="tenancy_length_weeks">

                                                        <span class="invalid-feedback tenancy_length_weeks" role="alert"></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="col-form-label document-label">{{ __('Land Registry') }}</label>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <!-- Tennure -->
                                                    <div class="mb-3">
                                                        <label for="tennure" class="col-form-label">{{ __('Tennure') }}<span class="isRequired"> * </span></label>
                                                        <select name="tennure" id="tennure" class="form-control form-control-alternative{{ $errors->has('tennure') ? ' is-invalid' : '' }}">
                                                            <option value="">Please Select</option>
                                                            @if(old('tennure'))
                                                            @foreach($tennure as $tennure_key => $tennure_val)
                                                            <option value="{{ $tennure_key }}" {{ $tennure_key === old('tennure') ? 'selected' : '' }}>{{ $tennure_val }}</option>
                                                            @endforeach
                                                            @else
                                                            @foreach($tennure as $tennure_key => $tennure_val)
                                                            <option value="{{ $tennure_key }}" {{ $tennure_key === $data->tennure ? 'selected' : '' }}>{{ $tennure_val }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>

                                                        <span class="invalid-feedback tennure" role="alert"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Ground Rent -->
                                                    <div class="mb-3">
                                                        <label for="ground_rent" class="col-form-label">{{ __('Ground Rent') }}</label>
                                                        <input id="ground_rent" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('ground_rent') is-invalid @enderror {{ $data->tennure === 'Freehold' ? 'is-disabled' : '' }}" name="ground_rent" value="{{ old('ground_rent', $data->ground_rent) }}" autocomplete="ground_rent">

                                                        <span class="invalid-feedback ground_rent" role="alert"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Grand Rent Due -->
                                                    <div class="mb-3">
                                                        <label for="ground_rent_due" class="col-form-label">{{ __('Grand Rent Due') }}</label>
                                                        <input id="ground_rent_due" type="text" class="form-control @error('ground_rent_due') is-invalid @enderror {{ $data->tennure === 'Freehold' ? 'is-disabled' : 'has-datepicker' }}" name="ground_rent_due" value="{{ old('ground_rent_due', $data->ground_rent_due) }}" placeholder="{{ $data->tennure === 'Freehold' ? '' : 'dd-mm-yyyy' }}" autocomplete="ground_rent_due">

                                                        <span class="invalid-feedback ground_rent_due" role="alert"></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 insurance-card">
                                        <div class="mb-3">
                                            <label class="col-form-label document-label">{{ __('Insurance') }}</label>
                                            <div class="row">
                                                <div class="col-md-3 mb-3 d-flex align-items-center justify-content-center">
                                                    <!-- Insurance In Place -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <input name="insurance_in_place" id="insurance_in_place" type="checkbox" style="width:25px;height:25px;" {{ $data->insurance_in_place == '1' ? 'checked' : '' }}>
                                                        <span class="insurance-label" style="font-size: 16px;">{{ __('Insurance in Place') }}
                                                            @if($data->acquisition_status === 'Completed' && $data->completion_date != "")
                                                            <span class="isRequired"> * </span>
                                                            @endif
                                                        </span>
                                                    </div>

                                                    <span class="invalid-feedback insurance_in_place" role="alert"></span>

                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Insurance Value -->
                                                    <div class="mb-3">
                                                        <label for="insurance_value" class="col-form-label insurance-label">{{ __('Insurance Value') }}
                                                            @if($data->acquisition_status === 'Completed' && $data->completion_date != "")
                                                            <span class="isRequired"> * </span>
                                                            @endif
                                                        </label>
                                                        <input id="insurance_value" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('insurance_value') is-invalid @enderror" name="insurance_value" value="{{ old('insurance_value', $data->insurance_value) }}" autocomplete="insurance_value">

                                                        <span class="invalid-feedback insurance_value" role="alert"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Insurance Cost -->
                                                    <div class="mb-3">
                                                        <label for="insurance_in_cost" class="col-form-label insurance-label">{{ __('Insurance Cost') }}
                                                            @if($data->acquisition_status === 'Completed' && $data->completion_date != "")
                                                            <span class="isRequired"> * </span>
                                                            @endif
                                                        </label>
                                                        <input id="insurance_in_cost" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('insurance_in_cost') is-invalid @enderror" name="insurance_in_cost" value="{{ old('insurance_in_cost', $data->insurance_annual_cost) }}" autocomplete="insurance_in_cost">

                                                        <span class="invalid-feedback insurance_in_cost" role="alert"></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <!-- Insurance Renewal Date -->
                                                    <div class="mb-3">
                                                        <label for="insurance_renewal_date" class="col-form-label insurance-label">{{ __('Insurance Renewal Date') }}
                                                            @if($data->acquisition_status === 'Completed' && $data->completion_date != "")
                                                            <span class="isRequired"> * </span>
                                                            @endif
                                                        </label>
                                                        <input id="insurance_renewal_date" type="text" class="form-control @error('insurance_renewal_date') is-invalid @enderror has-datepicker" name="insurance_renewal_date" value="{{ old('insurance_renewal_date', $data->insurance_renewal_date) }}" placeholder="dd-mm-yyyy" autocomplete="insurance_renewal_date">

                                                        <span class="invalid-feedback insurance_renewal_date" role="alert"></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center gap-2">
                        <a href="{{ URL::previous() }}" class="btn btn-danger shadow-sm" style="width:10%;">Cancel</a>
                        <button type="submit" id="acquisition-edit-btn" class="btn btn-success shadow-sm" style="width:10%;">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<!-- Modal -->
<div class="modal fade" id="colLogModal" tabindex="-1" role="dialog" aria-labelledby="colLogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="colLogModalLabel">COL Logs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $data['col_status_log'] !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {

        // Price Difference
        function autoPriceDifference() {
            if ($("#agreed_purchase_price").val() != "" && $("#asking_price").val() != "") {
                var agreedPurchasePrice = formatWholeNumber($("#agreed_purchase_price").val());
                var askingPrice = formatWholeNumber($("#asking_price").val());
                var priceDifference = askingPrice - agreedPurchasePrice;
                $("#difference").val(parseInt(priceDifference).toLocaleString());
            }
        }
        // Agent £ Calculation
        function autoAgentFee() {
            if ($("#agreed_purchase_price").val() != "" && $("#agent_fee_percentage").val() != "") {
                var agentFeePercentage = formatAsPercentage($("#agent_fee_percentage").val(), 4);
                var agreedPurchasePrice = formatWholeNumber($("#agreed_purchase_price").val());
                var auto_agent_fee = (agreedPurchasePrice * agentFeePercentage) * 1.2;
                $('#agent_fee').val(parseInt(auto_agent_fee).toLocaleString());
            }
        }
        // Estimated Interest £
        function autoEstimatedInterest() {
            if ($("#agreed_purchase_price").val() != "" && $("#bridge_loan").val() != "" && $("#estimated_period").val() != "" && $("#loan_percentage").val() != "") {
                var bridgeLoanPercentage = formatAsPercentage($("#bridge_loan").val(), 4);
                var loanPercentage = formatAsPercentage($("#loan_percentage").val(), 4);
                var agreedPurchasePrice = formatWholeNumber($("#agreed_purchase_price").val());
                var estimatedInterest = (agreedPurchasePrice * loanPercentage) * bridgeLoanPercentage * $("#estimated_period").val();
                $('#estimated_interest').val(parseInt(Math.round(estimatedInterest)).toLocaleString());
            }
        }
        // Estimated TPC 
        function autoEstimatedTPC() {
            if ($("#agreed_purchase_price").val() != "" && $("#stamp_duty").val() != "" && $("#acquisition_cost").val() != "" && $("#agent_fee").val() != "" && $("#capex_budget").val() != "" && $("#estimated_interest").val() != "") {
                var agreedPurchasePrice = formatWholeNumber($("#agreed_purchase_price").val());
                var stampDuty = formatWholeNumber($("#stamp_duty").val());
                var acquisitionCost = formatWholeNumber($("#acquisition_cost").val());
                var agentFee = formatWholeNumber($("#agent_fee").val());
                var capexBudget = formatWholeNumber($("#capex_budget").val());
                var estimatedInterest = formatWholeNumber($("#estimated_interest").val());
                var estimatedTPC = parseInt(agreedPurchasePrice) + parseInt(stampDuty) + parseInt(acquisitionCost) + parseInt(agentFee) + parseInt(capexBudget) + parseInt(estimatedInterest);
                $('#estimated_tpc').val(parseInt(Math.round(estimatedTPC)).toLocaleString());
            }
        }
        // Bric Purchase Yield
        function autoBricPurchaseYield() {
            if ($("#bric_y1_proposed_rent_pppw").val() != "" && $("#tenancy_length_weeks").val() != "" && $("#no_bric_beds").val() != "" && $("#estimated_tpc").val() != "") {
                var bricY1 = formatWholeNumber($("#bric_y1_proposed_rent_pppw").val());
                var estimatedTpc = formatWholeNumber($("#estimated_tpc").val());
                var bricPurchaseYield = (bricY1 * $("#tenancy_length_weeks").val() * $("#no_bric_beds").val()) / estimatedTpc;
                var formatedBPY = bricPurchaseYield * 100;
                $('#bric_purchase_yield_percentage').val(formatedBPY.toFixed(3));
            }
        }
        // TPC / Bed Space
        function autoTPCBedSpace() {
            if ($("#no_bric_beds").val() != "" && $("#estimated_tpc").val() != "") {
                var estimatedTpc = formatWholeNumber($("#estimated_tpc").val());
                var tpcBedspace = (estimatedTpc / $("#no_bric_beds").val());
                $('#tpc_bedspace').val(parseInt(Math.round(tpcBedspace)).toLocaleString());
            }
        }
        // Existing Bedrom No
        function autoEBN() {
            if ($("#existing_bedroom_no").val() != "" && $("#agreed_purchase_price").val() != "") {
                var agreedPurchasePrice = formatWholeNumber($("#agreed_purchase_price").val());
                var existingBedroomNo = (agreedPurchasePrice / $("#existing_bedroom_no").val());
                $('#purchase_price_bedspace').val(parseInt(Math.round(existingBedroomNo)).toLocaleString());
            }
        }

        // Show Insurance if Acquisition Status is Completed
        function checkASCompleted() {
            if ($("#acquisition_status").val() === "Completed" && $("#completion_date").datepicker('getDate') != null) {
                $("#insurance_in_place").parent().find('.insurance-label > span.isRequired').remove();
                $("#insurance_value").parent().find('.insurance-label > span.isRequired').remove();
                $("#insurance_in_cost").parent().find('.insurance-label > span.isRequired').remove();
                $("#insurance_renewal_date").parent().find('.insurance-label > span.isRequired').remove();
                $("#insurance_in_place").parent().find('.insurance-label').append('<span class="isRequired"> * </span>');
                $("#insurance_value").parent().find('.insurance-label').append('<span class="isRequired"> * </span>');
                $("#insurance_in_cost").parent().find('.insurance-label').append('<span class="isRequired"> * </span>');
                $("#insurance_renewal_date").parent().find('.insurance-label').append('<span class="isRequired"> * </span>');
            } else {
                $("#insurance_in_place").parent().find('.insurance-label > span.isRequired').remove();
                $("#insurance_value").parent().find('.insurance-label > span.isRequired').remove();
                $("#insurance_in_cost").parent().find('.insurance-label > span.isRequired').remove();
                $("#insurance_renewal_date").parent().find('.insurance-label > span.isRequired').remove();
            }
        }
        // function checkOverrunning(){

        //     var now = new Date();
        //     var dateNow = moment(now).format('YYYY-MM-DD');

        //     var est_date = $("#projected_completion_date").datepicker('getDate'); 
        //     if (moment(est_date).isAfter(dateNow)) {
        //         $('#over_running').val('Yes');
        //     }else{
        //         $('#over_running').val('No');
        //     }

        // }

        $(document).on('change', 'select', function(e) {
            switch (e.target.name) {
                case 'property_phase':
                    if (e.target.value != "") {
                        $(this).removeClass("is-invalid");
                    }
                    break;
                case 'entity':
                    if (e.target.value === "0") {
                        $('#entityModal').modal('show');
                    }
                    break;
                case 'city':
                    if (e.target.value != "") {
                        $(this).removeClass("is-invalid");
                        $("#area").removeClass("is-invalid");
                    }
                    var cityValue = $('select[name="city"]').val();
                    $('select[name="area"]').empty();
                    switch (cityValue) {
                        case 'Liverpool':
                            $('select[name="area"]').attr('disabled', false);
                            var areaTemp = '<option value="Wavertree">Wavertree</option>' +
                                '<option value="Kensington">Kensington</option>' +
                                '<option value="Toxteth">Toxteth</option>' +
                                '<option value="City Centre">City Centre</option>';

                            break;
                        case 'Lincoln':
                            $('select[name="area"]').attr('disabled', false);
                            var areaTemp = '<option value="West End">West End</option>' +
                                '<option value="Monks Road">Monks Road</option>' +
                                '<option value="High Street">High Street</option>';
                            break;
                        case 'Swansea':
                            $('select[name="area"]').attr('disabled', false);
                            var areaTemp = '<option value="Brynmill">Brynmill</option>' +
                                '<option value="Sandfields">Sandfields</option>' +
                                '<option value="City Centre">City Centre</option>' +
                                '<option value="Mount Pleasant">Mount Pleasant</option>' +
                                '<option value="Uplands">Uplands</option>' +
                                '<option value="St Thomas">St Thomas</option>' +
                                '<option value="Port Tennant">Port Tennant</option>';
                            break;
                        default:
                            $('select[name="area"]').attr('disabled', true);
                            var areaTemp = '<option value="">Please Select City First</option>';
                            break;
                    }
                    $('select[name="area"]').append(areaTemp);
                    break;
                case 'acquisition_status':
                    if (e.target.value != "") {
                        $(this).removeClass("is-invalid");
                        if (e.target.value === 'Completed') {
                            $('#completion_date').removeClass('is-disabled');
                            $('#completion_date').parent().find('label').append('<span class="isRequired"> * </span>');
                        } else {
                            $('#completion_date').addClass('is-disabled');
                            $('#completion_date').removeClass('is-invalid');
                            $('#completion_date').parent().find('.isRequired').remove();
                            $('#completion_date').datepicker('setDate', null);
                            $("#completion_date").val('');
                            $("#completion_date").datepicker({
                                dateFormat: "dd-mm-yy",
                            });
                        }
                    }
                    break;
                case 'single_asset_portfolio':
                    if (e.target.value != "") {
                        $(this).removeClass("is-invalid");
                    }
                    var single_asset_portfolio = $('select[name="single_asset_portfolio"]').val();
                    if (single_asset_portfolio === "Single Asset") {
                        $('input[name="portfolio"]').val("N/A");
                        $('input[name="portfolio"]').removeClass("is-invalid");
                        $('input[name="portfolio"]').prop('disabled', true);
                    } else {
                        $('input[name="portfolio"]').val("");
                        $('input[name="portfolio"]').prop('disabled', false);
                    }
                    break;
                case 'bric_y1':
                    if (e.target.value != "") {
                        $(this).removeClass("is-invalid");
                    }
                    break;
                default:
                    break;
            }
        });

        $(document).on('change', '#property_phase, #entity, #house_no, #street, #postcode, #acquisition_status, #asking_price, #existing_beds, #agent, #tennure, #portfolio, #existing_bedroom_no, #estimated_period, #status, #insurance_value, #insurance_in_cost, #development_status', function(e) {
            if (e.target.value != "") {
                $(this).removeClass("is-invalid");
            } else {
                // $(this).addClass("is-invalid");
            }
            switch (e.target.name) {
                case 'tennure':
                    if ($(this).val() === 'Freehold') {
                        $("#ground_rent").val('N/A').addClass('is-disabled');
                        $("#ground_rent_due").datepicker("destroy");

                        $("#ground_rent_due").val("N/A").addClass('is-disabled');
                    } else {
                        $("#ground_rent").val("").removeClass('is-disabled');
                        $("#ground_rent_due").val("").removeClass('is-disabled');
                        $("#ground_rent_due").datepicker({
                            dateFormat: "dd-mm-yy",
                        });
                        $("#ground_rent_due").attr("placeholder", "dd-mm-yyyy");

                    }
                    break;
                case 'property_phase':
                    if ($(this).val() === 'Acquiring') {
                        $("#status").val('2').removeClass('is-disabled');
                        $("#status").removeClass("is-invalid")
                        $('#development-section').addClass('d-none');
                        // $('#project_start_date').datepicker('setDate', null);
                        // $('#projected_completion_date').datepicker('setDate', null);
                        // $('#development_status').val('');
                    } else if ($(this).val() === 'In Development') {
                        $('#development-section').removeClass('d-none');
                        $("#status").val("").removeClass('is-disabled');
                    } else {
                        $("#status").val("").removeClass('is-disabled');
                        // $('#development-section').addClass('d-none'); 
                        // $('#project_start_date').datepicker('setDate', null);
                        // $('#projected_completion_date').datepicker('setDate', null);
                        // $('#development_status').val('');
                    }
                    checkASCompleted();
                    break;
                case 'acquisition_status':
                    checkASCompleted();
                    break;
                case 'status':
                    if ($(this).val() == '0') {
                        $('#lettingStatusModal').modal('show');
                    }
                    break;
                default:
                    break;
            }

        });

        var arrayEI = [
            'asking_price',
            'agent_fee_percentage',
            'agreed_purchase_price',
            'bridge_loan',
            'estimated_period',
            'loan_percentage',
            'bric_y1_proposed_rent_pppw',
            'tenancy_length_weeks',
            'no_bric_beds',
            'estimated_tpc',
            'existing_bedroom_no',
            'capex_budget'
        ];
        $(document).on('blur', '#asking_price, #agreed_purchase_price, #agent_fee_percentage, #bridge_loan, #estimated_period, #loan_percentage, #bric_y1_proposed_rent_pppw, #tenancy_length_weeks, #no_bric_beds, #estimated_tpc, #existing_bedroom_no, #capex_budget', function(e) {
            switch (e.target.name) {
                case (arrayEI.includes(e.target.name) ? e.target.name : ''):
                    autoPriceDifference();
                    autoAgentFee();
                    autoEstimatedInterest();
                    autoEstimatedTPC();
                    autoBricPurchaseYield();
                    autoTPCBedSpace();
                    autoEBN();
                    break;
                default:
                    break;
            }

        });

        $(".has-datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            onSelect: function(date) {
                $('#ui-datepicker-div').css('position', 'relative');
                switch ($(this).attr('name')) {
                    case 'completion_date':
                        $('#completion_date').removeClass("is-invalid");
                        checkASCompleted();
                        break;
                    case 'insurance_renewal_date':
                        $('#insurance_renewal_date').removeClass("is-invalid");
                        break;
                    case 'project_start_date':
                        $('#project_start_date').removeClass("is-invalid");
                        break;
                    case 'projected_completion_date':
                        $('#projected_completion_date').removeClass("is-invalid");
                        break;
                    default:
                        break;
                }
            }
        });


        $("#acquisition-edit-btn").click(function(e) {
            e.preventDefault();
            let form = $('#acquisition-edit');
            let formId = document.getElementById('acquisition-edit')
            let data = new FormData(formId);

            // console.log(data)
            // console.log(data.keys())
            // console.log(data.values())

            $.ajax({
                url: "{{ route('get.update-acquisition', $data) }}",
                type: "POST",
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false,

                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: "Acquisition Successfully Updated!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = baseUrl + "/property/details/" + response['id'];
                        } else {
                            window.location.href = baseUrl + "/property/details/" + response['id'];
                        }
                    })

                },
                error: function(xhr, status, error) {

                    console.log(xhr.responseJSON.errors)
                    console.log(typeof(xhr.responseJSON.errors))
                    console.log(status)
                    console.log(error)
                    Swal.fire({
                        title: 'Error',
                        text: "Review your inputs and try again",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // capex_budget
                        // xhr.responseJSON.errors.forEach(function (value, index, array) {
                        //     console.log(value)
                        //     // $('#').addClass('is-invalid');
                        // });

                        for (const property in xhr.responseJSON.errors) {
                            // console.log(`${property}: ${xhr.responseJSON.errors[property]}`);
                            $('#' + property).addClass('is-invalid');
                            $('.invalid-feedback.' + property).addClass('is-invalid').html('<strong>' + xhr.responseJSON.errors[property] + '</strong>');
                            // <span class="invalid-feedback capex_budget" role="alert">
                        }

                    })
                }

            });

        })



    })

    function formatNumber(e) {
        // Get the user input
        var input = document.getElementById(e).value;
        if (input) {
            // Remove non-numeric characters and leading zeros
            let formattedNumber = input.replace(/[^\d]/g, '').replace(/^0+/, '');

            // Add commas for thousands
            formattedNumber = formattedNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            document.getElementById(e).value = formattedNumber;
        }
    }

    function formatWholeNumber(price) {
        var numberValue = price;
        numberValue = numberValue.split(',').join('');
        return numberValue;
    }
</script>
@endpush
@endsection