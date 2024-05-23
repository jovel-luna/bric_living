@extends('layouts.app', ['pageSlug' => 'home'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Property Info</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Properties</li>
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
                <div id="properties" class="col-md-12">
                    @include('layouts.templates.filter.filter')
                    <table id="property-table" class="table table-bordered property-table property-list-table m-0" style="width:100%;" autoCompletet>
                        <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Entity</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>House No./Street</th>
                                <th>Postcode</th>
                                <th>Property Phase</th>
                                <th>Bric Beds</th>
                                <th>Letting Status</th>
                                <th>Action</th>
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
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#clear-filter').on('click', function(){
                $('select#property_phase, select#entity, select#city, select#area, select#no_bric_beds, select#status').val('').selectpicker('refresh');
                $('.lists').empty();
            });

            let postcode = [];
            let address = [];
            $('#filter-view').on('click', function(){
                
                $('#filterModal').modal('hide');
                var property_phase = $('select#property_phase').val();
                var entity = $('select#entity').val();
                var city = $('select#city').val();
                var area = $('select#area').val();
                var no_bric_beds = $('select#no_bric_beds').val();
                var status = $('select#status').val();
                
                getArrayData();

                $('#property-table').DataTable().destroy();
                property(property_phase, entity, city, area, no_bric_beds, status, postcode, address, $('#show_limit').val(), $('#searching').val());
            });
            $("#show_limit").on("change", function() {
                var limit = $(this).val();
                getArrayData();
                $('#property-table').DataTable().destroy();
                property($('select#property_phase').val(), $('select#entity').val(), $('select#city').val(), $('select#area').val(), $('select#no_bric_beds').val(), $('select#status').val(), postcode, address, limit, $('#searching').val());
            });
            $('#searching').keyup(function(){
                var search = $(this).val();
                getArrayData();
                $('#property-table').DataTable().destroy();
                property($('select#property_phase').val(), $('select#entity').val(), $('select#city').val(), $('select#area').val(), $('select#no_bric_beds').val(), $('select#status').val(), postcode, address, $('#show_limit').val(), search);
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

            property();
            function property(property_phase='',entity='',city='',area='', no_bric_beds='', status='', postcode='', address='', showlimit='',search=''){

                var paginateStat = true;
                if (showlimit == '') {
                    var perPage = 25;
                }else{
                    if (showlimit != 'all') {
                        var perPage = showlimit;
                    }else{
                        paginateStat = false;
                    }
                }

                $('#property-table').DataTable({
                    language: { 
                        processing: 'Loading. Please wait...',
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                        lengthMenu: "_MENU_"
                    },
                    processing: false,
                    serverSide: true,
                    pageLength: perPage,
                    bPaginate: paginateStat,
                    order: [],
                    ajax: {
                        url:"{{route('home') }}",
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
                            search:search
                        }
                    },
                    columnDefs : [
                        { 
                            targets: [], //first column / numbering column
                            orderable: false, //set not orderable
                        }
                    ],
                    columns: [
                        {data: 'ref_no', name: 'ref_no', orderable: true},
                        {data: 'entity', name: 'entity', orderable: true},
                        {data: 'city', name: 'city', orderable: true},
                        {data: 'area', name: 'area', orderable: true},
                        {data: 'house_and_street', name: 'house_and_street', orderable: true},
                        {data: 'postcode', name: 'postcode', orderable: true},
                        {data: 'property_phase', name: 'property_phase', orderable: true},
                        {data: 'no_bric_beds', name: 'no_bric_beds', orderable: true},
                        {data: 'letting_status_name', name: 'letting_status_name', orderable: true},
                        {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                            return  '<div class="action-btn d-flex gap-1 justify-content-center">'+
                                    '<a href="'+baseUrl+'/'+'property/details/'+row.id+'" id="view-txt-btn" class="view" title="View"><i class="fa-regular fa-eye" style="color: #005eff;"></i></a>'+
                                '</div>';
                        }},
                    ]
                });
                $(".dataTables_length").addClass('d-none'); 
                $(".dataTables_filter").addClass('d-none');
                setTimeout(function() {
                    $('.loading-container').hide();
                }, 1000);
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

        });
    </script>
@endpush
@endsection
