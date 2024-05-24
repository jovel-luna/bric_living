@extends('layouts.app', ['pageSlug' => 'show-contract-info'])
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Contract Info </h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex flex-column justify-content-center">
                <div class="card card-secondary shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold">Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Tenant:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        Sssssssss
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Contract Status</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        sssss
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Paid Deposits?</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        sssss
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Has Outstanding Documents?</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        sdsssss
                                    </div>
                                </div>
                                {{-- <div class="row">
                        <div class="col-md-4">
                            <p><strong>House No./Street</strong></p>
                        </div>
                        <div class="col-md-6">
                            ssss
                            
                        </div>
                    </div> --}}
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Source</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        sssss
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>ID Certified?</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        sssss
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>POAs?</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        sssss
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Notes</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-info btn-xs view-tenant-notes ml-1"
                                            data-id="'+response['data']['id']+'">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-notes" width="18" height="18"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z">
                                                </path>
                                                <path d="M9 7l6 0"></path>
                                                <path d="M9 11l6 0"></path>
                                                <path d="M9 15l4 0"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                {{-- <div class="row">
                        <div class="col-md-4">
                            <p><strong>Purchase Date:</strong></p>
                        </div>
                        <div class="col-md-6">
                            sssss
                        </div>
                    </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
