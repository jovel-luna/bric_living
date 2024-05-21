@extends('layouts.app', ['pageSlug' => 'add-location'])
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Location </h1>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">New Location</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 mb-5">
                    <form method="POST" action="{{ route('location.update', $location->id) }}">
                        @csrf
                        @method('PUT')
                        <h6 class="mb-4">Location Info <i class="fa-solid fa-folder-plus"></i></h6>

                        <div class="row">

                            <!-- Postcode -->
                            <div class="col">
                                <label for="postcode" class="col-form-label">{{ __('Postcode') }}<span class="isRequired"> *
                                    </span></label>
                                <input id="postcode" type="text"
                                    class="form-control @error('entity') is-invalid @enderror" name="postcode"
                                    value="{{ $location->postcode }}" autocomplete="postcode" required>
                                @error('entity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- City -->
                            <div class="col">
                                <label for="city" class="col-form-label">{{ __('City') }}<span class="isRequired"> *
                                    </span></label>
                                <input id="city" type="text"
                                    class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ $location->city }}" autocomplete="city" required>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Area -->
                            <div class="mb-4">
                                <label for="area" class="col-form-label">{{ __('Area') }}<span class="isRequired"> *
                                    </span></label>
                                <input id="area" type="text"
                                    class="form-control @error('area') is-invalid @enderror" name="area"
                                    value="{{ $location->area }}" required>

                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                        </div>
                        <div class="row justify-content-center">
                            <input type="submit" class="btn btn-success col-md-2" value="UPDATE LOCATION">
                        </div>
                    </form>

                    <br>

                    <form method="POST" action="{{ route('location.destroy', $location->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="row justify-content-center">
                            <input type="submit" class="btn btn-danger col-md-2" value="DELETE LOCATION">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

{{-- 
@include('layouts.templates.popups.confirm-delete-action-popup')
@push('scripts')
    <script>
        function submit_confirmation(form) {
            // form.preventDefault
        }

    </script>
@endpush --}}

