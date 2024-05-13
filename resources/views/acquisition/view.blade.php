@extends('layouts.app', ['pageSlug' => 'acquisition-page'])

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
            <div class="d-flex flex-column justify-content-center">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-end mb-4 gap-2">
                    <!-- <h1 class="h3 mb-0 text-gray-800">Entity Details</h1> -->
                    <a href="{{ url('acquisition/'. $acquisition->id .'/edit') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm edit-btn" data-id="{{ $acquisition->id }}">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                        EDIT
                    </a>
                    <a href="{{ route('acquisition.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                </div>
                <div class="card card-secondary shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold">Property Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Property Phase:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['property_phase'] ? $acquisition['property_phase'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Entity</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['entity'] ? $acquisition['entity'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>City</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['city'] ? $acquisition['city'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Area</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['area'] ? $acquisition['area'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>House No./Street</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        @if($acquisition['house_no_or_name'] && $acquisition['street'])
                                            {{ $acquisition['house_no_or_name'] . ' ' . $acquisition['street'] }}
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Postcode</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['postcode'] ? $acquisition['postcode'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Bric Beds</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['no_bric_beds'] ? $acquisition['no_bric_beds'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Bric Bathrooms</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['no_bric_bathrooms'] ? $acquisition['no_bric_bathrooms'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Letting Status</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['letting_status_name'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Purchase Date:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $acquisition['purchase_date'] != '00/00/0000' ? $acquisition['purchase_date'] : 'N/A'; }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-secondary shadow card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="acquisition-tab" data-toggle="pill"
                                    href="#acquisition" role="tab" aria-controls="acquisition"
                                    aria-selected="true">Acquisition</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="development-tab" data-toggle="pill"
                                    href="#development" role="tab" aria-controls="development"
                                    aria-selected="false">Developement</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="operation-tab" data-toggle="pill"
                                    href="#operation" role="tab" aria-controls="operation"
                                    aria-selected="false">Operations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="letting-tab" data-toggle="pill"
                                    href="#letting" role="tab" aria-controls="letting"
                                    aria-selected="false">Lettings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="finance-tab" data-toggle="pill"
                                    href="#finance" role="tab" aria-controls="finance"
                                    aria-selected="false">Finance</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="acquisition" role="tabpanel"
                                aria-labelledby="acquisition-tab">
                                @include('layouts.tabs.acquisition')
                            </div>
                            <div class="tab-pane fade" id="development" role="tabpanel"
                                aria-labelledby="development-tab">
                                @include('layouts.tabs.development')
                            </div>
                            <div class="tab-pane fade" id="operation" role="tabpanel"
                                aria-labelledby="operation-tab">
                                @include('layouts.tabs.operations')
                            </div>
                            <div class="tab-pane fade" id="letting" role="tabpanel"
                                aria-labelledby="letting-tab">
                                @include('layouts.tabs.lettings')
                            </div>
                            <div class="tab-pane fade" id="finance" role="tabpanel"
                                aria-labelledby="finance-tab">
                                @include('layouts.tabs.finance')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="colLogModal" tabindex="-1" role="dialog" aria-labelledby="colLogModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="colLogModalLabel">COL Logs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" rows="10" readonly>{{$acquisition['col_status_log']}}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {

        });
    </script>
@endpush
@endsection
