@extends('layouts.app', ['pageSlug' => 'details-page'])

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="details-header" class="m-0">
                        Edit Property
                    </h1>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Property</li>
                    </ol>
                </div>
            </div>

            <form method="POST" action="{{route('property.update' , $id)}}"  autocomplete="off" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="card card-secondary shadow mb-4 p-0">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold">{{ __('Property Info') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Property Phase -->
                                            <div class="mb-3">
                                                <label for="property_phase"
                                                    class="col-form-label">{{ __('Property Phase') }}<span
                                                        class="isRequired"> * </span></label>

                                                <div class="">
                                                    <?php
                                                    $propertyPhase = [
                                                        'Acquiring' => 'Acquiring',
                                                        'In Development' => 'In Development',
                                                        'Bric Property' => 'Bric Property',
                                                        'Inherited Tenant' => 'Inherited Tenant',
                                                    ];
                                                    ?>
                                                    <select name="property_phase" id="property_phase"
                                                        class="form-control form-control-alternative{{ $errors->has('property_phase') ? ' is-invalid' : '' }}">
                                                        <option value="">Please Select</option>
                                                        @if (old('property_phase'))
                                                            @foreach ($propertyPhase as $pPhase_key => $pPhase)
                                                                <option value="{{ $pPhase_key }}"
                                                                    {{ $pPhase_key === old('property_phase') ? 'selected' : '' }}>
                                                                    {{ $pPhase }}</option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($propertyPhase as $pPhase_key => $pPhase)
                                                                @if ($pPhase_key == $property->property_phase)
                                                                    <option value="{{ $pPhase_key }}" selected>
                                                                        {{ $pPhase }}</option>
                                                                @else
                                                                    <option value="{{ $pPhase_key }}">
                                                                        {{ $pPhase }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('property_phase')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Entity -->
                                            <div class="mb-3">
                                                <label for="entity" class="col-form-label">{{ __('Entity') }}<span
                                                        class="isRequired"> * </span></label>

                                                <div class="">

                                                    <select name="entity" id="entity"
                                                        class="form-control form-control-alternative">
                                                        <option value="">Please Select</option>
                                                        @foreach ($all_entities as $lsKey => $lsVal)
                                                            @if ($property_entity_id->entity_id == $lsVal->id)
                                                                <option value="{{ $lsVal->id }}" selected>
                                                                    {{ $lsVal->entity }}</option>
                                                            @else
                                                                <option value="{{ $lsVal->id }}">
                                                                    {{ $lsVal->entity }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    @error('entity')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- City -->
                                            <div class="mb-3">
                                                <label for="city" class="col-form-label">{{ __('City') }}<span
                                                        class="isRequired"> * </span></label>

                                                <div class="">
                                                    <input id="city" type="text"
                                                        class="form-control @error('city') is-invalid @enderror"
                                                        name="city" required value="{{ $location->city }}"
                                                        autocomplete="city" autofocus disabled>
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Area -->
                                            <div class="mb-3">
                                                <label for="area" class="col-form-label">{{ __('Area') }}<span
                                                        class="isRequired"> * </span></label>

                                                <div class="">
                                                    <input id="area" type="text"
                                                        class="form-control @error('area') is-invalid @enderror"
                                                        name="area" required value="{{ $location->area }}"
                                                        autocomplete="area" autofocus disabled>
                                                    @error('area')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Postcode -->
                                            <div class="mb-3">
                                                <label for="postcode" class="col-form-label">{{ __('Postcode') }}<span
                                                        class="isRequired"> * </span></label>

                                                <div class="">
                                                    <div class="form-group">
                                                        <select name="postcode" id="postcode"
                                                            class="form-control form-control-alternative">
                                                            <option value="">Please Select</option>
                                                            <option value="0">Add New</option>
                                                            @foreach ($all_locations as $lsKey => $lsVal)
                                                                @if ($location->postcode == $lsVal->postcode)
                                                                    <option value="{{ $lsVal->id }}" selected>
                                                                        {{ $lsVal->postcode }}</option>
                                                                @else
                                                                    <option value="{{ $lsVal->id }}">
                                                                        {{ $lsVal->postcode }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('postcode')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- House No. / House Name -->
                                            <div class="mb-3">
                                                <label for="house_no"
                                                    class="col-form-label">{{ __('House Number / House Name') }}<span
                                                        class="isRequired"> * </span></label>

                                                <div class="">
                                                    <input id="house_no" type="text"
                                                        class="form-control @error('house_no') is-invalid @enderror"
                                                        name="house_no" value="{{ $property->house_no_or_name }}"
                                                        autocomplete="house_no">

                                                    @error('house_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Street -->
                                            <div class="mb-3">
                                                <label for="street" class="col-form-label">{{ __('Street') }}<span
                                                        class="isRequired"> * </span></label>

                                                <div class="">
                                                    <input id="street" type="text"
                                                        class="form-control @error('street') is-invalid @enderror"
                                                        name="street" value="{{ $property->street }}"
                                                        autocomplete="street">

                                                    @error('street')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- No. of Bric Beds -->
                                            <div class="mb-3">
                                                <label for="no_bric_beds"
                                                    class="col-form-label">{{ __('No. of Bric Beds') }}</label>

                                                <div class="">
                                                    <input id="no_bric_beds" type="number" min="1"
                                                        max="99" placeholder="1-99"
                                                        class="form-control @error('no_bric_beds') is-invalid @enderror"
                                                        name="no_bric_beds" value="{{ $property->no_bric_beds }}"
                                                        autocomplete="no_bric_beds">

                                                    @error('no_bric_beds')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- No. of Bric Bathrooms -->
                                            <div class="mb-3">
                                                <label for="no_of_bric_bathroom"
                                                    class="col-form-label">{{ __('No. of Bric Bathrooms') }}</label>

                                                <div class="">
                                                    <input id="no_of_bric_bathroom" type="number" min="1"
                                                        max="99" placeholder="1-99"
                                                        class="form-control @error('no_of_bric_bathroom') is-invalid @enderror"
                                                        name="no_of_bric_bathroom"
                                                        value="{{ $property->no_bric_bathrooms }}"
                                                        autocomplete="no_of_bric_bathroom">

                                                    @error('no_of_bric_bathroom')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Status -->
                                            <div class="mb-3">
                                                <label for="status"
                                                    class="col-form-label">{{ __('Letting Status') }}<span
                                                        class="isRequired"> * </span></label>

                                                <div class="">
                                                    <select name="status" id="status"
                                                        class="form-control form-control-alternative">
                                                        <option value="">Please Select</option>
                                                        <option value="0">Add new letting status</option>
                                                        @foreach ($all_letting_status as $lsKey => $lsVal)
                                                            @if ($property->status == $lsVal->id)
                                                                <option value="{{ $lsVal->id }}" selected>
                                                                    {{ $lsVal->letting_status_name }}</option>
                                                            @else
                                                                <option value="{{ $lsVal->id }}">
                                                                    {{ $lsVal->letting_status_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    @error('status')
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

                    </div>
                </div>
                <div class="row mb-3 d-flex justify-content-center gap-2"><a
                        href="{{route('get.property-details' , $id)}}" class="btn btn-danger shadow-sm"
                        style="width: 10%;">Cancel</a> <button type="submit" class="btn btn-success shadow-sm"
                        style="width: 10%;" data-form-type="action">Update</button></div>

            </form>
        </div>
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

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            function request_postcode_location(id) {
                return new Promise((resolve, reject) => {
                    jQuery.ajax({
                        url: "{{ route('location.retrieve_instance') }}",
                        method: 'get',
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            // console.log(response)
                            resolve(response);

                        }
                    });
                });
            }

            $('#postcode').on('click', function(e) {
                request_postcode_location($(this).val()).then(response => {
                    var location = response.location
                    $('#area').val(location.area)
                    $('#city').val(location.city)

                }).catch(error => {
                    console.log(error)
                })
            })

            $(document).on('change', '#status', function(e){
                if (e.target.value != "") {
                    $(this).removeClass("is-invalid");
                }else{
                    // $(this).addClass("is-invalid");
                }
                switch (e.target.name) {
                    
                    case 'status':
                        if ($(this).val() == '0') {
                            $('#lettingStatusModal').modal('show');
                        }
                        break;
                    default:
                        break;
                }

            });
        })
    </script>
@endpush
