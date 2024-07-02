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
            <form method="post" action="{{route('report.store')}}">
                @csrf
                <div id="reports" class="col-md-12">
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Entity') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple" name='entities[]'>
                                    @foreach($entities as $entity)
                                    <option value="{{ $entity->id }}">{{ $entity->entity }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Location') }}</h6>
                        </div>
                        <div class="card-body">

                            <h6 class="m-0 font-weight-bold">{{ __('City') }}</h6>

                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple" name='cities[]'>
                                    @foreach($locations as $loc)
                                    <option value="{{ $loc->city }}">{{ $loc->city }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h6 class="m-0 font-weight-bold">{{ __('Area') }}</h6>
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple" name='area[]'>
                                    @foreach($locations as $loc)
                                    <option value="{{ $loc->area }}">{{ $loc->area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Property Info') }}</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="m-0 font-weight-bold">{{ __('Property Phase') }}</h6>
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option value='Bric Property'>Bric Property</option>
                                    <option value='Inherited Tenant'>Inherited Tenant</option>
                                    <option value='In Development'>In Development</option>
                                    <option value='Acquiring'>Acquiring</option>
                                </select>
                            </div>

                            <h6 class="m-0 font-weight-bold">{{ __('Letting Status') }}</h6>
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    @foreach($letting_status as $status)
                                    <option value="{{ $status->letting_status_name }}">{{ $status->letting_status_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Acquisition') }}</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="m-0 font-weight-bold">{{ __('Acquisition Status') }}</h6>
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option value='Watching'>Watching</option>
                                    <option value='Analysing'>Analysing</option>
                                    <option value='Offer Made'>Offer Made</option>
                                    <option value='Offer Rejected'>Offer Rejected</option>
                                    <option value='Offer Accepted'>Offer Accepted</option>
                                    <option value='Exchanged'>Exchanged</option>
                                    <option value='Completed'>Completed</option>
                                </select>
                            </div>
                            <h6 class="m-0 font-weight-bold">{{ __('Single Asset / Portfolio') }}</h6>
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option value='Single Asset'>Single Asset</option>
                                    <option value='Portfolio'>Portfolio</option>
                                    <option value='Block'>Block</option>
                                </select>
                            </div>

                            <h6 class="m-0 font-weight-bold">{{ __('COL Status') }}</h6>
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option value='No Evidence Received'>No Evidence Received</option>
                                    <option value='Evidence Requested'>Evidence Requested</option>
                                    <option value='Partial Evidence Received'>Partial Evidence Received</option>
                                    <option value='All Evidence Received'>All Evidence Received</option>
                                    <option value='COL Submitted'>COL Submitted</option>
                                    <option value='COL Granted'>COL Granted</option>
                                </select>
                            </div>

                            <h6 class="m-0 font-weight-bold">{{ __('Tennure (Land Registry)') }}</h6>
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option value='Freehold'>Freehold</option>
                                    <option value='Leasehold'>Leasehold</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Development') }}</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="m-0 font-weight-bold">{{ __('Development Status') }}</h6>
                            <div class="form-group">
                                <select class="duallistbox" multiple="multiple">
                                    <option value='Pre start (occupied)'>Pre start (occupied)</option>
                                    <option value='Pre start (vacant)'>Pre start (vacant)</option>
                                    <option value='On site'>On site</option>
                                    <option value='Completed'>Completed</option>
                                </select>
                            </div>
                            <h6 class="m-0 font-weight-bold">{{ __('Principal Contractor Company') }}</h6>
                            <div class="form-group">
                                <label for="pc_company" class="col-form-label">{{ __('Company') }}</label>
                                <input id="pc_company" type="text" class="form-control" name="pc_company">
                            </div>
                            <h6 class="m-0 font-weight-bold">{{ __('Building Control Company') }}</h6>
                            <div class="form-group">
                                <label for="bc_company" class="col-form-label">{{ __('Company') }}</label>
                                <input id="bc_company" type="text" class="form-control" name="bc_company">
                            </div>

                        </div>
                    </div>
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Operations') }}</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="m-0 font-weight-bold">{{ __('Gas, Electric, and Water Providers') }}</h6>
                            <div class="form-group">
                                <label for="bc_company" class="col-form-label">{{ __('Gas Provider') }}</label>
                                <input id="bc_company" type="text" class="form-control" name="bc_company">

                                <label for="bc_company" class="col-form-label">{{ __('Electric Provider') }}</label>
                                <input id="bc_company" type="text" class="form-control" name="bc_company">
                                <label for="bc_company" class="col-form-label">{{ __('Water Provider') }}</label>
                                <input id="bc_company" type="text" class="form-control" name="bc_company">
                            </div>
                            <h6 class="m-0 font-weight-bold">{{ __('Broadband Provider') }}</h6>
                            <div class="form-group">
                                <label for="bc_company" class="col-form-label">{{ __('Broadband Provider') }}</label>
                                <input id="bc_company" type="text" class="form-control" name="bc_company">
                            </div>
                        </div>
                    </div>

                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Letting') }}</h6>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>

                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold">{{ __('Finance') }}</h6>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>

                    <button type="submit" id="repot-btn" class="btn btn-info d-flex gap-2 mx-auto">
                        <div class="excel-icon"></div>
                        <span>Generate Report</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.duallistbox').bootstrapDualListbox({
            selectorMinimalHeight: 200
        });
        $('.moveall').text('Select All');
        $('.removeall').text('Deselect All');
    });
</script>
@endpush
@endsection