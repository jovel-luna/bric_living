@extends('layouts.app', ['pageSlug' => 'external-page'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 id="details-header" class="m-0">
                    External Property Info
                </h1>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">External Property</li>
                </ol>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex flex-column justify-content-center">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-end mb-4 gap-2">
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                </div>
                <div class="card card-secondary shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold">Property Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Property Phase:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['property_phase'] ? $data['property']['property_phase'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Entity</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['entity'] ? $data['property']['entity'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>City</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['city'] ? $data['property']['city'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Area</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['area'] ? $data['property']['area'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>House No./Street</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        @if($data['property']['house_no_or_name'] && $data['property']['street'])
                                            {{ $data['property']['house_no_or_name'] . ' ' . $data['property']['street'] }}
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Postcode</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['postcode'] ? $data['property']['postcode'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Bric Beds</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['no_bric_beds'] ? $data['property']['no_bric_beds'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Bric Bathrooms</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['no_bric_bathrooms'] ? $data['property']['no_bric_bathrooms'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Letting Status</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['letting_status_name'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Purchase Date:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['purchase_date'] != '00/00/0000' ? $data['property']['purchase_date'] : 'TBC'; }}
                                    </div>
                                </div>
                            </div>
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

        });
    </script>
@endpush
@endsection
