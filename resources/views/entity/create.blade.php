@extends('layouts.app')

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New Entity </h1>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">New Entity</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 mb-5">
                    <form method="POST" action="{{ route('entity.store') }}">
                        @csrf
                        <div class="form-head-title-actions">
                            <div></div>
                            <div class="form-actions">
                                <a href="{{ route('entity.import') }}" class="import-btn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <img src="{{ url('storage/image/excel.svg') }}" alt="Excel"/>
                                    Import
                                </a>
                            </div>
                        </div>
                        <h6 class="mb-4">Entity Info <i class="fa-solid fa-folder-plus"></i></h6>
            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label document-label">{{ __('HMRC') }}</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <!-- Company Registration Number -->
                                            <div class="mb-3">
                                                <label for="company_registration_number" class="col-form-label">{{ __('Company Registration Number') }}<span class="isRequired"> * </span></label>
                                                <input id="company_registration_number" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('company_registration_number') is-invalid @enderror" name="company_registration_number" value="{{ old('company_registration_number') }}" autocomplete="company_registration_number" required>
            
                                                @error('company_registration_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- Entity -->
                                            <div class="mb-3">
                                                <label for="entity" class="col-form-label">{{ __('Entity Name') }}<span class="isRequired"> * </span></label>
                                                <input id="entity" type="text" class="form-control @error('entity') is-invalid @enderror" name="entity" value="{{ old('entity') }}" autocomplete="entity" required>
                                                @error('entity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- Registered Address -->
                                            <div class="mb-3">
                                                <label for="registered_address" class="col-form-label">{{ __('Registered Address') }}<span class="isRequired"> * </span></label>
                                                <input id="registered_address" type="text" class="form-control @error('registered_address') is-invalid @enderror" name="registered_address" value="{{ old('registered_address') }}" autocomplete="registered_address" required>
            
                                                @error('registered_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- Entity Date Created -->
                                            <div class="mb-3">
                                                <label for="entity_date_created" class="col-form-label">{{ __('Entity Date Created') }}<span class="isRequired"> * </span></label>
                                                <input id="entity_date_created" type="text" class="form-control @error('entity_date_created') is-invalid @enderror" name="entity_date_created" value="{{ old('entity_date_created') }}" placeholder="dd-mm-yyyy" required>
            
                                                @error('entity_date_created')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <!-- Statement Due Date -->
                                            <div class="mb-3">
                                                <label for="statement_due_date" class="col-form-label">{{ __('Statement Due Date') }}</label>
                                                <input id="statement_due_date" type="text" class="form-control @error('statement_due_date') is-invalid @enderror" name="statement_due_date" value="{{ old('statement_due_date') }}" placeholder="dd-mm-yyyy">
            
                                                @error('statement_due_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- Financial Year Start Date -->
                                            <div class="mb-3">
                                                <label for="financial_year_start_date" class="col-form-label">{{ __('Financial Year Start Date') }}<span class="isRequired"> * </span></label>
                                                <input id="financial_year_start_date" type="text" class="form-control @error('financial_year_start_date') is-invalid @enderror" name="financial_year_start_date" value="{{ old('financial_year_start_date') }}" placeholder="dd-mm-yyyy" required>
            
                                                @error('financial_year_start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <!-- Financial Year End Date -->
                                            <div class="mb-3">
                                                <label for="financial_year_end_date" class="col-form-label">{{ __('Financial Year End Date') }}<span class="isRequired"> * </span></label>
                                                <input id="financial_year_end_date" type="text" class="form-control @error('financial_year_end_date') is-invalid @enderror" name="financial_year_end_date" value="{{ old('financial_year_end_date') }}" placeholder="dd-mm-yyyy" required>
            
                                                @error('financial_year_end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="col-form-label document-label">{{ __('Portfolio') }}</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="mb-3">
                                                <label for="no_of_properties" class="col-form-label">{{ __('No. Properties') }}</label>
                                                <input id="no_of_properties" type="text" class="form-control @error('no_of_properties') is-invalid @enderror" name="no_of_properties" value="{{ old('no_of_properties') }}" autocomplete="no_of_properties">
            
                                                @error('no_of_properties')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_of_beds" class="col-form-label">{{ __('No. Beds') }}</label>
                                                <input id="no_of_beds" type="text" class="form-control @error('no_of_beds') is-invalid @enderror" name="no_of_beds" value="{{ old('no_of_beds') }}" autocomplete="no_of_beds">
            
                                                @error('no_of_beds')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="mb-3">
                                                <label for="pipeline" class="col-form-label">{{ __('Pipeline') }}</label>
                                                <input id="pipeline" type="text" class="form-control @error('pipeline') is-invalid @enderror" name="pipeline" value="{{ old('pipeline') }}" autocomplete="pipeline">
            
                                                @error('pipeline')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="current_rent_role" class="col-form-label">{{ __('Current Rent Role') }}</label>
                                                <input id="current_rent_role" type="text" class="form-control @error('current_rent_role') is-invalid @enderror" name="current_rent_role" value="{{ old('current_rent_role') }}" autocomplete="current_rent_role">
            
                                                @error('current_rent_role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="row justify-content-center">
                            <input type="submit" class="btn btn-success col-md-2" value="SAVE ENTITY">
                        </div>
            
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
<script>
        $(document).ready( function () {
            $( "#entity_date_created" ).datepicker({
                dateFormat: "dd-mm-yy",
                onSelect: function(edc) {
                }
            });
            $( "#statement_due_date" ).datepicker({
                dateFormat: "dd-mm-yy",
                onSelect: function(sdd) {
                }
            });
            $( "#financial_year_start_date" ).datepicker({
                dateFormat: "dd-mm-yy",
                onSelect: function(fysd) {
                }
            });
            $( "#financial_year_end_date" ).datepicker({
                dateFormat: "dd-mm-yy",
                onSelect: function(fyed) {
                    var statementDueDateValue = moment(fyed, "DD-MM-YYYY").subtract(6, 'months').format('DD-MM-YYYY');
                    $("#statement_due_date").val(statementDueDateValue);
                }
            });

            // $(document).on('change', '#financial_year_end_date', function(e){
            //     console.log("🚀 ~ file: create.blade.php:169 ~ $ ~ e", e.target.value)
            //     var financeYrEndDate = e.target.value;
            //     var statementDueDateValue = moment(financeYrEndDate, "YYYY-MM-DD").subtract(6, 'days').format('YYYY-MM-DD');
            
            //     $("#statement_due_date").val(statementDueDateValue);

            //     // Swal.fire({
            //     //     title: 'Working',
            //     //     confirmButtonText: 'Continue',
            //     //     icon: 'success',
            //     // })
            // });

            // $('form').submit(function(e){
            //     e.preventDefault();


            //     Swal.fire({
            //         title: 'Working',
            //         confirmButtonText: 'Continue',
            //         icon: 'success',
            //     })
            // });

            // $(document).on('change', '#entity', function(){
            //     var entityName = $(this).val();
            //     console.log("🚀 ~ file: create.blade.php:221 ~ $ ~ entityName", entityName)
            //     Swal.fire({
            //         title: 'Working',
            //         confirmButtonText: 'Continue',
            //         icon: 'success',
            //     })
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     jQuery.ajax({
            //         url: "{{ url('/get-proprty-entity') }}",
            //         method: 'get',
            //         data: {
            //             entity: entityName,
            //         },
            //         success: function(result){
            //             console.log(result)

            //         }
            //     });

            // });

            // var d = new Date();
            // console.log("🚀 ~ file: create.blade.php:247 ~ d", d)
            // Date.parse('2023-01-17 09:02:29');
            // console.log(Date.parse('2023-01-15 09:02:29')); 
            // console.log(moment().startOf('day').fromNow()); 
            // console.log(moment('2023-01-15 09:02:29').startOf('hour').fromNow()); 
        });
</script>
@endpush
@endsection