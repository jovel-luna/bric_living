@extends('layouts.app', ['pageSlug' => 'entity'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Entity List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Entities</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-end mb-4">
                    <!-- <h1 class="h3 mb-0 text-gray-800">Entity Details</h1> -->
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Entity Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Company Registration Number</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['company_registration_number'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Registered Address</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['registered_address'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Entity Date Created</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['entity_date_created'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Statement Due Date</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['statement_due_date'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Financial Year Start Date</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['financial_year_start_date'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Financial Year End Date</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['financial_year_end_date'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>No. Properties</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['no_of_properties'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>No. Beds</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['no_of_beds'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Pipeline</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['pipeline'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Current Rent Role</p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $entity['current_rent_role'] }}
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                                    <i class="fas fa-pencil fa-sm text-white-50"></i>
                                    EDIT
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- <div id="properties">
                    <div class="func-btns d-flex align-items-center justify-content-between mb-3">
                        <h4>Properties</h4>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>
                            Assign Property
                        </a>
                    </div>
                    <table class="table table-bordered property-table property-list-table">
                        <thead>
                            <tr>
                                <th>Property Phase</th>
                                <th>Entity</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>House Number/Street</th>
                                <th>Postcode</th>
                                <th>Beds</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div> -->
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
