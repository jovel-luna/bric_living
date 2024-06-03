@extends('layouts.app', ['pageSlug' => 'setting'])

@section('content')
    <div class="content-header">
        <div class="section">
            <div class="container-fluid">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Activity Details</h1>
                        
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Settings</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div>
                                <table class="table table-striped m-0"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Field</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
