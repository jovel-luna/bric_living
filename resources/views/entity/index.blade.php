@extends('layouts.app', ['pageSlug' => 'entity-page'])

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Entity List</h1>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Entities</li>
                    </ol>
                    <div class="func-btns d-flex align-items-center">
                        <a href="{{ route('entity.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>
                            Add New
                        </a>
                    </div>
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
                <div id="entities" class="col-md-12">
                    <table id="entityTable" class="table table-bordered entity-table entity-list-table">
                        <thead>
                            <tr>
                                <th>Entity</th>
                                <th>Registration Number</th>
                                <th>Registered Address</th>
                                <th>No. Properties</th>
                                <th>No. Beds</th>
                                <th>Development Pipeline</th>
                                <th>Acquisition Pipeline</th>
                                <th>Rent Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="8"></th>
                     
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    </div>
    @include('entity.side-popup')
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.has-datepicker').datepicker({
                    dateFormat: "dd-mm-yy"
                })
                var table = $('#entityTable').DataTable({
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                        lengthMenu: "_MENU_"
                    },
                    lengthMenu: [
                        [20, 50, 100, -1],
                        [20, 50, 100, 'All']
                    ],
                    // processing: true,
                    // serverSide: true,
                    ajax: "{{ route('entity.index') }}",
                    columns: [{
                            data: 'entity',
                            name: 'entity'
                        },
                        {
                            data: 'company_registration_number',
                            name: 'company_registration_number'
                        },
                        {
                            data: 'registered_address',
                            name: 'registered_address'
                        },
                        {
                            data: 'no_of_properties',
                            name: 'no_of_properties',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return row.no_of_properties ? row.no_of_properties : 'N/A';
                            }
                        },
                        {
                            data: 'no_bric_beds',
                            name: 'no_bric_beds',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return row.no_bric_beds ? row.no_bric_beds : 'N/A';
                            }
                        },
                        {
                            data: 'dev_pipeline',
                            name: 'dev_pipeline',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return row.dev_pipeline ? row.dev_pipeline : 'N/A';
                            }
                        },
                        
                        {
                            data: 'acquisition_pipeline',
                            name: 'acquisition_pipeline',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return row.acquisition_pipeline ? row.acquisition_pipeline : 'N/A';
                            }
                        },
                        {
                            data: 'current_rent_role',
                            name: 'current_rent_role',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return row.current_rent_role ? row.current_rent_role : 'N/A';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            width: 0,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return '<div class="action-btn d-flex justify-content-center gap-1">' +
                                    '<a href="#" id="view-txt-btn" class="view" title="Summary"><i class="info icon fa-regular fa-rectangle-list" style="color: #005eff;"></i></a>' +
                                    '</div>';
                            }
                        },
                    ],
                    footerCallback: function(row, data, start, end, display) {
                        let api = this.api();
                        
                        // Remove the formatting to get integer data for summation
                        let intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i :
                                0;
                        };

                        // Total over all pages for beds
                        total = api
                            .column(4)
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);

                        // Total over all pages for properties    
                        totalProperties = api
                            .column(3)
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);    

                        // Total beds for this page
                        pageTotal = api
                            .column(4, {
                                page: 'current'
                            })
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);

                        // Total properties for this page
                        pageTotalProperties = api
                            .column(3, {
                                page: 'current'
                            })
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);    

                        // Update footer
                        api.column(1).footer().innerHTML =
                            '<div style="display: flex; justify-content: space-between;"><div>Total Beds listed in this page: ' + pageTotal + ' ( ' + total + ' Beds recorded as of today)</div><div>Total Properties listed in this page: ' + pageTotalProperties + ' ( ' + totalProperties + ' Properties recorded as of today)</div></div>';

                    }
                });
                $(document).on('click', '#view-txt-btn', function(e) {
                    e.preventDefault();
                    var rowID = $(this).parents('tr').attr('data-id');
                    $('.side-btn-view').attr('href', baseUrl + '/' + 'entity/' + rowID);
                    $('.sidebar-popup').attr('data-id', rowID)
                    $('.sidebar-popup').css({
                        'width': '400px',
                        'padding': '20px'
                    });
                    getEntityData(rowID)
                });

                $('#close-sidebar-btn').on('click', function(e) {
                    e.preventDefault();
                    $('.sidebar-popup').css({
                        'width': '0px',
                        'padding': '0px'
                    });
                    var currentRow = $(this).parents('.sidebar-popup').find('form > .side-content div');
                    var defaultTemp = '<a href="#" class="btn btn-warning shadow-sm side-btn-edit"> Edit </a>';
                    $(this).parents('.sidebar-popup').find('.action-option').empty().append(defaultTemp);
                    $.each(currentRow, function(x, xVal) {
                        $(this).find('.form-control').addClass('is-disabled');
                    });
                });
                $(document).on('click', '.side-btn-edit', function(e) {
                    e.preventDefault();
                    var currentRow = $(this).parents('.sidebar-popup').find('form > .side-content div');

                    var editTemp =
                        '<button type="submit" class="btn btn-success shadow-sm side-btn-save"> Save </button>' +
                        '<a href="#" class="btn btn-danger shadow-sm side-btn-cancel"> Cancel </a>';
                    $(this).parents('.action-option').empty().append(editTemp);
                    $.each(currentRow, function(x, xVal) {
                        if (x == 9 || x == 14 || x == 18 || x == 19 || x == 22) {
                            if (x == 22) {
                                $(this).find('.form-control').removeClass('is-disabled');
                            }
                        } else {
                            $(this).find('.form-control').removeClass('is-disabled');
                        }
                    });
                });
                $(document).on('click', '.side-btn-cancel', function(e) {
                    e.preventDefault();
                    var rowID = $(this).parents('.sidebar-popup').attr('data-id');
                    var currentRow = $(this).parents('.sidebar-popup').find('form > .side-content div');
                    var defaultTemp = '<a href="#" class="btn btn-warning shadow-sm side-btn-edit"> Edit </a>';
                    $(this).parents('.action-option').empty().append(defaultTemp);
                    $.each(currentRow, function(x, xVal) {
                        $(this).find('.form-control').addClass('is-disabled');
                    });
                    getAcquisitionData(rowID);
                });

                $('form#side-popup-form-acqui').submit(function(e) {
                    console.log('here')
                    e.preventDefault();
                    var rowID = $(this).parents('.sidebar-popup').attr('data-id');
                    var currentRow = $(this).parents('.sidebar-popup').find('form > .side-content div');

                    const fData = new FormData(e.target);
                    let formData = {};

                    const form = e.currentTarget;
                    if (form.checkValidity() === false) {
                        e.stopPropagation();
                    } else {
                        fData.forEach((value, key) => {
                            formData[key] = value;
                        });
                    }
                    formData['id'] = rowID;
                    jQuery.ajax({
                        url: 'entity/updateEntity/' + rowID,
                        method: 'post',
                        data: formData,
                        success: function(response) {
                            if (response['status'] == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: "Entity Updated!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Continue'
                                }).then((result) => {
                                    var defaultTemp =
                                        '<a href="#" class="btn btn-warning shadow-sm side-btn-edit"> Edit </a>';
                                    $('.action-option').empty().append(defaultTemp);
                                    $('#entityTable').DataTable().ajax.reload();
                                    $.each(currentRow, function(x, xVal) {
                                        $(this).find('.form-control').addClass(
                                            'is-disabled');
                                    });
                                })
                            }
                        },
                        error: function(error) {}
                    });
                });

                function getEntityData(rowID) {
                    jQuery.ajax({
                        url: 'entity/fetch/' + rowID,
                        method: 'post',
                        beforeSend: function() {
                            $('.sidebar-popup').append(
                                '<span class="back-overlay"><div class="lds-ring"><div></div><div></div> <div></div></div></span>'
                                )
                        },
                        success: function(response) {
                            if (response) {
                                $('#side-company_registration_number').val(response['data'][
                                    'company_registration_number'
                                ]);
                                $('#side-col_status_log').val(response['data']['col_status_log']);
                                $('#side-entity').val(response['data']['entity']);
                                $('#side-registered_address').val(response['data']['registered_address']);
                                $('#side-statement_due_date').val(response['data']['statement_due_date']);
                                $('#side-financial_year_start_date').val(response['data'][
                                    'financial_year_start_date'
                                ]);
                                $('#side-financial_year_end_date').val(response['data'][
                                    'financial_year_end_date'
                                ]);
                            }
                            $('.sidebar-popup .back-overlay').remove();
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
