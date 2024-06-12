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
                            @if($details)
                            <p><strong>ID:</strong> {{$details->id}}</p>
                            <p><strong>Log Name:</strong> {{$details->log_name}}</p>
                            <p><strong>Description:</strong> {{$details->description}}</p>
                            <p><strong>Location:</strong> {{$details->location}}</p>
                            <p><strong>Created At:</strong> {{$details->created_at}}</p>
                            <p><strong>Updated At:</strong> {{$details->updated_at}}</p>
                            @endif


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
                            <!-- {{ $changes }} -->

                            @if($details)
                            @foreach($changes as $key => $value)
                            @php
                            // Define key mappings
                            $keyMappings = [
                            'old' => 'Old Data',
                            'attributes' => 'New Data',

                            ];

                            // Check if current key exists in the mappings
                            $renamedKey = array_key_exists($key, $keyMappings) ? $keyMappings[$key] : $key;
                            @endphp
                            @if(is_array($value))
                            <tr>
                                <td colspan="2"><strong>{{$renamedKey}}</strong></td>
                            </tr>
                            <table class="table table-striped m-0" style="width: 100%;">
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                                @foreach($value as $subKey => $subValue)
                                
                                @if($subValue != '')
                                <tr>

                                    <td>{{$subKey}}</td>

                                    <td>{{$subValue}}</td>
                                </tr>
                                @endif
                                @endforeach
                                @else
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$value}}</td>
                                </tr>
                                @endif
                            </table>
                            @endforeach
                            @else
                            <p>No activity found with the given ID.</p>
                            @endif


                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection