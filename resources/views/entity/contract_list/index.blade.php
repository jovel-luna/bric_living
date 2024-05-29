@extends('layouts.app', ['pageSlug' => 'contract-info'])


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Contract Info</h1>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contract Info</li>
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
                            <strong>Success:</strong> {{ Session::get('success') }}
                        </div>
                    </div>
                @endif
                {{-- @include('layouts.templates.filter.filter-contracts') --}}
                <table id="contractInfoTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>Area</th>
                            <th>House No./Street</th>
                            <th>Contract Status</th>
                            <th>Paid Deposits?</th>
                            <th>Complete Documents?</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>City</th>
                            <th>Area</th>
                            <th>House No./Street</th>
                            <th>Contract Status</th>
                            <th>Paid Deposits?</th>
                            <th>Complete Documents?</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </section>
@endsection
@include('layouts.templates.popups.filter-popup-contracts')
@push('scripts')
    <script>
        function locations(city = '', area = '', name_street = '', tenant_contract_status = '', deposits_paid = '',
            document_outstanding =
            '') {

            var paginateStat = false;
            var locations = $('#contractInfoTable').DataTable({
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
                    url: "{{ route('lettings.contract-list') }}",
                    type: "GET",
                    beforeSend: function() {
                        $('.loading-container').show();
                    },
                    data: {
                        city: city,
                        area: area,
                        name_street: name_street,
                        tenant_contract_status: tenant_contract_status,
                        deposits_paid: deposits_paid,
                        document_outstanding: document_outstanding,

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
                        data: 'city',
                        name: 'city',
                        orderable: true,
                    },
                    {
                        data: 'area',
                        name: 'area',
                        orderable: true
                    },
                    {
                        data: 'name_street',
                        name: 'name_street',
                        orderable: true
                    },
                    {
                        data: 'tenant_contract_status',
                        name: 'tenant_contract_status',
                        orderable: true
                    },
                    {
                        data: 'deposits_paid',
                        name: 'deposits_paid',
                        orderable: true,
                        render: function(data, type, row) {
                            if (data == 1) {
                                data = "Yes"
                                return "Yes"
                            } else {
                                data = "No"
                                return "No"
                            }
                        }
                    },
                    {
                        data: 'document_outstanding',
                        name: 'document_outstanding',
                        orderable: true,
                        render: function(data, type, row) {
                            if (data == 1) {
                                data = "Yes"
                                return "Yes"
                            } else {
                                data = "No"
                                return "No"
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false, // <i class="fa-solid fa-trash-can"></i>
                        render: function(data, type, row) {
                            return '<div class="action-btn d-flex gap-1 justify-content-center"><a href="' +
                                baseUrl + '/' + 'property/details/' + row.id +
                                '?tenant_id=' + row.tenant_id +
                                '&contract_details=yes#letting-tab" id="view-txt-btn" class="view" title="View"><i class="view icon fa-regular fa-eye" style="color: #005eff;"></i></a></div>'; // Adjust this as needed
                        }
                    }
                ],
                initComplete: function() {

                    let AddressCol = this.api().column(2)
                    let AddressInput = document.querySelector("#address")
                    let areaCol = this.api().column(1)
                    let areaInput = document.querySelector("#area")
                    let cityCol = this.api().column()
                    let cityInput = document.querySelector("#city")

                    let statusCol = this.api().column(3)
                    let statusInput = document.querySelector("#status")
                    let depositsCol = this.api().column(4)
                    let depositsInput = document.querySelector("#deposits")
                    let docsCol = this.api().column(5)
                    let docsInput = document.querySelector("#docs")


                    let filterSubmit = document.querySelector("#filter-view")
                    let clearFilter = document.querySelector("#clear-filter")


                    filterSubmit.addEventListener('click', () => {
                        AddressCol.search(AddressInput.value).draw();
                        cityCol.search(cityInput.value).draw();
                        areaCol.search(areaInput.value).draw();

                        statusCol.search(statusInput.value).draw();
                        depositsCol.search(depositsInput.value).draw();
                        docsCol.search(docsInput.value).draw();
            
                    })

                    clearFilter.addEventListener('click', () => {
                        $('#close-modal').click()

                        AddressCol.search("").draw();
                        cityCol.search("").draw();
                        areaCol.search("").draw();

                        statusCol.search("").draw();
                        depositsCol.search("").draw();
                        docsCol.search("").draw();
            
                    })

                }
            });

            var element = `
                        <div class="col-md-2">
                            <button class="filter-btn d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#filterModal">
                                <i class="fa fa-filter"></i>
                                Filter
                            </button>
                        </div>`;


            $(element).insertBefore('#contractInfoTable_filter ')

            var parentElement = $('#contractInfoTable_filter').parent()
            parentElement.css({
                'display': 'flex',
                'justify-content': 'flex-end'
            })

        }

        // Initialize the DataTable
        $(document).ready(function() {
            locations();
        });
    </script>
@endpush
