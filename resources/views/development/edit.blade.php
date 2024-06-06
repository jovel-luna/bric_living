@extends('layouts.app', ['pageSlug' => 'development-edit'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Development</h1>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Development</li>
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
                        <h6 class="m-0 font-weight-bold">Edit Development</h6>
                    </div>
                    <div class="card-body">
                        <form id='editDevelopmentForm'>
                            @method('PATCH')
                            @csrf
                            <div class="card card-secondary shadow mb-4 p-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold">Development Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <!-- Development Overview -->
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Existing Beds -->
                                                    <div class="mb-3 form-group">
                                                        <label for="existing_beds" class="col-form-label">{{ __('Existing Beds') }}</label>
                                                        <input id="existing_beds" type="text" class="form-control @error('existing_beds') is-invalid @enderror" name="existing_beds" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{ old('existing_beds', $data->existing_bedroom_no) }}" autocomplete="existing_beds">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Existing Stories -->
                                                    <div class="mb-3 form-group">
                                                        <label for="existing_stories" class="col-form-label">{{ __('Existing Stories') }}</label>
                                                        <input id="existing_stories" type="text" class="form-control @error('existing_stories') is-invalid @enderror" name="existing_stories" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{ old('existing_stories', $data->existing_stories) }}" autocomplete="existing_stories">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Bric Stories -->
                                                    <div class="mb-3 form-group">
                                                        <label for="bric_stories" class="col-form-label">{{ __('Bric Stories') }}</label>
                                                        <input id="bric_stories" type="text" class="form-control @error('bric_stories') is-invalid @enderror" name="bric_stories" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{ old('bric_stories', $data->bric_stories) }}" autocomplete="bric_stories">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Bric Beds -->
                                                    <div class="mb-3 form-group">
                                                        <label for="bric_beds" class="col-form-label">{{ __('Bric Beds') }}</label>
                                                        <input id="bric_beds" type="text" class="form-control @error('bric_beds') is-invalid @enderror" name="bric_beds" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{ old('bric_beds', $data->no_bric_beds) }}" autocomplete="bric_beds">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Project Start Date -->
                                                    <div class="mb-3 form-group">
                                                        <label for="project_start_date" class="col-form-label">{{ __('Project Start Date') }}<span class="isRequired"> * </span></label>
                                                        <input id="project_start_date" type="text" class="form-control @error('project_start_date') is-invalid @enderror has-datepicker" name="project_start_date" value="{{ old('project_start_date', $data->project_start_date) }}" placeholder="dd-mm-yyyy" autocomplete="project_start_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Projected Completion Date -->
                                                    <div class="mb-3 form-group">
                                                        <label for="projected_completion_date" class="col-form-label">{{ __('Projected Completion Date') }}<span class="isRequired"> * </span></label>
                                                        <input id="projected_completion_date" type="text" class="form-control @error('projected_completion_date') is-invalid @enderror has-datepicker" name="projected_completion_date" value="{{ old('projected_completion_date', $data->projected_completion_date) }}" placeholder="dd-mm-yyyy" autocomplete="projected_completion_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Over running? -->
                                                    <div class="mb-3">
                                                        <?php
                                                            if ($data->project_start_date != '' && $data->projected_completion_date != '') {
                                                                $now = date('d-m-Y');
                                                                $projected = $data->projected_completion_date;
                                
                                                                $dateNow = DateTime::createFromFormat('d-m-Y', $now);
                                                                $dataProjected = DateTime::createFromFormat('d-m-Y', $projected);
                                
                                                                // Calculate the difference between the dates
                                                                $interval = $dateNow->diff($dataProjected);
                                
                                                                // Access the difference in days
                                                                $diffInDays = $interval->days;
                                                                $overrunning = $diffInDays;
                                                            }
                                                        ?>
                                                        <label for="over_running" class="col-form-label">{{ __('Over running (days)') }}</label>
                                                        <input id="over_running" type="text" class="form-control @error('over_running') is-invalid @enderror is-disabled" name="over_running" value="{{ old('over_running', $overrunning ?? '') }}" autocomplete="over_running">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Development Status -->
                                                    <div class="mb-3 form-group">
                                                        <label for="development_status" class="col-form-label">{{ __('Development Status') }}</label>
                                                        <select name="development_status" id="development_status" class="form-control form-control-alternative{{ $errors->has('development_status') ? ' is-invalid' : '' }}">
                                                            <option value="">Please Select</option>
                                                            <option value="Pre-start (occupied)" {{ $data->development_status == 'Pre-start (occupied)' ? 'selected' : '' }}>Pre-start (occupied)</option>
                                                            <option value="Pre-start (vacant)" {{ $data->development_status == 'Pre-start (vacant)' ? 'selected' : '' }}>Pre-start (vacant)</option>
                                                            <option value="On Site" {{ $data->development_status == 'On Site' ? 'selected' : '' }}>On Site</option>
                                                            <option value="Completed" {{ $data->development_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-secondary shadow mb-4 p-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold">Contact Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <!-- Principal Contractor -->
                                            <label class="col-form-label document-label">Principal Contractor</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Principal Contractor Company -->
                                                    <div class="mb-3 form-group">
                                                        <label for="pc_company" class="col-form-label">{{ __('Company') }}</label>
                                                        <input id="pc_company" type="text" class="form-control @error('pc_company') is-invalid @enderror" name="pc_company" value="{{ old('pc_company', $data->pc_company) }}" autocomplete="pc_company">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Principal Contractor Name -->
                                                    <div class="mb-3 form-group">
                                                        <label for="pc_name" class="col-form-label">{{ __('Name') }}</label>
                                                        <input id="pc_name" type="text" class="form-control @error('pc_name') is-invalid @enderror" name="pc_name" value="{{ old('pc_name', $data->pc_name) }}" autocomplete="pc_name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Principal Contractor Mobile -->
                                                    <div class="mb-3 form-group">
                                                        <label for="pc_mobile" class="col-form-label">{{ __('Mobile') }}</label>
                                                        <input id="pc_mobile" type="text" class="form-control @error('pc_mobile') is-invalid @enderror" name="pc_mobile" value="{{ old('pc_mobile', $data->pc_mobile) }}" autocomplete="pc_mobile">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Principal Contractor Email -->
                                                    <div class="mb-3 form-group">
                                                        <label for="pc_email" class="col-form-label">{{ __('Email') }}</label>
                                                        <input id="pc_email" type="text" class="form-control @error('pc_email') is-invalid @enderror" name="pc_email" value="{{ old('pc_email', $data->pc_email) }}" autocomplete="pc_email">
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="col-form-label document-label">Building Control</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Building Control Company -->
                                                    <div class="mb-3 form-group">
                                                        <label for="bc_company" class="col-form-label">{{ __('Company') }}</label>
                                                        <input id="bc_company" type="text" class="form-control @error('bc_company') is-invalid @enderror" name="bc_company" value="{{ old('bc_company', $data->bc_company) }}" autocomplete="bc_company">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Building Control Name -->
                                                    <div class="mb-3 form-group">
                                                        <label for="bc_name" class="col-form-label">{{ __('Name') }}</label>
                                                        <input id="bc_name" type="text" class="form-control @error('bc_name') is-invalid @enderror" name="bc_name" value="{{ old('bc_name', $data->bc_name) }}" autocomplete="bc_name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Building Control Mobile -->
                                                    <div class="mb-3 form-group">
                                                        <label for="bc_mobile" class="col-form-label">{{ __('Mobile') }}</label>
                                                        <input id="bc_mobile" type="text" class="form-control @error('bc_mobile') is-invalid @enderror" name="bc_mobile" value="{{ old('bc_mobile', $data->bc_mobile) }}" autocomplete="bc_mobile">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Building Control Email -->
                                                    <div class="mb-3 form-group">
                                                        <label for="bc_email" class="col-form-label">{{ __('Email') }}</label>
                                                        <input id="bc_email" type="text" class="form-control @error('bc_email') is-invalid @enderror" name="bc_email" value="{{ old('bc_email', $data->bc_email) }}" autocomplete="bc_email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-secondary shadow mb-4 p-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold">Development Budget</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <!-- Development Budget -->
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Overall Budget -->
                                                    <div class="mb-3 form-group">
                                                        <label for="overall_budget" class="col-form-label">{{ __('Overall Budget') }}</label>
                                                        <input id="overall_budget" onkeyup="formatNumber(this.id)" type="text" class="form-control @error('overall_budget') is-invalid @enderror" name="overall_budget" value="{{ old('overall_budget', $data->overall_budget) }}" autocomplete="overall_budget">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Actual Spend -->
                                                    <div class="mb-3 form-group">
                                                        <label for="actual_spend" class="col-form-label">{{ __('Actual Spend') }}</label>
                                                        <input id="actual_spend" onkeyup="formatNumber(this.id)" type="text" class="form-control @error('actual_spend') is-invalid @enderror" name="actual_spend" value="{{ old('actual_spend', $data->actual_spend) }}" autocomplete="actual_spend">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Difference -->
                                                    <div class="mb-3">
                                                        <?php
                                                            if ($data->overall_budget != '' && $data->actual_spend != '') {
                                                                $difference = $data->overall_budget - $data->actual_spend;
                                                            }else{
                                                                $difference = '';
                                                            }
                                                        ?>
                                                        <label for="difference" class="col-form-label">{{ __('Difference') }}</label>
                                                        <input id="difference" type="text" class="form-control is-disabled" value="{{ $difference }}">
                                                    </div>
                                                </div>
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
    </section>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
            $( ".has-datepicker" ).datepicker({
                dateFormat: "dd-mm-yy",
                onSelect: function(date) {
                    switch ($(this).attr('name')) {
                        case 'projected_completion_date':
                            checkOverrunning();
                            break;
                        default:
                            break;
                    }
                }
            });



            // $("form").submit(function(e){
            //     e.preventDefault();
            //     const fData = new FormData(e.target);
            //     let formData = {};

            //     const form = e.currentTarget;
            //     if (form.checkValidity() === false) {
            //         e.stopPropagation();
            //     } else {
            //         fData.forEach((value, key) => {
            //             formData[key] = value;
            //         });
            //     }

            //     jQuery.ajax({
            //         url: "{{ route('operation.update', $data->id) }}",
            //         method: 'put',
            //         data: {
            //             formData: formData,
            //         },
            //         success: function(response){
            //             if (response['data'] === 'Success') {
            //                 Swal.fire({
            //                 title: 'Success',
            //                 text: "Operation Successfully Updated!",
            //                 icon: 'success',
            //                 showCancelButton: false,
            //                 confirmButtonColor: '#3085d6',
            //                 cancelButtonColor: '#d33',
            //                 confirmButtonText: 'Continue'
            //                 }).then((result) => {
            //                     if (result.isConfirmed) {
            //                         window.location.href = "{{ URL::previous() }}";
            //                     }else{
            //                         window.location.href = "{{ URL::previous() }}";
            //                     }
            //                 })
            //             }
            //         }
            //     });
            // });

            $.validator.setDefaults({
                submitHandler: function (e) {
                    
                    const fData = $(e).serializeArray();
                    let formData = {};
                    fData.forEach((value, key) => {
                        formData[value['name']] = value['value'];
                    });
                    $.ajax({
                        url: "{{ route('development.update', $data->id) }}",
                        method: 'put',
                        data: {
                            formData: formData,
                        },
                        success: function(response){
                            if (response['data'] === 'Success') {
                                Swal.fire({
                                title: 'Success',
                                text: "Development Successfully Updated!",
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
                    return false;
                }
            });

            $('#editDevelopmentForm').validate({
                rules: {
                    project_start_date: {
                        required: true,
                    },
                    projected_completion_date: {
                        required: true,
                    },
          
                    pc_email: {
                        email: true,
                    },
                    bc_email: {
                        email: true,
                    }
                },
                messages: {
                    project_start_date: {
                        required: "Please select a date",
                    },
                    projected_completion_date: {
                        required: "Please select a date",
                    },
                    development_status: {
                        required: "Please choose an option",
                    },
                    pc_email: {
                        email: "Please enter a valid email address"
                    },
                    bc_email: {
                        email: "Please enter a valid email address"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    // Swal.fire({
                    //     title: 'Please fill out all required fields',
                    //     confirmButtonText: 'Continue',
                    //     icon: 'warning',
                    // });
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            function checkOverrunning(){
                var now = moment().format('YYYY-MM-DD');
                var dateString = $("#projected_completion_date").datepicker('getDate');
                var dateFormat = 'DD-MM-YYYY';
                const date = moment(dateString, dateFormat);
                if (moment(date).isAfter(now)) {
                    const dateDiff = moment(now).diff(moment(date).format('YYYY-MM-DD'), 'days');
                    $('#over_running').val(Math.abs(dateDiff));
                }else{
                    $('#over_running').val(0);
                }
            }

            $(document).on('blur', '#overall_budget, #actual_spend', function(e){
                
                if ($('#overall_budget').val() != "" && $('#actual_spend').val() != "") {
                    var ob = formatWholeNumber($('#overall_budget').val());
                    var as = formatWholeNumber($('#actual_spend').val());
                    var diff = ob - as;
                    $('#difference').val(parseInt(Math.round(diff)).toLocaleString());
                }else{
                    $('#difference').val("");
                }

            })
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
