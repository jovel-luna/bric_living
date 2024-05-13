@extends('layouts.app', ['pageSlug' => 'property-external'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">New External Property</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Property</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form method="POST" id="propertyForm" action="{{ route('property.store') }}">
                        @csrf
                        <div class="form-head-title-actions">
                            <div></div>
                            <div class="form-actions">
                                <a href="{{ route('view.import') }}" class="import-btn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <img src="{{ url('storage/image/excel.svg') }}" alt="Excel"/>
                                    Import
                                </a>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="propertyTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="new-property-info-tab" data-toggle="tab" href="#new-property-info" role="tab" aria-controls="new-property-info" aria-selected="true">Property Info</a>
                                    </li>
                                </ul>
            
                                <!-- Tab panes -->
                                <div class="tab-content mt-4">
                                    <!-- New Property -->
                                    <div class="tab-pane active" id="new-property-info" role="tabpanel" aria-labelledby="new-property-info-tab">
                                        @include('layouts.form.newproperty')
                                    </div>           
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="lettingStatusModal" tabindex="-1" role="dialog" aria-labelledby="lettingStatusModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="lettingStatusModalTitle">Add New Letting Status</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" id="lettingStatusForm" action="{{ route('letting-status.store') }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <div class="row">
                                <!-- Letting Status -->
                                <div class="mb-3">
                                    <label for="letting_status_name" class="col-form-label">{{ __('Letting Status Name') }}<span class="isRequired"> * </span></label>
                                    <input id="letting_status_name" type="text" class="form-control @error('letting_status_name') is-invalid @enderror" name="letting_status_name" value="{{ old('letting_status_name') }}" autocomplete="letting_status_name" required>

                                    @error('letting_status_name')
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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
            $(document).on('change', '#property_phase, #entity, #house_no, #street, #postcode', function(e){
                if (e.target.value != "") {
                    $(this).removeClass("is-invalid");
                }else{
                    $(this).addClass("is-invalid");
                }
                switch (e.target.name) {
                    case 'property_phase':
                        if($(this).val() === 'Acquiring'){
                            $("#status" ).val('2').removeClass('is-disabled');
                        }else{
                            $("#status" ).val("").removeClass('is-disabled');
                        }
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
            $("form#lettingStatusForm").submit(function(e){
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
                    url: "{{ route('letting-status.store') }}",
                    method: 'post',
                    data: formData,
                    success: function(response){
                        if (response['status'] == 1) {
                            Swal.fire({
                            title: 'Success',
                            text: formData['letting_status_name']+" Successfully Added!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Continue'
                            }).then((result) => {
                                var options = '<option value="">Please Select</option><option value="0">Add new letting status</option>';
                                $.each(response['data'], function (x, xVal) { 
                                    options += '<option value="'+xVal['id']+'">'+xVal['letting_status_name']+'</option>';
                                });
                                $('#status').html(options);
                                $('#lettingStatusModal').modal('hide');
                            })
                        }else{
                            Swal.fire({
                            title: 'Warning',
                            text: "Letting Status Name Already Exist!",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Continue'
                            }).then((result) => {
                                $('#letting_status_name').addClass('is-invalid');
                            }) 
                        }
                    }
                });
            });

            $("#lettingStatusModal").on('hide.bs.modal', function(){
                var formFields = $(this).find('.form-control');
                $.each(formFields, function (x) { 
                     $(this).val('');
                });
            });

            $("#postcode").on('keyup', function(e){
                var postcode = $(this).val();
                if (postcode) {
                    $.each(locationData, function (l, lVal) { 
                        if(lVal['postcode'] === postcode){
                            $('#city').val(lVal['region']);
                            $('#area').val(lVal['town']);
                            return false;
                        }else{
                            $('#city').val('');
                            $('#area').val('');
                        }
                    });
                }
            });

            $("#propertyForm").validate({
                rules: {
                    property_phase: {
                        required: true,
                    },
                    entity: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    area: {
                        required: true,
                    },
                    postcode: {
                        required: true,
                    },
                    house_no: {
                        required: true,
                    },
                    street: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    property_phase: {
                        required: "Please select property phase",
                    },
                    entity: {
                        required: "Please select entity",
                    },
                    city: {
                        required: "Please enter city",
                    },
                    area: {
                        required: "Please enter area",
                    },
                    postcode: {
                        required: "Please enter postcode",
                    },
                    house_no: {
                        required: "Please enter house number / house name",
                    },
                    street: {
                        required: "Please enter street",
                    },
                    status: {
                        required: "Please select letting status",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    // Serialize the form data
                    var formData = $(form).serialize();

                    // AJAX request
                    $.ajax({
                        url: "{{ route('property.store') }}",
                        method: 'post',
                        data: {
                            type: 'External',
                            formData: formData,
                        },
                        success: function(result){
                            if (result['data'] === 'Success') {
                                Swal.fire({
                                title: 'Success',
                                text: "Property Successfully Added!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Continue'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('home')}}";
                                    }else{
                                        window.location.href = "{{ route('home')}}";
                                    }
                                })
                            }
                        },
                        error: function (error) {
                            // Handle the error
                            console.error("Error submitting form:", error);
                        }
                    });

                    return false; // Prevents the default form submission
                },
            });
        });
    </script>
@endpush
@endsection
