@extends('layouts.app', ['pageSlug' => 'location'])
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Locations</h1>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Locations</li>
                    </ol>
                    <div class="func-btns d-flex align-items-center">
                        <a href="{{ route('location.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>
                            Add New
                        </a>
                    </div>
                    @if (!request()->is('acquisition') && hasAccess('can_import') === 'true')
                        <div class="form-actions">
                            <a href="{{ route('view.import') }}"
                                class="import-btn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <img src="{{ url('storage/image/excel.svg') }}" alt="Excel" style="width:20px;" />
                                Import
                            </a>
                        </div>
                    @endif
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
                            <strong>Success:</strong> {{ Session::get('success') }}
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <table id="locations-table" class="table table-bordered letting-table property-list-table m-0"
                        style="width:100%;">
                        <thead>
                            <tr>
                                <th>Ref ID</th>
                                <th>Postcode</th>
                                <th>Area</th>
                                <th>City</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function locations(id = '', postcode = '', city = '', area = '') {

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
            locations();
        });
    </script>
@endpush
