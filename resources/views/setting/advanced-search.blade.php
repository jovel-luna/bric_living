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
    function property_search_table(ref_no = '', postcode = '', city = '', area = '', house_street_no = '') {
        var table = $('#property-search-table').DataTable({
            destroy: true,
            pagingType: 'simple',
            // bFilter: false,
            bLengthChange: false, 
            language: {
                processing: 'Loading. Please wait...',
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search",
                emptyTable: 'No results matched your query'
            },
            processing: true,
            serverSide: true,
            // bPaginate: true,
            // ordering: false,
            // order: [],
            ajax: {
                url: "/search",
                type: "GET",
                beforeSend: function() {
                    $('.loading-container').show();
                }
            },
            columns: [{
                    data: 'ref_no',
                    name: 'ref_no',
                    orderable: false
                },
                {
                    data: 'postcode',
                    name: 'postcode',
                    orderable: false
                },
                {
                    data: 'city',
                    name: 'city',
                    orderable: false
                },
                {
                    data: 'area',
                    name: 'area',
                    orderable: false,

                },
                {
                    data: 'house_street_no',
                    name: 'house_street_no',
                    orderable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    render: function(data, type, row) {
                        return '<div class="action-btn d-flex gap-1 justify-content-center"><a href="" id="view-txt-btn" class="view" title="View"><i class="fa-regular fa-eye" style="color: #005eff;"></i></a></div>';
                    },
                },
            ]
        })

    }

    // Initialize the DataTable
    $(document).ready(function() {
        property_search_table(ref_no = '', postcode = '', city = '', area = '', house_street_no = '')
    });
</script>
@endpush