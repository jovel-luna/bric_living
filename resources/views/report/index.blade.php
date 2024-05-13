@extends('layouts.app', ['pageSlug' => 'report'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @if (Session::has('success'))
                    <div class="alert-container p-3">
                        <div class="alert alert-success p-3">
                            <strong>Success:</strong> {{Session::get('success')}}
                        </div>
                    </div>
                @endif
                <div id="reports" class="col-md-12">
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Property') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option>Property Phase</option>
                                    <option>City</option>
                                    <option>Area</option>
                                    <option>House No./ Street</option>
                                    <option>Postcode</option>
                                    <option>No. Bric Beds</option>
                                    <option>No. Bric Bathrooms</option>
                                    <option>Purchase Date</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Entity') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option>Entity Name</option>
                                    <option>Company Registration number</option>
                                    <option>Registered Address</option>
                                    <option>Statement Due Date</option>
                                    <option>Financial Year Start Date</option>
                                    <option>Financial Year End Date</option>
                                    <option>Pipeline</option>
                                    <option>Current rent role</option>
                                    <option>Date entity created</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Acquisition') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option>Acquisition Status</option>
                                    <option>Single Asset / Portfolio</option>
                                    <option>Portfolio</option>
                                    <option>Existing Bedroom No</option>
                                    <option>Stamp Duty</option>
                                    <option>Agent</option>
                                    <option>Agent Fee % (excl. VAT)</option>
                                    <option>Agent £</option>
                                    <option>Estimated TPC</option>
                                    <option>Offer Date</option>
                                    <option>Target Completion Date</option>
                                    <option>Completion Date</option>
                                    <option>Purchase Financing Status</option>
                                    <option>COL Status</option>
                                    <option>COL Log</option>
                                    <option>Bric Planning Ref #</option>
                                    <option>Date Submitted</option>
                                    <option>Approved</option>
                                    <option>Application Description</option>
                                    <option>Asking £</option>
                                    <option>Offer £</option>
                                    <option>Agreed £</option>
                                    <option>Price Difference +/-</option>
                                    <option>Acquisition Cost £</option>
                                    <option>Bridge Loan %</option>
                                    <option>Estimated bridge loan period (months)</option>
                                    <option>Loan %</option>
                                    <option>Estimated Interest £</option>
                                    <option>CAPEX Budget</option>
                                    <option>Valuation Yield %</option>
                                    <option>TPC / Bed Space</option>
                                    <option>Purchase Price / Bed Space</option>
                                    <option>Bric Y1 proposed rent PPPW</option>
                                    <option>Tenancy length (weeks)</option>
                                    <option>Tennure</option>
                                    <option>Ground Rent</option>
                                    <option>Grand Rent Due</option>
                                    <option>Insurance in Place</option>
                                    <option>Insurance Value</option>
                                    <option>Insurance Cost</option>
                                    <option>Insurance Renewal Date</option>
                                    <option>Insurance in Place</option>
                                    <option>Insurance Value</option>
                                    <option>Insurance Cost</option>
                                    <option>Insurance Renewal Date</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Development') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option>Existing Beds</option>
                                    <option>Exsiting Stories</option>
                                    <option>Bric Stories</option>
                                    <option>Project Start Date</option>
                                    <option>Projected Completion Date</option>
                                    <option>Over running</option>
                                    <option>Development Status</option>
                                    <option>Principal Contractor</option>
                                    <option>Building Control</option>
                                    <option>H&S Development Compliance</option>
                                    <option>Overall Budget</option>
                                    <option>Actual Spend</option>
                                    <option>Difference</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Operations') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option>Gas</option>
                                    <option>Electric</option>
                                    <option>Water</option>
                                    <option>Tv</option>
                                    <option>Broadband</option>
                                    <option>Property Insurance</option>
                                    <option>Council tax</option>
                                    <option>Log</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Lettings') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option>Alabama</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Finance') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option>Alabama</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="repot-btn" class="btn btn-info d-flex gap-2 mx-auto">
                        <div class="excel-icon"></div>
                        <span>Generate Report</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
            $('.duallistbox').bootstrapDualListbox({
                selectorMinimalHeight: 200
            });
            $('.moveall').text('Select All');
            $('.removeall').text('Diselect All');
        });
    </script>
@endpush
@endsection
