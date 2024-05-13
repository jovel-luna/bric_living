@extends('layouts.app', ['pageSlug' => 'create-expenditure-page'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Expenditure</h1>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Expenditure</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-end mb-4 gap-2">
            <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>
        <form action="{{ route('store.expenditure', $data->id) }}" method="post">
            @csrf
            <div class="card card-secondary shadow mb-4 p-0">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold">{{ __('Expenditure Details') }}</h6>
                </div>
                <div class="card-body">
                    <!-- Expenditure -->
                    <input type="hidden" id="no_bric_beds" name="no_bric_beds" value="{{ $data->no_bric_beds }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Budget Year -->
                                        <div class="mb-3">
                                            <label for="expenditure_year" class="col-form-label">{{ __('Budget Year') }}</label>
                                            <input type="text" class="form-control @error('expenditure_year') is-invalid @enderror" name="expenditure_year" id="expenditure_year" value="{{ old('expenditure_year') }}" autocomplete="expenditure_year" placeholder="YYYY">
                                            @error('expenditure_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- HMO Licence Fee -->
                                        <div class="mb-3">
                                            <label for="hmo_licence_fee" class="col-form-label">{{ __('HMO Licence Fee') }}</label>
                                            <input id="hmo_licence_fee" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('hmo_licence_fee') is-invalid @enderror" name="hmo_licence_fee" value="{{ old('hmo_licence_fee') }}" autocomplete="hmo_licence_fee">

                                            @error('hmo_licence_fee')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- HMO Licence Period -->
                                        <div class="mb-3">
                                            <label for="hmo_licence_period" class="col-form-label">{{ __('HMO Licence Period') }}</label>
                                            <input id="hmo_licence_period" type="text" class="form-control @error('hmo_licence_period') is-invalid @enderror" name="hmo_licence_period" value="{{ old('hmo_licence_period') }}" autocomplete="hmo_licence_period">

                                            @error('hmo_licence_period')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- HMO Fee per year -->
                                        <div class="mb-3">
                                            <label for="hmo_fee_per_year" class="col-form-label">{{ __('HMO Fee per year') }}</label>
                                            <input id="hmo_fee_per_year" type="text" class="form-control @error('hmo_fee_per_year') is-invalid @enderror is-disabled" name="hmo_fee_per_year" value="{{ old('hmo_fee_per_year') }}" autocomplete="hmo_fee_per_year">

                                            @error('hmo_fee_per_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Maintenance/property/year -->
                                        <div class="mb-3">
                                            <label for="maintenance_property_year" class="col-form-label">{{ __('Maintenance/property/year') }}</label>
                                            <input id="maintenance_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('maintenance_property_year') is-invalid @enderror" name="maintenance_property_year" value="{{ old('maintenance_property_year') }}" autocomplete="maintenance_property_year">
                        
                                            @error('maintenance_property_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Maintenance/bed/year -->
                                        <div class="mb-3">
                                            <label for="maintenance_bed_year" class="col-form-label">{{ __('Maintenance/bed/year') }}</label>
                                            <input id="maintenance_bed_year" type="text" class="form-control @error('maintenance_bed_year') is-invalid @enderror is-disabled" name="maintenance_bed_year" value="{{ old('maintenance_bed_year') }}" autocomplete="maintenance_bed_year">
                        
                                            @error('maintenance_bed_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Gas/property/year -->
                                        <div class="mb-3">
                                            <label for="gas_property_year" class="col-form-label">{{ __('Gas/property/year') }}</label>
                                            <input id="gas_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('gas_property_year') is-invalid @enderror" name="gas_property_year" value="{{ old('gas_property_year') }}" autocomplete="gas_property_year">
                        
                                            @error('gas_property_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Gas/bed/year -->
                                        <div class="mb-3">
                                            <label for="gas_bed_year" class="col-form-label">{{ __('Gas/bed/year') }}</label>
                                            <input id="gas_bed_year" type="text" class="form-control @error('gas_bed_year') is-invalid @enderror is-disabled" name="gas_bed_year" value="{{ old('gas_bed_year') }}" autocomplete="gas_bed_year">
                        
                                            @error('gas_bed_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Electricity/property/year -->
                                        <div class="mb-3">
                                            <label for="electricity_property_year" class="col-form-label">{{ __('Electricity/property/year') }}</label>
                                            <input id="electricity_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('electricity_property_year') is-invalid @enderror" name="electricity_property_year" value="{{ old('electricity_property_year') }}" autocomplete="electricity_property_year">
                        
                                            @error('electricity_property_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Electricity/bed/year -->
                                        <div class="mb-3">
                                            <label for="electricity_bed_year" class="col-form-label">{{ __('Electricity/bed/year') }}</label>
                                            <input id="electricity_bed_year" type="text" class="form-control @error('electricity_bed_year') is-invalid @enderror is-disabled" name="electricity_bed_year" value="{{ old('electricity_bed_year') }}" autocomplete="electricity_bed_year">
                        
                                            @error('electricity_bed_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Water/proprty/year -->
                                        <div class="mb-3">
                                            <label for="water_property_year" class="col-form-label">{{ __('Water/proprty/year') }}</label>
                                            <input id="water_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('water_property_year') is-invalid @enderror" name="water_property_year" value="{{ old('water_property_year') }}" autocomplete="water_property_year">
                        
                                            @error('water_property_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Water/bed/year -->
                                        <div class="mb-3">
                                            <label for="water_bed_year" class="col-form-label">{{ __('Water/bed/year') }}</label>
                                            <input id="water_bed_year" type="text" class="form-control @error('water_bed_year') is-invalid @enderror is-disabled" name="water_bed_year" value="{{ old('water_bed_year') }}" autocomplete="water_bed_year">
                        
                                            @error('water_bed_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Internet/property/year -->
                                        <div class="mb-3">
                                            <label for="internet_property_year" class="col-form-label">{{ __('Internet/property/year') }}</label>
                                            <input id="internet_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('internet_property_year') is-invalid @enderror" name="internet_property_year" value="{{ old('internet_property_year') }}" autocomplete="internet_property_year">
                            
                                            @error('internet_property_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- Internet/bed/year -->
                                        <div class="mb-3">
                                            <label for="internet_bed_year" class="col-form-label">{{ __('Internet/bed/year') }}</label>
                                            <input id="internet_bed_year" type="text" class="form-control @error('internet_bed_year') is-invalid @enderror is-disabled" name="internet_bed_year" value="{{ old('internet_bed_year') }}" autocomplete="internet_bed_year">
                            
                                            @error('internet_bed_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- TV Licence per house -->
                                        <div class="mb-3">
                                            <label for="tv_licence_per_house" class="col-form-label">{{ __('TV Licence per house') }}</label>
                                            <input id="tv_licence_per_house" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('tv_licence_per_house') is-invalid @enderror" name="tv_licence_per_house" value="{{ old('tv_licence_per_house') }}" autocomplete="tv_licence_per_house">
                            
                                            @error('tv_licence_per_house')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Property Insurance Annual Cost -->
                                        <div class="mb-3">
                                            <label for="property_annual_cost" class="col-form-label">{{ __('Property Insurance Annual Cost') }}</label>
                                            <input id="property_annual_cost" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('property_annual_cost') is-invalid @enderror" name="property_annual_cost" value="{{ old('property_annual_cost') }}" autocomplete="property_annual_cost">
                        
                                            @error('property_annual_cost')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Total OPEX Budget -->
                                        <div class="mb-3">
                                            <label for="total_opex_budget" class="col-form-label">{{ __('Total OPEX Budget') }}</label>
                                            <input id="total_opex_budget" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('total_opex_budget') is-invalid @enderror is-disabled" name="total_opex_budget" value="{{ old('total_opex_budget') }}" autocomplete="total_opex_budget">
                        
                                            @error('total_opex_budget')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="{{ URL::previous() }}" type="button" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        </div>
    </section>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {

            // Initialize the datepicker
            // $("#datepicker").datepicker({
            //     format: "yyyy",
            //     viewMode: "years", 
            //     minViewMode: "years",
            //     autoclose:true //to close picker once year is selected
            // });

            $("form").submit(function(e){
                e.preventDefault();
                var validateStatus = validateFields();

                if(validateStatus){
                    const fData = new FormData(e.target);
                    let formData = {};

                    const form = e.currentTarget;
                    if (form.checkValidity() === false) {
                        e.stopPropagation();
                    } else {
                        fData.forEach((value, key) => {
                            formData[key] = value;
                        });
                    }

                    jQuery.ajax({
                        url: "{{ route('store.expenditure', $data->id) }}",
                        method: 'post',
                        data: {
                            formData: formData,
                        },
                        success: function(response){
                            if (response['data'] === 'Success') {
                                Swal.fire({
                                title: 'Success',
                                text: "Expenditure Successfully Added!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Continue'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = baseUrl+"/property/details/"+response['id'];
                                    }else{
                                        window.location.href = baseUrl+"/property/details/"+response['id'];
                                    }
                                })
                            }
                        }
                    });
                }
            });

            function validateFields(){
                if ($("input[name='expenditure_year']").val() != '' && $("input[name='expenditure_year']").val() != null) {
                    return true;
                }else{
                    if ($("input[name='expenditure_year']").val() == "") { $("input[name='expenditure_year']").addClass("is-invalid") }
                    Swal.fire({
                        title: 'Please fill out all required fields',
                        confirmButtonText: 'Continue',
                        icon: 'warning',
                    })
                    return false;
                }
            }

            $(document).on('change', '#datepicker', function(e){
                $("input[name='expenditure_year']").removeClass("is-invalid")
            });


            // OPERATIONS
            var operationsAraayEI = [
                'hmo_licence_fee',
                'hmo_licence_period',
                'maintenance_property_year',
                'gas_property_year',
                'electricity_property_year',
                'water_property_year',
                'internet_property_year',
                'tv_licence_per_house',
                'property_annual_cost'
            ];
            $(document).on('blur', '#hmo_licence_fee, #hmo_licence_period, #maintenance_property_year, #gas_property_year, #electricity_property_year, #water_property_year, #internet_property_year, #tv_licence_per_house, #property_annual_cost', function(e){
                switch (e.target.name) {
                    case (operationsAraayEI.includes(e.target.name)? e.target.name : '') :
                            autoHmo();
                            autoMaintenance();
                            autoGas();
                            autoElectricity();
                            autoWater();
                            autoInternet();
                            autoTotalOpex();
                        break;
                    default:
                        break;
                }

            });

            // Operation Budget Auto Calculate

            // HMO
            function autoHmo(){
                if ($("#hmo_licence_fee").val() != "" && $("#hmo_licence_period").val() != "") {
                    var hmoLicebceFee = formatWholeNumber($("input[name='hmo_licence_fee']").val());
                    var getHmo = (hmoLicebceFee / $("#hmo_licence_period").val());
                    $("#hmo_fee_per_year").val(parseInt(Math.round(getHmo)).toLocaleString());
                }
            }
            // Maintenance
            function autoMaintenance(){
                if ($("#maintenance_property_year").val() != "" && $("#no_bric_beds").val() != "") {
                    var maintenaceProperty = formatWholeNumber($("input[name='maintenance_property_year']").val());
                    var getMaintenance = (maintenaceProperty / $("#no_bric_beds").val());
                    $("#maintenance_bed_year").val(parseInt(Math.round(getMaintenance)).toLocaleString());
                }
            }
            // Gas
            function autoGas(){
                if ($("#gas_property_year").val() != "" && $("#no_bric_beds").val() != "") {
                    var gasProperty = formatWholeNumber($("input[name='gas_property_year']").val());
                    var getGas = (gasProperty / $("#no_bric_beds").val());
                    $("#gas_bed_year").val(parseInt(Math.round(getGas)).toLocaleString());
                }
            }
            // Electricity
            function autoElectricity(){
                if ($("#electricity_property_year").val() != "" && $("#no_bric_beds").val() != "") {
                    var electricityProperty = formatWholeNumber($("input[name='electricity_property_year']").val());
                    var getElectricity = (electricityProperty / $("#no_bric_beds").val());
                    $("#electricity_bed_year").val(parseInt(Math.round(getElectricity)).toLocaleString());
                }
            }
            // Water
            function autoWater(){
                if ($("#water_property_year").val() != "" && $("#no_bric_beds").val() != "") {
                    var waterProperty = formatWholeNumber($("input[name='water_property_year']").val());
                    var getWater = (waterProperty / $("#no_bric_beds").val());
                    $("#water_bed_year").val(parseInt(Math.round(getWater)).toLocaleString());
                }
            }
            // Internet
            function autoInternet(){
                if ($("#internet_property_year").val() != "" && $("#no_bric_beds").val() != "") {
                    var internetProperty = formatWholeNumber($("input[name='internet_property_year']").val());
                    var getInternet = (internetProperty / $("#no_bric_beds").val());
                    $("#internet_bed_year").val(parseInt(Math.round(getInternet)).toLocaleString());
                }
            }
            function autoTotalOpex(){
                if ($("#hmo_fee_per_year").val() != "" || $("#maintenance_property_year").val() != "" || $("#gas_property_year").val() != "" || $("#electricity_property_year").val() != "" || $("#water_property_year").val() != "" || $("#internet_property_year").val() != "" || $("#tv_licence_per_house").val() != "" || $("#property_annual_cost").val() != "") {
                    var hmo_fee_per_year = $('#hmo_fee_per_year').val() != '' ? formatWholeNumber($('#hmo_fee_per_year').val()) : 0;
                    var maintenance_property_year = $('#maintenance_property_year').val() != '' ? formatWholeNumber($('#maintenance_property_year').val()) : 0;
                    var gas_property_year = $('#gas_property_year').val() != '' ? formatWholeNumber($('#gas_property_year').val()) : 0;
                    var electricity_property_year = $('#electricity_property_year').val() != '' ? formatWholeNumber($('#electricity_property_year').val()) : 0;
                    var water_property_year = $('#water_property_year').val() != '' ? formatWholeNumber($('#water_property_year').val()) : 0;
                    var internet_property_year = $('#internet_property_year').val() != '' ? formatWholeNumber($('#internet_property_year').val()) : 0;
                    var tv_licence_per_house = $('#tv_licence_per_house').val() != '' ? formatWholeNumber($('#tv_licence_per_house').val()) : 0;
                    var property_annual_cost = $('#property_annual_cost').val() != '' ? formatWholeNumber($('#property_annual_cost').val()) : 0;
                    var totalOpex = (parseInt(hmo_fee_per_year) + parseInt(maintenance_property_year) + parseInt(gas_property_year) + parseInt(electricity_property_year) + parseInt(water_property_year) + parseInt(internet_property_year) + parseInt(tv_licence_per_house) + parseInt(property_annual_cost));
                    $("#total_opex_budget").val(parseInt(Math.round(totalOpex)).toLocaleString());
                }
            }
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
