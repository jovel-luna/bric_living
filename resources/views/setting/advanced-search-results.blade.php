@extends('layouts.app', ['pageSlug' => 'advanced-search'])

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Advanced Search</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Advanced Search</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            @if ($results->count() > 0)
            <p>There are {{ $results->count() }} results for {{ $term }}.</p>

            <table id="property-search-table" class="table table-bordered letting-table property-list-table m-0" style="width:100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <!-- <th>Type</th> -->
                        <th>Property Phase</th>
                        <th>House No./Name</th>
                        <th>Street</th>
                        <th>No. of Bedrooms</th>
                        <th>No. of Bathrooms</th>
                        <th>Purchase Date</th>
                        <!-- <th>Status</th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (json_decode($results, true) as $result)
                    @if($result['type'] == 'properties')
                    <tr>
                        <td>{{ $result['searchable']['id'] }}</td>
                        <!-- <td>{{ $result['type'] }}</td> -->
                        <td>{{ $result['searchable']['property_phase'] }}</td>
                        <td>{{ $result['searchable']['house_no_or_name'] }}</td>
                        <td>{{ $result['searchable']['street'] }}</td>
                        <td>{{ $result['searchable']['no_bric_beds'] }}</td>
                        <td>{{ $result['searchable']['no_bric_bathrooms'] }}</td>
                        <td>{{ $result['searchable']['purchase_date'] }}</td>
                        <!-- <td>{{ $result['searchable']['status'] }}</td> -->
                        <td>
                            <a href="/property/details/{{ $result['searchable']['id'] }}?query={{ $term }}?id={{ $result['searchable']['id'] }}">Link</a>
                        </td>
                    </tr>

                    @else
                    <tr>
                        <td>{{ $result['searchable']['property']['id'] }}</td>
                        <!-- <td>{{ $result['type'] }}</td> -->
                        <td>{{ $result['searchable']['property']['property_phase'] }}</td>
                        <td>{{ $result['searchable']['property']['house_no_or_name'] }}</td>
                        <td>{{ $result['searchable']['property']['street'] }}</td>
                        <td>{{ $result['searchable']['property']['no_bric_beds'] }}</td>
                        <td>{{ $result['searchable']['property']['no_bric_bathrooms'] }}</td>
                        <td>{{ $result['searchable']['property']['purchase_date'] }}</td>
                        <!-- <td>{{ $result['searchable']['property']['status'] }}</td> -->
                        <td>
                            <a href="/property/details/{{ $result['searchable']['property']['id'] }}?query={{ $term }}?id={{ $result['searchable']['property']['id'] }}">Link</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No results found.</p>
            @endif
        </div>
    </div>
</section>

@endsection