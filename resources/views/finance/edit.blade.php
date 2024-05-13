@extends('layouts.app', ['pageSlug' => 'finance'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Finance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Finance</li>
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
                <div class="d-sm-flex align-items-center justify-content-end mb-3 gap-2">
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                    </a>
                </div>
                <div id="reports" class="col-md-12">
                    <div class="card card-secondary shadow mb-4 p-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">{{ __('Edit Finance') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="card card-secondary shadow mb-4 p-0">
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold">{{ __('Current Mortgage / Bridging Loan') }}</h6>
                                </div>
                                <div class="card-body">
                                    test
                                </div>
                            </div>
                            <div class="card card-secondary shadow mb-4 p-0">
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold">{{ __('Mortgage') }}</h6>
                                </div>
                                <div class="card-body">
                                    test
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
