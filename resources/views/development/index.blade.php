@extends('layouts.app', ['pageSlug' => 'development'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Development</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Development</li>
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
                <div id="development" class="col-md-12">
                    @include('layouts.templates.filter.development-filter')
                    <table id="operation-table" class="table table-bordered operation-table property-list-table m-0" style="width:100%;" autoCompletet>
                        <thead>
                            <tr>
                                <th>Entity</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>House No./Street</th>
                                <th>Postcode</th>
                                <th>Bric Beds</th>
                                <th>Development Status</th>
                                <th>Letting Status</th>
                                <th>Budget</th>
                                <th>Project Start Date</th>
                                <th>Est Completion Date</th>
                                <th>Over running (days)</th>
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
@include('layouts.templates.popups.developments-filter-popup')
@push('scripts')
    <script>
        $(document).ready( function () {    
            $( ".has-datepicker" ).datepicker({
                dateFormat: "dd-mm-yy",
            });

            $('#clear-filter').on('click', function(){
                $('select#property_phase, select#entity, select#city, select#area, select#no_bric_beds, select#status').val('').selectpicker('refresh');
                $('.lists').empty();
            });

            let postcode = [];
            let address = [];
            $('#filter-view').on('click', function(){
                
                $('#filterModal').modal('hide');
                var development_status = $('select#development_status').val();
                var entity = $('select#entity').val();
                var city = $('select#city').val();
                var area = $('select#area').val();
                var no_bric_beds = $('select#no_bric_beds').val();
                var status = $('select#status').val();

                var overruning_days = $('input#overruning_days').val();
                var project_start_date = $('input#project_start_date').val();
                var est_completion_date = $('input#est_completion_date').val();
                
                getArrayData();

                $('#operation-table').DataTable().destroy();
                property(development_status, entity, city, area, no_bric_beds, status, postcode, address, overruning_days , project_start_date, est_completion_date , $('#show_limit').val(), $('#searching').val());
            });
            $("#show_limit").on("change", function() {
                var limit = $(this).val();
                getArrayData();
                $('#operation-table').DataTable().destroy();
                property($('select#property_phase').val(), $('select#entity').val(), $('select#city').val(), $('select#area').val(), $('select#no_bric_beds').val(), $('select#status').val(), postcode, address, limit, $('#searching').val());
            });
            $('#searching').keyup(function(){
                var search = $(this).val();
                getArrayData();
                $('#operation-table').DataTable().destroy();
                property($('select#development_status').val(), $('select#entity').val(), $('select#city').val(), $('select#area').val(), $('select#no_bric_beds').val(), $('select#status').val(), postcode, address, overruning_days , project_start_date, est_completion_date,  $('#show_limit').val(), search);
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
            function property(development_status='',entity='',city='',area='', no_bric_beds='', status='', postcode='', address='', overruning_days , project_start_date, est_completion_date , showlimit='',search=''){

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

                $('#operation-table').DataTable({
                    language: { 
                        processing: 'Loading. Please wait...',
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                        lengthMenu: "_MENU_"
                    },
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    pageLength: perPage,
                    bPaginate: paginateStat,
                    order: [],
                    ajax: {
                        url:"{{ route('development.index') }}",
                        type: "GET",
                        beforeSend: function(){
                            $('.loading-container').show();
                        },
                        data: {
                            development_status:development_status,
                            entity:entity,
                            city:city,
                            area:area,
                            no_bric_beds:no_bric_beds,
                            status:status,
                            postcode:postcode,
                            address:address,
                            overruning_days:overruning_days , 
                            project_start_date:project_start_date, 
                            est_completion_date:est_completion_date, 
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
                        {data: 'entity', name: 'entity', orderable: true},
                        {data: 'city', name: 'city', orderable: true},
                        {data: 'area', name: 'area', orderable: true},
                        {data: 'house_and_street', name: 'house_and_street', orderable: true},
                        {data: 'postcode', name: 'postcode', orderable: true},
                        {data: 'no_bric_beds', name: 'no_bric_beds', orderable: true},
                        {data: 'development_status', name: 'development_status', orderable: true},
                        {data: 'letting_status_name', name: 'letting_status_name', orderable: true},
                        {data: 'budget', name: 'budget', orderable: true, render:function(data, type, row){
                            if (row.overall_budget != '' && row.overall_budget != null) {
                                var budget = (row.overall_budget - Math.floor(row.overall_budget)) !== 0; 
                                if (budget) {
                                    var overallBudget = Intl.NumberFormat('default', {
                                        minimumFractionDigits: 3,
                                        maximumFractionDigits: 3,
                                    }).format(row.overall_budget);
                                    return overallBudget;
                                }else{
                                    return parseInt(row.overall_budget).toLocaleString();
                                }
                            }else{
                                return 'N/A';
                            }
                            
                        }},
                        {data: 'project_start_date', name: 'project_start_date', orderable: true},
                        {data: 'projected_completion_date', name: 'projected_completion_date', orderable: true},
                        {data: 'over_running', name: 'over_running', orderable: true, render:function(data, type, row){

                            var now = moment().format('YYYY-MM-DD');

                            var dateString = row.projected_completion_date;
                            var dateFormat = 'DD-MM-YYYY';
                            const date = moment(dateString, dateFormat);
                            if (moment(date).isBefore(now)) {
                                const dateDiff = moment(now).diff(moment(date).format('YYYY-MM-DD'), 'days');
                                // var result = Math.floor(Math.abs(dateDiff) / 7);
                                var result = Math.abs(dateDiff);
                            }else{
                                var result = 0;
                            }
                            return result;
                        }},
                        {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                            return  '<div class="action-btn d-flex gap-1 justify-content-center">'+
                                    '<a href="'+baseUrl+'/'+'property/details/'+row.id+'" id="view-txt-btn" class="view" title="View"><i class="view icon fa-regular fa-eye" style="color: #005eff;"></i></a>'+
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
