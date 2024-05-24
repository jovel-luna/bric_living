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
                <table id="contractInfoTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Property Ref Number</th>
                            <th>Tenant Name</th>
                            <th>Contract Status</th>
                            <th>Paid Deposits?</th>
                            <th>Has Outstanding Documents?</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function locations(ref_no = '', id = '', name = '', tenant_contract_status = '', deposits_paid = '',
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
                        ref_no: ref_no,
                        name: name,
                        id: id,
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
                        data: 'ref_no',
                        name: 'ref_no',
                        orderable: true
                    },
                    {
                        data: 'name',
                        name: 'name',
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
                                return "Yes"
                            } else {
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
                                return "Yes"
                            } else {
                                return "No"
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false, // <i class="fa-solid fa-trash-can"></i>
                        render: function(data, type, row) {
                            return '<div class="action-btn d-flex gap-1 justify-content-center"><a href="' +
                                baseUrl + '/' + 'lettings/contract/show/' + row.id +
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
