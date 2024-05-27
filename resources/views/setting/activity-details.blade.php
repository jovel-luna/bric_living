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
                                User: {{ $username->first_name }} {{ $username->middle_name }} {{ $username->last_name }} <br>
                                Action: {{$summary->description }} <br>
                                Location: {{$summary->location}}
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
                                        @if ($details)
                                            @foreach ($details as $item)
                                            <tr>                       
                                                <td>{{ $item->activity_field }} </td>
                                                <td> {{ $item->details }} </td>
                                            </tr>    
                                            @endforeach
                                        @else
                                            No Data Available
                                        @endif
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
