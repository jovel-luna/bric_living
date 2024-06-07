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
                    <li class="breadcrumb-item active">Advance Search</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <table id="property-search-table" class="table table-bordered letting-table property-list-table m-0" style="width:100%;">
                <thead>
                    <tr>
                        <th>Ref #</th>
                        <th>Postcode</th>
                        <th>City</th>
                        <th>Area</th>
                        <th>House No./Street</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>

@endsection

@push('scripts')
<script>
    function property_search(id = '', postcode = '', city = '', area = '', house_street_no = '') {

        var paginateStat = false;
        var locations = $('#locations-table').DataTable({
            language: {
                processing: 'Loading. Please wait...',
                search: "_INPUT_",
                searchPlaceholder: "Search",
                lengthMenu: "_MENU_"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "{{ route('location.index') }}",
                type: "GET",
                beforeSend: function() {
                    $('.loading-container').show();
                },
                data: {
                    id: id,
                    postcode: postcode,
                    city: city,
                    area: area,
                    house_street_no: house_street_no
                },
                dataSrc: function(json) {
                    console.log('Received data:', json); // Debug received data
                    return json.data; // Ensure it matches the structure expected by DataTables
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown); // Debug any AJAX errors
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: true
                },
                {
                    data: 'postcode',
                    name: 'postcode',
                    orderable: true
                },
                {
                    data: 'area',
                    name: 'area',
                    orderable: true
                },
                {
                    data: 'city',
                    name: 'city',
                    orderable: true
                },
                {
                    data: 'house_street_no',
                    name: 'house_street_no',
                    orderable: true
                },
                {
                    data: null,
                    orderable: false, // <i class="fa-solid fa-trash-can"></i>
                    render: function(data, type, row) {
                        return '<div class="action-btn d-flex gap-1 justify-content-center"><a href="' +
                            baseUrl + '/' + 'location/' + row.id +
                            '" id="view-txt-btn" class="view" title="View"><i class="view icon fa-regular fa-eye" style="color: #005eff;"></i></a></div>'; // Adjust this as needed
                    }
                }
            ]
        });
    }

    // Initialize the DataTable
    $(document).ready(function() {
        $('#property-search-table').DataTable({
            language: {
                processing: 'Loading. Please wait...',
                search: "_INPUT_",
                searchPlaceholder: "Search",
                lengthMenu: "_MENU_"
            }
        })
        // property_search();
    });
</script>
@endpush