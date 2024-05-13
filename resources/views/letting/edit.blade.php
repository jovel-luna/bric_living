@extends('layouts.app', ['pageSlug' => 'letting'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lettings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Lettings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @if (Session::has('success'))
                    <div class="alert-container p-3">
                        <div class="alert alert-success p-3">
                            <strong>Success:</strong> {{Session::get('success')}}
                        </div>
                    </div>
                @endif
                <div class="d-sm-flex align-items-center justify-content-end mb-3 gap-2">
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                    </a>
                </div>
                <div id="reports" class="col-md-12">
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">{{ __('Edit Lettings') }}</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('letting.update', $data) }}" autocomplete="off" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="card card-secondary shadow mb-4 p-0">
                                    <div class="card-header py-2">
                                        <h6 class="m-0 font-weight-bold">{{ __('Current Academic Year') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="version" class="col-form-label">{{ __('Version') }}</label>
                                                    <select name="version" id="version" class="form-control form-control-alternative{{ $errors->has('version') ? ' is-invalid' : '' }}">
                                                        <option value="">Select a version</option>
                                                        <option value="V0">V0</option>
                                                        <option value="V1">V1</option>
                                                        <option value="V2">V2</option>
                                                        <option value="V2E">V2E</option>
                                                        <option value="External Client">External Client</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_letting_status" class="col-form-label">{{ __('Contract Status') }}</label>
                                                    <select name="cay_letting_status" id="cay_letting_status" class="form-control form-control-alternative{{ $errors->has('cay_letting_status') ? ' is-invalid' : '' }}">
                                                        <option value="">Select a status</option>
                                                        <option value="Application Sent">Application Sent</option>
                                                        <option value="Contracts Sent">Contracts Sent</option>
                                                        <option value="LET">LET</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_contract_status_log" class="col-form-label">{{ __('Contract Status Log') }}</label>
                                                    <textarea id="cay_contract_status_log" rows="5" type="text" class="form-control @error('cay_contract_status_log') is-invalid @enderror" name="cay_contract_status_log" value="{{ old('cay_contract_status_log', $data->cay_contract_status_log) }}" autocomplete="cay_contract_status_log" placeholder="Enter Contract Status Log...">{{$data->cay_contract_status_log}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_beds_let" class="col-form-label">{{ __('Beds Let') }}</label>
                                                    <select class="form-control selectpicker" multiple data-live-search="true" id="cay_beds_let" data-actions-box="true">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_beds_vacant" class="col-form-label">{{ __('Beds Vacant') }}</label>
                                                    <input id="cay_beds_vacant" type="text" class="form-control @error('cay_beds_vacant') is-invalid @enderror is-disabled" name="cay_beds_vacant" value="{{ old('cay_beds_vacant', $data->no_bric_bathrooms) }}" autocomplete="cay_beds_vacant">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_target_weekly_rent_pppw" class="col-form-label">{{ __('Target Weekly Rent PPPW') }}</label>
                                                    <input id="cay_target_weekly_rent_pppw" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('cay_target_weekly_rent_pppw') is-invalid @enderror" name="cay_target_weekly_rent_pppw" value="{{ old('cay_target_weekly_rent_pppw', $data->no_bric_bathrooms) }}" autocomplete="cay_target_weekly_rent_pppw">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_secured_weekly_rent_pppw" class="col-form-label">{{ __('Secured Weekly Rent PPPW') }}</label>
                                                    <input id="cay_secured_weekly_rent_pppw" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('cay_secured_weekly_rent_pppw') is-invalid @enderror" name="cay_secured_weekly_rent_pppw" value="{{ old('cay_secured_weekly_rent_pppw', $data->no_bric_bathrooms) }}" autocomplete="cay_secured_weekly_rent_pppw">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_target_annual_rent" class="col-form-label">{{ __('Target Annual Rent') }}</label>
                                                    <input id="cay_target_annual_rent" type="text" class="form-control @error('cay_target_annual_rent') is-invalid @enderror is-disabled" name="cay_target_annual_rent" value="{{ old('cay_target_annual_rent', $data->no_bric_bathrooms) }}" autocomplete="cay_target_annual_rent">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_secured_annual_rent" class="col-form-label">{{ __('Secured Annual Rent') }}</label>
                                                    <input id="cay_secured_annual_rent" type="text" class="form-control @error('cay_secured_annual_rent') is-invalid @enderror is-disabled" name="cay_secured_annual_rent" value="{{ old('cay_secured_annual_rent', $data->no_bric_bathrooms) }}" autocomplete="cay_secured_annual_rent">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_rent_difference" class="col-form-label">{{ __('+/- Rent') }}</label>
                                                    <input id="cay_rent_difference" type="text" class="form-control @error('cay_rent_difference') is-invalid @enderror is-disabled" name="cay_rent_difference" value="{{ old('cay_rent_difference', $data->no_bric_bathrooms) }}" autocomplete="cay_rent_difference">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_tenancy_start_date" class="col-form-label">{{ __('Tenancy Start Date') }}</label>
                                                    <input id="cay_tenancy_start_date" type="text" class="form-control @error('cay_tenancy_start_date') is-invalid @enderror has-datepicker" name="cay_tenancy_start_date" value="{{ old('cay_tenancy_start_date', $data->cay_tenancy_start_date) }}" placeholder="dd-mm-yyyy" autocomplete="cay_tenancy_start_date">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_tenancy_end_date" class="col-form-label">{{ __('Tenancy End Date') }}</label>
                                                    <input id="cay_tenancy_end_date" type="text" class="form-control @error('cay_tenancy_end_date') is-invalid @enderror has-datepicker" name="cay_tenancy_end_date" value="{{ old('cay_tenancy_end_date', $data->cay_tenancy_end_date) }}" placeholder="dd-mm-yyyy" autocomplete="cay_tenancy_end_date">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cay_tenancy_period" class="col-form-label">{{ __('Tenancy Period') }}</label>
                                                    <input id="cay_tenancy_period" type="text" class="form-control @error('cay_tenancy_period') is-invalid @enderror is-disabled" name="cay_tenancy_period" value="{{ old('cay_tenancy_period', $data->no_bric_bathrooms) }}" autocomplete="cay_tenancy_period">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-secondary shadow mb-4 p-0">
                                    <div class="card-header py-2">
                                        <h6 class="m-0 font-weight-bold">{{ __('Next Academic Year') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_letting_status" class="col-form-label">{{ __('Contract Status') }}</label>
                                                    <select name="nay_letting_status" id="nay_letting_status" class="form-control form-control-alternative{{ $errors->has('nay_letting_status') ? ' is-invalid' : '' }}">
                                                        <option value="">Select a status</option>
                                                        <option value="Application Sent">Application Sent</option>
                                                        <option value="Contracts Sent">Contracts Sent</option>
                                                        <option value="LET">LET</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_contract_status_log" class="col-form-label">{{ __('Contract Status Log') }}</label>
                                                    <textarea id="nay_contract_status_log" rows="5" type="text" class="form-control @error('nay_contract_status_log') is-invalid @enderror" name="nay_contract_status_log" value="{{ old('nay_contract_status_log', $data->nay_contract_status_log) }}" autocomplete="nay_contract_status_log" placeholder="Enter Contract Status Log...">{{$data->nay_contract_status_log}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_beds_let" class="col-form-label">{{ __('Beds Let') }}</label>
                                                    <select class="form-control selectpicker" multiple data-live-search="true" id="nay_beds_let" data-actions-box="true">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_beds_vacant" class="col-form-label">{{ __('Beds Vacant') }}</label>
                                                    <input id="nay_beds_vacant" type="text" class="form-control @error('nay_beds_vacant') is-invalid @enderror is-disabled" name="nay_beds_vacant" value="{{ old('nay_beds_vacant', $data->no_bric_bathrooms) }}" autocomplete="nay_beds_vacant">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_target_weekly_rent_pppw" class="col-form-label">{{ __('Target Weekly Rent PPPW') }}</label>
                                                    <input id="nay_target_weekly_rent_pppw" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('nay_target_weekly_rent_pppw') is-invalid @enderror" name="nay_target_weekly_rent_pppw" value="{{ old('nay_target_weekly_rent_pppw', $data->no_bric_bathrooms) }}" autocomplete="nay_target_weekly_rent_pppw">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_secured_weekly_rent_pppw" class="col-form-label">{{ __('Secured Weekly Rent PPPW') }}</label>
                                                    <input id="nay_secured_weekly_rent_pppw" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('nay_secured_weekly_rent_pppw') is-invalid @enderror" name="nay_secured_weekly_rent_pppw" value="{{ old('nay_secured_weekly_rent_pppw', $data->no_bric_bathrooms) }}" autocomplete="nay_secured_weekly_rent_pppw">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_target_annual_rent" class="col-form-label">{{ __('Target Annual Rent') }}</label>
                                                    <input id="nay_target_annual_rent" type="text" class="form-control @error('nay_target_annual_rent') is-invalid @enderror is-disabled" name="nay_target_annual_rent" value="{{ old('nay_target_annual_rent', $data->no_bric_bathrooms) }}" autocomplete="nay_target_annual_rent">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_secured_annual_rent" class="col-form-label">{{ __('Secured Annual Rent') }}</label>
                                                    <input id="nay_secured_annual_rent" type="text" class="form-control @error('nay_secured_annual_rent') is-invalid @enderror is-disabled" name="nay_secured_annual_rent" value="{{ old('nay_secured_annual_rent', $data->no_bric_bathrooms) }}" autocomplete="nay_secured_annual_rent">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_rent_difference" class="col-form-label">{{ __('+/- Rent') }}</label>
                                                    <input id="nay_rent_difference" type="text" class="form-control @error('nay_rent_difference') is-invalid @enderror is-disabled" name="nay_rent_difference" value="{{ old('nay_rent_difference', $data->no_bric_bathrooms) }}" autocomplete="nay_rent_difference">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_tenancy_start_date" class="col-form-label">{{ __('Tenancy Start Date') }}</label>
                                                    <input id="nay_tenancy_start_date" type="text" class="form-control @error('nay_tenancy_start_date') is-invalid @enderror has-datepicker" name="nay_tenancy_start_date" value="{{ old('nay_tenancy_start_date', $data->nay_tenancy_start_date) }}" placeholder="dd-mm-yyyy" autocomplete="nay_tenancy_start_date">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_tenancy_end_date" class="col-form-label">{{ __('Tenancy End Date') }}</label>
                                                    <input id="nay_tenancy_end_date" type="text" class="form-control @error('nay_tenancy_end_date') is-invalid @enderror has-datepicker" name="nay_tenancy_end_date" value="{{ old('nay_tenancy_end_date', $data->nay_tenancy_end_date) }}" placeholder="dd-mm-yyyy" autocomplete="nay_tenancy_end_date">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nay_tenancy_period" class="col-form-label">{{ __('Tenancy Period') }}</label>
                                                    <input id="nay_tenancy_period" type="text" class="form-control @error('nay_tenancy_period') is-invalid @enderror is-disabled" name="nay_tenancy_period" value="{{ old('nay_tenancy_period', $data->no_bric_bathrooms) }}" autocomplete="nay_tenancy_period">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="date_listed_on_rightmove" class="col-form-label">{{ __('Date Listed on Rightmove') }}</label>
                                                    <input id="date_listed_on_rightmove" type="text" class="form-control @error('date_listed_on_rightmove') is-invalid @enderror has-datepicker" name="date_listed_on_rightmove" value="{{ old('date_listed_on_rightmove', $data->date_listed_on_rightmove) }}" placeholder="dd-mm-yyyy" autocomplete="date_listed_on_rightmove">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="date_updated_on_rightmove" class="col-form-label">{{ __('Date Updated Rightmove') }}</label>
                                                    <input id="date_updated_on_rightmove" type="text" class="form-control @error('date_updated_on_rightmove') is-invalid @enderror has-datepicker" name="date_updated_on_rightmove" value="{{ old('date_updated_on_rightmove', $data->date_updated_on_rightmove) }}" placeholder="dd-mm-yyyy" autocomplete="date_updated_on_rightmove">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="virtual_tour" class="col-form-label">{{ __('Virtual Tour') }}</label>
                                                    <input id="virtual_tour" type="text" class="form-control @error('virtual_tour') is-invalid @enderror" name="virtual_tour" value="{{ old('virtual_tour', $data->no_bric_bathrooms) }}" autocomplete="virtual_tour">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="similar_properties" class="col-form-label">{{ __('Similar Properties') }}</label>
                                                    <input id="similar_properties" type="text" class="form-control @error('similar_properties') is-invalid @enderror" name="similar_properties" value="{{ old('similar_properties', $data->no_bric_bathrooms) }}" autocomplete="similar_properties">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 d-flex justify-content-center gap-2">
                                    <a href="{{ URL::previous() }}" class="btn btn-danger shadow-sm" style="width:10%;">Cancel</a>
                                    <button type="submit" class="btn btn-success shadow-sm" style="width:10%;">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
            $( ".has-datepicker" ).datepicker({
                dateFormat: "dd-mm-yy",
                onSelect: function(date) {
                }
            });

            var now = new Date();
            var date = moment(now).format('DD/MM/YYYY');
            $('#cay_contract_status_log, #nay_contract_status_log').val(date + ' - ');

            $('#cay_contract_status_log, #nay_contract_status_log').on('keypress', function(e) {
                // Check if the pressed key is Enter (key code 13) and if there is no shift key pressed
                if (e.which == 13 && !e.shiftKey) {
                    // Do something when a new line is entered
                    // Get the current date and time
                    var now = new Date();
                    var date = moment(now).format('DD/MM/YYYY');
                    // var time = now.toLocaleTimeString();
                    var dateTime = date + ' - ';
                    // Get the textarea value and add the date and time to a new line
                    var textarea = $(this);
                    var value = textarea.val();
                    textarea.val(value + '\n' + dateTime);
                    e.preventDefault();
                }
            });
        });
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
        function formatWholeNumber(price){
            var numberValue = price;
            numberValue = numberValue.split(',').join('');
            return numberValue;
        }
    </script>
@endpush
@endsection
