@extends('layouts.app', ['pageSlug' => 'operation-edit'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Operation Utilities and Services</h1>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Utilities</li>
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
                        <h6 class="m-0 font-weight-bold">Edit Utilities</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('operation.update', $data) }}" autocomplete="off" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <!-- Gas Provider -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Gas Provider -->
                                            <div class="mb-3">
                                                <label for="gas_provider" class="col-form-label">{{ __('Gas Provider') }}</label>
                                                <input id="gas_provider" type="text" class="form-control @error('gas_provider') is-invalid @enderror" name="gas_provider" value="{{ old('gas_provider', $data->gas_provider) }}" autocomplete="gas_provider">

                                                @error('gas_provider')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Gas Contact Start Date -->
                                            <div class="mb-3">
                                                <label for="gas_contract_start_date" class="col-form-label">{{ __('Gas Contact Start Date') }}</label>
                                                <input id="gas_contract_start_date" type="text" class="form-control @error('gas_contract_start_date') is-invalid @enderror has-datepicker" name="gas_contract_start_date" value="{{ old('gas_contract_start_date', $data->gas_contract_start_date) }}" placeholder="dd-mm-yyyy" autocomplete="gas_contract_start_date">

                                                @error('gas_contract_start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Gas Conract End Date -->
                                            <div class="mb-3">
                                                <label for="gas_contract_end_date" class="col-form-label">{{ __('Gas Conract End Date') }}</label>
                                                <input id="gas_contract_end_date" type="text" class="form-control @error('gas_contract_end_date') is-invalid @enderror has-datepicker" name="gas_contract_end_date" value="{{ old('gas_contract_end_date', $data->gas_contract_end_date) }}" placeholder="dd-mm-yyyy" autocomplete="gas_contract_end_date">

                                                @error('gas_contract_end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Gas Account number -->
                                            <div class="mb-3">
                                                <label for="gas_account_number" class="col-form-label">{{ __('Gas Account No.') }}</label>
                                                <input id="gas_account_number" type="number" class="form-control @error('gas_account_number') is-invalid @enderror" name="gas_account_number" value="{{ old('gas_account_number', $data->gas_account_number) }}" autocomplete="gas_account_number">

                                                @error('gas_account_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Electricity Provider -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Electric Provider -->
                                            <div class="mb-3">
                                                <label for="electric_provider" class="col-form-label">{{ __('Electric Provider') }}</label>
                                                <input id="electric_provider" type="text" class="form-control @error('electric_provider') is-invalid @enderror" name="electric_provider" value="{{ old('electric_provider', $data->electric_provider) }}" autocomplete="electric_provider">

                                                @error('electric_provider')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Electric Contract Start Date -->
                                            <div class="mb-3">
                                                <label for="electric_contract_start_date" class="col-form-label">{{ __('Electric Contract Start Date') }}</label>
                                                <input id="electric_contract_start_date" type="text" class="form-control @error('electric_contract_start_date') is-invalid @enderror has-datepicker" name="electric_contract_start_date" value="{{ old('electric_contract_start_date', $data->electric_contract_start_date) }}" placeholder="dd-mm-yyyy" autocomplete="electric_contract_start_date">

                                                @error('electric_contract_start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Electric Contract End Date -->
                                            <div class="mb-3">
                                                <label for="electric_contract_end_date" class="col-form-label">{{ __('Electric Contract End Date') }}</label>
                                                <input id="electric_contract_end_date" type="text" class="form-control @error('electric_contract_end_date') is-invalid @enderror has-datepicker" name="electric_contract_end_date" value="{{ old('electric_contract_end_date', $data->electric_contract_end_date) }}" placeholder="dd-mm-yyyy" autocomplete="electric_contract_end_date">

                                                @error('electric_contract_end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Electric Account Number -->
                                            <div class="mb-3">
                                                <label for="electric_account_number" class="col-form-label">{{ __('Electric Account No.') }}</label>
                                                <input id="electric_account_number" type="number" class="form-control @error('electric_account_number') is-invalid @enderror" name="electric_account_number" value="{{ old('electric_account_number', $data->electric_account_number) }}" autocomplete="electric_account_number">

                                                @error('electric_account_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Water Provider -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Water Provider -->
                                            <div class="mb-3">
                                                <label for="water_provider" class="col-form-label">{{ __('Water Provider') }}</label>
                                                <input id="water_provider" type="text" class="form-control @error('water_provider') is-invalid @enderror" name="water_provider" value="{{ old('water_provider', $data->water_provider) }}" autocomplete="water_provider">

                                                @error('water_provider')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Water Account No.-->
                                            <div class="mb-3">
                                                <label for="water_account_number" class="col-form-label">{{ __('Water Account No.') }}</label>
                                                <input id="water_account_number" type="number" class="form-control @error('water_account_number') is-invalid @enderror" name="water_account_number" value="{{ old('water_account_number', $data->water_account_number) }}" autocomplete="water_account_number">

                                                @error('water_account_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TV Licence -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- TV Licence -->
                                            <div class="mb-3">
                                                <label for="tv_licence" class="col-form-label">{{ __('TV Licence') }}</label>
                                                <select name="tv_licence" id="tv_licence" class="form-control form-control-alternative{{ $errors->has('tv_licence') ? ' is-invalid' : '' }}">
                                                    <option value="">Please Select</option>
                                                    <option value="1" {{ $data->tv_licence == 1 ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ $data->tv_licence == 0 ? 'selected' : '' }}>No</option>
                                                </select>  
                                                @error('tv_licence')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- TV Licence Start Date -->
                                            <div class="mb-3">
                                                <label for="tv_licence_contract_start_date" class="col-form-label">{{ __('TV Licence Start Date') }}</label>
                                                <input id="tv_licence_contract_start_date" type="text" class="form-control @error('tv_licence_contract_start_date') is-invalid @enderror has-datepicker" name="tv_licence_contract_start_date" value="{{ old('tv_licence_contract_start_date', $data->tv_licence_contract_start_date) }}" placeholder="dd-mm-yyyy" autocomplete="tv_licence_contract_start_date">


                                                @error('tv_licence_contract_start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- TV Licence End Date -->
                                            <div class="mb-3">
                                                <label for="tv_licence_contract_end_date" class="col-form-label">{{ __('TV Licence End Date') }}</label>
                                                <input id="tv_licence_contract_end_date" type="text" class="form-control @error('tv_licence_contract_end_date') is-invalid @enderror has-datepicker" name="tv_licence_contract_end_date" value="{{ old('tv_licence_contract_end_date', $data->tv_licence_contract_end_date) }}" placeholder="dd-mm-yyyy" autocomplete="tv_licence_contract_end_date">

                                                @error('tv_licence_contract_end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Broadband Provider -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Broadband Provider -->
                                            <div class="mb-3">
                                                <label for="broadband_provider" class="col-form-label">{{ __('Broadband Provider') }}</label>
                                                <input id="broadband_provider" type="text" class="form-control @error('broadband_provider') is-invalid @enderror" name="broadband_provider" value="{{ old('broadband_provider', $data->broadband_provider) }}" autocomplete="broadband_provider">

                                                @error('broadband_provider')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Broadband Account No. -->
                                            <div class="mb-3">
                                                <label for="broadband_account_number" class="col-form-label">{{ __('Broadband Account No.') }}</label>
                                                <input id="broadband_account_number" type="number" class="form-control @error('broadband_account_number') is-invalid @enderror" name="broadband_account_number" value="{{ old('broadband_account_number', $data->broadband_account_number) }}" autocomplete="broadband_account_number">

                                                @error('broadband_account_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Insurance -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Property Insurance Provider -->
                                            <div class="mb-3">
                                                <label for="insurance_provider" class="col-form-label">{{ __('Property Insurance Provider') }}</label>
                                                <input id="insurance_provider" type="text" class="form-control @error('insurance_provider') is-invalid @enderror" name="insurance_provider" value="{{ old('insurance_provider', $data->insurance_provider) }}" autocomplete="insurance_provider">

                                                @error('insurance_provider')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Property Insurance Start Date -->
                                            <div class="mb-3">
                                                <label for="insurance_start_date" class="col-form-label">{{ __('Property Insurance Start Date') }}</label>
                                                <input id="insurance_start_date" type="text" class="form-control @error('insurance_start_date') is-invalid @enderror has-datepicker" name="insurance_start_date" value="{{ old('insurance_start_date', $data->insurance_start_date) }}" placeholder="dd-mm-yyyy" autocomplete="insurance_start_date">

                                                @error('insurance_start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Property Insurance End Date -->
                                            <div class="mb-3">
                                                <label for="insurance_end_date" class="col-form-label">{{ __('Property Insurance End Date') }}</label>
                                                <input id="insurance_end_date" type="text" class="form-control @error('insurance_end_date') is-invalid @enderror has-datepicker" name="insurance_end_date" value="{{ old('insurance_end_date', $data->insurance_end_date) }}" placeholder="dd-mm-yyyy" autocomplete="insurance_end_date">

                                                @error('insurance_end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Insurance Policy No. -->
                                            <div class="mb-3">
                                                <label for="insurance_policy_no" class="col-form-label">{{ __('Insurance Policy No.') }}</label>
                                                <input id="insurance_policy_no" type="number" class="form-control @error('insurance_policy_no') is-invalid @enderror" name="insurance_policy_no" value="{{ old('insurance_policy_no', $data->insurance_policy_no) }}" autocomplete="insurance_policy_no">

                                                @error('insurance_policy_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Council Tax -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Council Tax Account No. -->
                                            <div class="mb-3">
                                                <label for="council_account_no" class="col-form-label">{{ __('Council Tax Account No.') }}</label>
                                                <input id="council_account_no" type="number" class="form-control @error('council_account_no') is-invalid @enderror" name="council_account_no" value="{{ old('council_account_no', $data->council_account_no) }}" autocomplete="council_account_no">

                                                @error('council_account_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Exempt -->
                                            <div class="mb-3">
                                                <label for="exempt" class="col-form-label">{{ __('Exempt') }}</label>
                                                <select name="exempt" id="exempt" class="form-control form-control-alternative{{ $errors->has('exempt') ? ' is-invalid' : '' }}">
                                                    <option value="">Please Select</option>
                                                    <option value="1" {{ $data->exempt == 1 ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ $data->exempt == 0 ? 'selected' : '' }}>No</option>
                                                </select>  
                                                @error('exempt')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Exemption Applied for -->
                                            <div class="mb-3">
                                                <label for="exemption_date" class="col-form-label">{{ __('Exemption Applied for') }}</label>
                                                <input id="exemption_date" type="text" class="form-control @error('exemption_date') is-invalid @enderror has-datepicker" name="exemption_date" value="{{ old('exemption_date', $data->exemption_date) }}" placeholder="dd-mm-yyyy" autocomplete="exemption_date">
                                                @error('exemption_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- Operation Log -->
                                    {{-- <div class="row">
                                        <div class="col-md-6">
                                            <!-- Operation Log -->
                                            <div class="mb-3">
                                                <label for="operation_log" class="col-form-label">{{ __('Operation Log') }}</label>
                                                {{$data->operation_log}}
                                                <textarea id="operation_log" rows="5" type="text" class="form-control @error('operation_log') is-invalid @enderror" name="operation_log" value="{{ old('operation_log') }}" autocomplete="operation_log" placeholder="Enter Operation Log...">{{$data->operation_log}}</textarea>
                                                @error('operation_log')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}
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
    </section>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
            $( ".has-datepicker" ).datepicker({
                dateFormat: "dd-mm-yy",
            });

            // // add date to textarea by default
            // var now = new Date();
            // var date = moment(now).format('DD/MM/YYYY h:mm:ss a');
            // if ($('#operation_log').val() == '' || $('#operation_log').val() == null) {
            //         $('#operation_log').val(date + ' - ');
            // }

            // $('#operation_log').on('keypress', function(e) {
            //     // Check if the pressed key is Enter (key code 13) and if there is no shift key pressed
            //     if (e.which == 13 && !e.shiftKey) {
            //         // Do something when a new line is entered
            //         // Get the current date and time
            //         var now = new Date();
            //         var date = moment(now).format('DD/MM/YYYY h:mm:ss a');
            //         // var time = now.toLocaleTimeString();
            //         var dateTime = date + ' - ';
            //         // Get the textarea value and add the date and time to a new line
            //         var textarea = $(this);
            //         var value = textarea.val();
            //         textarea.val(value + '\n' + dateTime);
            //         e.preventDefault();
            //     }
            // });

            $("form").submit(function(e){
                e.preventDefault();
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
                    url: "{{ route('operation.update', $data->id) }}",
                    method: 'put',
                    data: {
                        formData: formData,
                    },
                    success: function(response){
                        if (response['data'] === 'Success') {
                            Swal.fire({
                            title: 'Success',
                            text: "Operation Successfully Updated!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Continue'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ URL::previous() }}";
                                }else{
                                    window.location.href = "{{ URL::previous() }}";
                                }
                            })
                        }
                    }
                });
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
    </script>
@endpush
@endsection
