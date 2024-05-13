@extends('layouts.app', ['pageSlug' => 'history'])

@section('content')

<div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">History</li>
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
                            <strong>Success:</strong> {{Session::get('success')}}
                        </div>
                    </div>
                @endif
                <div id="contract-status" class="col-md-12">
                    @include('layouts.templates.filter.filter')
                    <table id="contract-status-table" class="table table-bordered contract-status-table property-list-table m-0" style="width:100%;" autoCompletet>
                        <thead>
                            <tr>
                                <th>Entity</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>House No./Street</th>
                                <th>Postcode</th>
                                <th>Available</th>
                                <th>Contract Status</th>
                                <th>Bed/Bath</th>
                                <th>Version</th>
                                <th>Target Weekly Rent</th>
                                <th>Notes</th>
                                <th></th>
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
<!-- Modal -->
@include('layouts.templates.popups.filter-popup')
@include('layouts.templates.popups.lettings.add-notes')
@include('layouts.templates.popups.lettings.view-notes')
@include('layouts.templates.popups.lettings.edit-notes')
@push('scripts')
    <script>
        $(document).ready( function () {
            var psList = <?php echo json_encode($filters['letting_status']) ?>;
            var cua = "{{ hasAccess('lettings_table_edit') }}";
            $('#clear-filter').on('click', function(){
                $('select#property_phase, select#entity, select#city, select#area, select#no_bric_beds, select#status, select#property_contract_status').val('').selectpicker('refresh');
                $('.lists').empty();
            });

            let postcode = [];
            let address = [];
            var show_limit = "-1";
            $('#filter-view').on('click', function(){
                
                $('#filterModal').modal('hide');
                var property_phase = $('select#property_phase').val();
                var entity = $('select#entity').val();
                var city = $('select#city').val();
                var area = $('select#area').val();
                var no_bric_beds = $('select#no_bric_beds').val();
                var status = $('select#status').val();
                var property_contract_status = $('select#property_contract_status').val();
                
                getArrayData();

                $('#contract-status-table').DataTable().destroy();
                letting(property_phase, entity, city, area, no_bric_beds, status, postcode, address, show_limit, $('#searching').val(), property_contract_status);
            });

            $('#searching').keyup(function(){
                var search = $(this).val();
                getArrayData();
                $('#contract-status-table').DataTable().destroy();
                letting($('select#property_phase').val(), $('select#entity').val(), $('select#city').val(), $('select#area').val(), $('select#no_bric_beds').val(), $('select#status').val(), postcode, address, show_limit, search);
            });

            function getArrayData(){
                postcode = [];
                address = [];
                $( ".postcode-list .list-items" ).each(function( pc ) {
                    postcode.push($(this).find('span').text());
                });

                $( ".address-list .list-items" ).each(function( add ) {
                    address.push($(this).find('span').text());
                });
            }

            letting();
            function letting(property_phase='',entity='',city='',area='', no_bric_beds='', status='', postcode='', address='', showlimit='',search='',property_contract_status=''){
                var paginateStat = false;
                var lettingTable = $('#contract-status-table').DataTable({
                    language: { 
                        processing: 'Loading. Please wait...',
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                        lengthMenu: "_MENU_"
                    },
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    pageLength: showlimit,
                    bPaginate: paginateStat,
                    order: [],
                    fnDrawCallback: function( settings ) {
                        $('.loading-container').hide();
                        $( ".has-datepicker" ).datepicker({
                            dateFormat: "dd-mm-yy",
                            onSelect: function(date) {
                            }
                        });
                    },
                    ajax: {
                        url:"{{ route('lettings.history') }}",
                        type: "GET",
                        beforeSend: function(){
                            $('.loading-container').show();
                        },
                        data: {
                            property_phase:property_phase,
                            entity:entity,
                            city:city,
                            area:area,
                            no_bric_beds:no_bric_beds,
                            status:status,
                            postcode:postcode,
                            address:address,
                            search:search,
                            property_contract_status:property_contract_status
                        }
                    },
                    columnDefs : [
                        { 
                            targets: [0], //first column / numbering column
                            visible: cua.toLowerCase() === "true"
                        }
                    ],
                    columns: [
                        // {data: 'checkbox', name: 'checkbox', orderable: false, render:function(data, type, row){
                        //     return '<input class="selectItem" type="checkbox" value="" checked>';
                        // }},
                        {data: 'entity', name: 'entity', orderable: true},
                        {data: 'city', name: 'city', orderable: true},
                        {data: 'area', name: 'area', orderable: true},
                        {data: 'house_and_street', name: 'house_and_street', orderable: true},
                        {data: 'postcode', name: 'postcode', orderable: true},
                        {data: 'date_available', name: 'date_available', orderable: true,  render:function(data, type, row){
                            return row.projected_completion_date;
                        }},
                        {data: 'property_contract_status', name: 'property_contract_status', orderable: true, render:function(data, type, row){
                            return row.letting_status_name ? row.letting_status_name : 'N/A';
                        }},
                        {data: 'bed_bath', name: 'bed_bath', orderable: true, render:function(data, type, row){
                            return row.no_bric_beds+'/'+row.no_bric_bathrooms;
                        }},
                        {data: 'version', name: 'version', orderable: true, render:function(data, type, row){
                            return row.version ? row.version : 'N/A';
                        }},
                        {data: 'target_weekly_rent', name: 'target_weekly_rent', orderable: true, render:function(data, type, row){
                            return row.target_weekly_rent ?  row.target_weekly_rent : 'N/A';
                        }},
                        {data: 'notes', name: 'notes', orderable: false, render:function(data, type, row){
                            return '<div>'+
                                        '<a href="#" type="button" data-id="'+row.id+'" class="btn btn-info btn-xs view-notes">'+
                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                '<path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>'+
                                                '<path d="M9 7l6 0"></path>'+
                                                '<path d="M9 11l6 0"></path>'+
                                                '<path d="M9 15l4 0"></path>'+
                                            '</svg>'+
                                        '</a>'+
                                    '</div>';
                        }},
                        {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                            return  '<div class="action-btn d-flex gap-1 justify-content-center">'+
                                    '<a href="#" data-id="'+row.id+'" class="unarchive-btn" title="Unarchive">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-restore" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                            '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                            '<path d="M3.06 13a9 9 0 1 0 .49 -4.087"></path>'+
                                            '<path d="M3 4.001v5h5"></path>'+
                                            '<path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>'+
                                        '</svg>'+
                                    '</a>'+
                                '</div>';
                        }},
                    ]
                });
                $(".dataTables_length").addClass('d-none'); 
                $(".dataTables_filter").addClass('d-none');
            }

            $('table thead tr th').on('click', function(){
                setTimeout(function() {
                    $('.loading-container').hide();
                }, 1500);
            });

            $(document).on('click', '#addbtn', function(){
                var inputVal = $(this).parent().parent().find('input').val();
                var addTemp =   '<div class="list-items">'+
                                    '<span>'+inputVal+'</span>'+
                                    '<i class="fa fa-times-circle remove-btn" aria-hidden="true" ></i>'+
                                '</div>';
                $(this).parent().parent().parent().find('.lists').append(addTemp);
                $(this).parent().parent().find('input').val('');
            });

            $(document).on('click', '.remove-btn', function(){
                $(this).parent('.list-items').fadeOut(300, function() { $(this).remove(); });
            });

            $(document).on('click', '.page-link', function(){
                setTimeout(function() {
                    $('.loading-container').hide();
                }, 1000);
            });

            // view notes
            $(document).on('click', '.view-notes', function (e) {
                e.preventDefault();
                var nid = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('get.notes') }}",
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nid: nid,
                        type: 'Lettings'
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            var noteTmp = "";
                            if (response['data'].length != 0) {
                                $.each(response['data'], function (x, xVal) {
                                    var has_update = moment(xVal['created_at']).isSame(xVal['updated_at']);
                                    var name = xVal['first_name']+' '+(xVal['middle_name'] ? xVal['middle_name'] : '')+' '+xVal['last_name'];
                                    var date_time_created_format = moment(xVal['created_at']).format('MMMM Do YYYY, h:mm a');
                                    var date_time_updated_format = moment(xVal['updated_at']).format('MMMM Do YYYY, h:mm a');
                                    var date_time_diff_format = moment(xVal['created_at']).startOf('hour').fromNow();
                                    noteTmp += '<li class="note-item mb-2">'+
                                                '<div class="mb-1 d-flex justify-content-between">'+
                                                    '<div>'+
                                                        '<div>Date: <strong class="note_date">'+(has_update ? date_time_created_format : date_time_updated_format)+'</strong></div>'+
                                                        '<div><span class="note_label">'+ (has_update ? 'Created':'Updated') +' by: </span><strong class="note_publisher">'+name+'</strong></div>'+
                                                    '</div></div>'+
                                                '<div class="mb-1 note_description">'+xVal['description']+'</div>'+
                                                '<div class="d-flex justify-content-end time-passed"><strong class="note_diff">'+date_time_diff_format+'</strong></div>'+
                                            '</li>';
                                });
                            }else{
                                noteTmp += '<li class="no-result"> <h4>No Available Notes</h4> </li>';
                            }
                            $("#notes-logs").empty().append(noteTmp);
                            $('#viewNotes').modal('show');
                        }
                    }
                });
            });

            // Unarchive
            $(document).on('click', '.unarchive-btn', function(e){
                e.preventDefault();
                var pid = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure to unarchive this properties?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed){
                        $.ajax({
                            url: "{{ route('unarchive.lettings') }}",
                            type: 'post',
                            data: {
                                _token: '{{ csrf_token() }}',
                                pid: pid,
                                type: 'Lettings'
                            },
                            success: function(response){
                                if (response['status'] == 1) {
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Properties are Successfully Unrachived'
                                    });
                                    $('table').DataTable().ajax.reload();
                                }
                            }
                        });
                    }
                });
            });
            
        });
    </script>
@endpush
@endsection