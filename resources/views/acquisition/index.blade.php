@extends('layouts.app', ['pageSlug' => 'acquisition-page'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Acquisition List</h1>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Acquisition</li>
                </ol>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    @if (Session::has('success'))
                        <div class="alert-container p-3">
                            <div class="alert alert-success p-3">
                                <strong>Success:</strong> {{Session::get('success')}}
                            </div>
                        </div>
                    @endif
                    <div id="acquisitions" class="col">
                        <div class="d-flex justify-content-between mb-5">
                        </div>
                        @include('layouts.templates.filter.filter')
                        <table id="acquisitionTable" class="table table-bordered acquisition-table acquisition-list-table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Entity</th>
                                    <th>City</th>
                                    <th>Area</th>
                                    <th>House No./Street</th>
                                    <th>Postcode</th>
                                    <th>Status</th>
                                    <th>Bric Beds</th>
                                    <th>Agreed £</th>
                                    <th>Agent</th>
                                    <th>Date Added</th>
                                    <th>Target Completion Date</th>
                                    <th>COL Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
@include('layouts.templates.popups.filter-popup')
<div class="d-none" id="dataFields">
    <?php
        print_r(json_encode($data));
    ?>
</div>
@include('acquisition.side-popup')
@push('scripts')
    <script>
        $(document).ready( function () {
            var dataFields = JSON.parse($('#dataFields').html());
            $('.has-datepicker').datepicker({ dateFormat: "dd-mm-yy" })
            var baseUrl = "{{URL::to('/')}}";


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

                $('#acquisitionTable').DataTable().destroy();
                acquisition(property_phase, entity, city, area, no_bric_beds, status, postcode, address, $('#show_limit').val(), $('#searching').val());
            });

            $('#searching').keyup(function(){
                var search = $(this).val();
                getArrayData();
                $('#acquisitionTable').DataTable().destroy();
                acquisition($('select#property_phase').val(), $('select#entity').val(), $('select#city').val(), $('select#area').val(), $('select#no_bric_beds').val(), $('select#status').val(), postcode, address, $('#show_limit').val(), search);
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

            acquisition();
            function acquisition(property_phase='',entity='',city='',area='', no_bric_beds='', status='', postcode='', address='', showlimit='',search=''){
                $('#acquisitionTable').DataTable({
                    language: { 
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                        lengthMenu: "_MENU_"
                    },
                    processing: false,
                    serverSide: true,
                    bPaginate: false,
                    order: [],
                    ajax: {
                        url: "{{ route('acquisition.index') }}",
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
                        {data: 'entity', name: 'entity', orderable: true},
                        {data: 'city', name: 'city', orderable: true},
                        {data: 'area', name: 'area', orderable: true},
                        {data: 'address', name: 'address', orderable: true},
                        {data: 'postcode', name: 'postcode', orderable: true},
                        {data: 'acquisition_status', name: 'acquisition_status', orderable: true},
                        {data: 'no_bric_beds', name: 'no_bric_beds', orderable: true},
                        {data: 'agreed_purchase_price', name: 'agreed_purchase_price', orderable: true},
                        {data: 'agent', name: 'agent', orderable: true},
                        {data: 'created_at', name: 'created_at', orderable: true, render:function(data, type, row){
                            var dateAdded = moment(row.created_at).format('DD-MM-YYYY');
                            return dateAdded ;
                        }},
                        {data: 'target_completion_date', name: 'target_completion_date', orderable: true},
                        {data: 'col_status', name: 'col_status', orderable: true},
                        {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                            return  '<div class="action-btn has-divider d-flex gap-1 justify-content-center">'+
                                        '<a href="#" id="view-txt-btn" class="view" title="Summary"><i class="info icon fa-regular fa-rectangle-list" style="color: #16a085;"></i></a>'+
                                        '<a href="'+baseUrl+'/'+'property/details/'+row.property_id+'" id="view-more-txt-btn" class="view-more" title="View More"><i class="view icon fa-regular fa-eye" style="color: #2980b9;"></i></a>'+
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
            $('#close-sidebar-btn').on('click', function(e){
                e.preventDefault();
                $('.sidebar-popup').css({
                    'width':'0px',
                    'padding':'0px'
                });
                var currentRow = $(this).parents('.sidebar-popup').find('form > .side-content div');
                var defaultTemp =  '<a href="#" class="btn btn-warning shadow-sm side-btn-edit"> Edit </a>';
                $(this).parents('.sidebar-popup').find('.action-option').empty().append(defaultTemp);
                $.each(currentRow, function (x, xVal) {
                     $(this).find('.form-control').addClass('is-disabled');
                });
            });
            $(document).on('click', '#view-txt-btn', function(e){
                e.preventDefault();
                var rowID = $(this).parents('tr').attr('data-id');
                var propertyID = $(this).parents('tr').attr('data-property');
                $('.side-btn-view').attr('href', baseUrl+'/'+'property/details/'+propertyID);
                $('.sidebar-popup').attr('data-id', rowID)
                $('.sidebar-popup').css({
                    'width':'800px',
                    'padding':'20px'
                });
                getAcquisitionData(rowID)
            });
            $(document).on('click', '.side-btn-edit', function(e){
                e.preventDefault();
                var currentRow = $(this).parents('.sidebar-popup').find('form > .side-content div');

                var editTemp =  '<button type="submit" class="btn btn-success shadow-sm side-btn-save"> Save </button>'+
                                '<a href="#" class="btn btn-danger shadow-sm side-btn-cancel"> Cancel </a>';
                $(this).parents('.action-option').empty().append(editTemp);
                $.each(currentRow, function (x, xVal) {
                    if (x == 9 || x == 14 || x == 18 || x == 19 || x == 22) {
                        if (x == 22) {
                            $(this).find('.form-control').removeClass('is-disabled');
                        }
                    }else{
                        $(this).find('.form-control').removeClass('is-disabled');
                    }
                });
            });
            $(document).on('click', '.side-btn-cancel', function(e){
                e.preventDefault();
                var rowID = $(this).parents('.sidebar-popup').attr('data-id');
                var currentRow = $(this).parents('.sidebar-popup').find('form > .side-content div');
                var defaultTemp =  '<a href="#" class="btn btn-warning shadow-sm side-btn-edit"> Edit </a>';
                $(this).parents('.action-option').empty().append(defaultTemp);
                $.each(currentRow, function (x, xVal) { 
                     $(this).find('.form-control').addClass('is-disabled');
                });
                getAcquisitionData(rowID);
            });

            $("form#side-popup-form").submit(function(e){
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
                    url: 'acquisition/updateAcquisition/'+rowID,
                    method: 'post',
                    data: {
                        formData: formData,
                        saveID: 2
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Acquisition updated!'
                            });
                            var defaultTemp =  '<a href="#" class="btn btn-warning shadow-sm side-btn-edit"> Edit </a>';
                            $('.action-option').empty().append(defaultTemp);
                            $('#acquisitionTable').DataTable().ajax.reload();
                            setTimeout(function() {
                                $('.loading-container').hide();
                            }, 1000);
                            $.each(currentRow, function (x, xVal) { 
                                $(this).find('.form-control').addClass('is-disabled');
                            });
                            if (response['completed'] == 1) {
                                $('.sidebar-popup').css({
                                    'width':'0px',
                                    'padding':'0px'
                                });
                            }
                        }
                    }
                });

            });
            var oldRowData = {};
            var rowData = {};
            $(document).on('click', '#edit-btn', function (e) {
                e.preventDefault();
                var currentTD = $(this).parents('tr').find('td');
                var rowID = $(this).parents('tr').attr('data-id');
                if ($(this).hasClass('edit')) {
                    var oldEachRow = {};
                    var currentRowData = $(this).parents('tr').attr('data-current');
                    var currentRowDataFormat = JSON.parse(currentRowData.replace(/&quot;/g,'"'));
                    $.each(currentTD, function (x, xval) {
                        var isLastElement = x == currentTD.length -1;
                        if (!isLastElement) {
                            oldEachRow[x] = $(this).html();
                            var currentData = $(this).html();
                            switch (x) {
                                case 0:
                                    $(this).addClass('editable-cell');
                                    var entityTemp = '';
                                    $.each(dataFields['entity'], function (entityKey, entityVal) { 
                                        entityTemp += '<option value="'+entityVal['id']+'" '+ (entityVal['entity'] === currentData ? 'selected' : '') +'>'+entityVal['entity']+'</option>'
                                    });
                                    $(this).empty().append('<select id="entity" name="entity">'+entityTemp+'</select>');
                                    break;
                                case 1:
                                    $(this).addClass('editable-cell');
                                    $(this).empty().append('<input id="house_no_or_name" name="house_no_or_name" value="'+currentRowDataFormat['house_no_or_name']+'" style="position: unset; width: 100%; "><input id="street" name="street" value="'+ currentRowDataFormat['street'] +'" style="position: unset; width: 100%;">');
                                    break;
                                case 2:
                                    $(this).addClass('editable-cell');
                                    var cityTemp = '';
                                    $.each(dataFields['city'], function (cityKey, cityVal) { 
                                        cityTemp += '<option value="'+cityKey+'" '+ (cityVal === currentData ? 'selected' : '') +'>'+cityVal+'</option>'
                                    });
                                    $(this).empty().append('<select id="city" name="city">'+cityTemp+'</select>');
                                    break;
                                case 3:
                                    $(this).addClass('editable-cell');
                                    var areaTemp = '';
                                    var city = $(this).parents('tr').find('select[name="city"]').val();
                                    $.each(dataFields['area'], function (areaKey, areaVal) { 
                                        if (areaKey == city) {
                                            $.each(areaVal, function (xKey, xVal) { 
                                                areaTemp += '<option value="'+xVal+'" '+ (xVal === currentData ? 'selected' : '') +'>'+xVal+'</option>' 
                                            });
                                        }
                                    });

                                    $(this).empty().append('<select id="area" name="area">'+areaTemp+'</select>');
                                    break;
                                case 4:
                                    $(this).addClass('editable-cell');
                                    $(this).empty().append('<input id="postcode" name="postcode" value="'+ currentData +'">');
                                    break;
                                case 5:
                                    $(this).addClass('editable-cell');
                                    var statusTemp = '';
                                    $.each(dataFields['property_status'], function (statusKey, statusVal) { 
                                        statusTemp += '<option value="'+statusKey+'" '+ (statusVal === currentData ? 'selected' : '') +'>'+statusVal+'</option>'
                                    });
                                    $(this).empty().append('<select id="status" name="status">'+statusTemp+'</select>');
                                    break;
                                case 6:
                                    $(this).addClass('editable-cell');
                                    $(this).empty().append('<input id="no_bric_beds" name="no_bric_beds" value="'+ currentData +'">');
                                    break;
                                case 7:
                                    $(this).addClass('editable-cell');
                                    $(this).empty().append('<input id="agreed_purchase_price" name="agreed_purchase_price" value="'+ currentData +'">');
                                    break;
                                case 8:
                                    $(this).addClass('editable-cell');
                                    $(this).empty().append('<input id="agent" name="agent" value="'+ currentData +'">');
                                    break;
                                case 9:
                                    $(this).addClass('editable-cell');
                                    $(this).empty().append('<input id="target_completion_date" type="text" class="has-datepicker" name="target_completion_date" value="'+currentData+'" placeholder="dd-mm-yyyy" autocomplete="target_completion_date">');
                                    $('#target_completion_date').datepicker({
                                        dateFormat: "dd-mm-yy",
                                    });
                                    break;
                                case 10:
                                    $(this).addClass('editable-cell');
                                    var colTemp = '';
                                    colTemp += '<option value="">Please Select</option>';
                                    $.each(dataFields['col_status'], function (colKey, colVal) { 
                                        colTemp += '<option value="'+colKey+'" '+ (colVal === currentData ? 'selected' : '') +'>'+colVal+'</option>'
                                    });
                                    $(this).empty().append('<select id="col_status" name="col_status">'+colTemp+'</select>');
                                    break;
                                default:
                                    break;
                            }
                        }else{
                            var actionTemp = '<div class="action-btn d-flex gap-1">'+
                                '<a href="#" id="save-btn" class="save">Save</a>'+
                                '<a href="#" id="cancel-btn" class="cancel">Cancel</a>'+
                            '</div>';
                            $(this).find('.action-btn').remove();
                            $(this).append(actionTemp);
                        }
                    });
                } else {
                    $.each(currentTD, function () {
                        $(this).prop('contenteditable', false)
                    });
                }
                oldRowData[rowID] = oldEachRow;
            });
            $(document).on('click', '#cancel-btn', function () {
                var currentTD = $(this).parents('tr').find('td');
                var rowID = $(this).parents('tr').attr('data-id');
                if ($(this).hasClass('cancel')) {                  
                    $.each(currentTD, function (x) { 
                        var isLastElement = x == currentTD.length -1;
                        if (!isLastElement) {
                            // $(this).prop('contenteditable', false)
                            $(this).empty().html(oldRowData[rowID][x])
                            $(this).removeClass('editable-cell');

                        }else{
                            var actionTemp = '<div class="action-btn d-flex gap-1">'+
                                '<a href="#" id="view-btn" class="view">View</a>'+
                                '<a href="#" id="edit-btn" class="edit">Edit</a>'+
                            '</div>';
                            $(this).find('.action-btn').remove();
                            $(this).append(actionTemp);
                        }
                    });
                } else {
                    $.each(currentTD, function () {
                        $(this).prop('contenteditable', false)
                    });
                }
            });
            $(document).on('click', '#save-btn', function(){
                var currentTD = $(this).parents('tr').find('td');
                var rowID = $(this).parents('tr').attr('data-id');
                var rowEntityPropertyID = $(this).parents('tr').attr('data-entity-property');
                var rowPropertyID = $(this).parents('tr').attr('data-property');
                var data = {};
                data['id'] = rowID;
                data['entity_property_id'] = rowEntityPropertyID;
                data['property_id'] = rowPropertyID;
                $.each(currentTD, function (x, xVal) {
                    switch (x) {
                        case 0:
                            data[$(this).find('*[name="entity"]').attr('id')] = $(this).find('*[name="entity"]').val();
                            break;
                        case 1:
                            data[$(this).find('*[name="house_no_or_name"]').attr('id')] = $(this).find('*[name="house_no_or_name"]').val();
                            data[$(this).find('*[name="street"]').attr('id')] = $(this).find('*[name="street"]').val();
                            break;
                        case 2:
                            data[$(this).find('*[name="city"]').attr('id')] = $(this).find('*[name="city"]').val();
                            break;
                        case 3:
                            data[$(this).find('*[name="area"]').attr('id')] = $(this).find('*[name="area"]').val();
                            break;
                        case 4:
                            data[$(this).find('*[name="postcode"]').attr('id')] = $(this).find('*[name="postcode"]').val();
                            break;
                        case 5:
                            data[$(this).find('*[name="status"]').attr('id')] = $(this).find('*[name="status"]').val();
                            break;
                        case 6:
                            data[$(this).find('*[name="no_bric_beds"]').attr('id')] = $(this).find('*[name="no_bric_beds"]').val();
                            break;
                        case 7:
                            data[$(this).find('*[name="agreed_purchase_price"]').attr('id')] = $(this).find('*[name="agreed_purchase_price"]').val();
                            break;
                        case 8:
                            data[$(this).find('*[name="agent"]').attr('id')] = $(this).find('*[name="agent"]').val();
                            break;
                        case 9:
                            data[$(this).find('*[name="target_completion_date"]').attr('id')] = $(this).find('*[name="target_completion_date"]').val();
                            break;
                        case 10:
                            data[$(this).find('*[name="col_status"]').attr('id')] = $(this).find('*[name="col_status"]').val();
                            break;
                        default:
                            break;
                    }
                });
                updateAcquisition(data, rowID, currentTD);
            });
            $(document).on('change', '#city', function(){
                $(this).parents('tr').find('#area').empty();
                var cityData = $(this).val();
                var areaTemp = '';
                $.each(dataFields['area'][cityData], function (areaKey, areaVal) { 
                    areaTemp += '<option value="'+areaKey+'" >'+areaVal+'</option>'
                });
                $(this).parents('tr').find('#area').append(areaTemp);
            });
            function updateAcquisition(data, id, currentTD){
                jQuery.ajax({
                    url: 'acquisition/updateAcquisition/'+id,
                    method: 'post',
                    data: {
                        formData: data,
                        saveID: 1
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            Swal.fire({
                                title: 'Success',
                                text: "Acquisition Updated!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Continue'
                            }).then((result) => {
                                $('#acquisitionTable').DataTable().ajax.reload();
                                // location.reload();
                            }) 
                        }
                    }
                });
            }

            var arrayEI = [
                'asking_price',
                'agent_fee_percentage',
                'agreed_purchase_price',
                'bridge_loan',
                'estimated_period',
                'loan_percentage',
                'bric_y1_proposed_rent_pppw', 
                'tenancy_length_weeks',
                'no_of_bric_beds',
                'estimated_tpc',
                'existing_bedroom_no',
                'capex_budget'
            ];
            $(document).on('blur', '#side-asking_price, #side-agreed_purchase_price, #side-agent_fee_percentage, #side-bridge_loan, #side-estimated_period, #side-loan_percentage, #side-bric_y1_proposed_rent_pppw, #side-tenancy_length_weeks, #side-no_of_bric_beds, #side-estimated_tpc, #side-existing_bedroom_no, #side-capex_budget', function(e){
                switch (e.target.name) {
                    case (arrayEI.includes(e.target.name)? e.target.name : '') :
                            autoPriceDifference();
                            autoAgentFee();
                            autoEstimatedInterest();
                            autoEstimatedTPC();
                            autoBricPurchaseYield();
                            autoTPCBedSpace();
                            autoEBN();
                        break;
                    default:
                        break;
                }

            });

            function getAcquisitionData(rowID){
                jQuery.ajax({
                    url: 'acquisition/fetch/'+rowID,
                    method: 'post',
                    beforeSend: function () {
                        $('.sidebar-popup').append('<span class="back-overlay"><div class="lds-ring"><div></div><div></div> <div></div></div></span>')
                    },
                    success: function(response){
                        if (response) {
                            $('#side-col_status_log').val(response['data']['col_status_log']);
                            $('#side-house_no_or_name').val(response['data']['house_no_or_name']);
                            $('#side-street').val(response['data']['street']);
                            $('#side-area').val(response['data']['area']);
                            $('#side-postcode').val(response['data']['postcode']);
                            $('#side-no_of_bric_beds').val(response['data']['no_bric_beds']);
                            $('#side-col_status').val(response['data']['col_status']);
                            $('#side-acquisition_status').val(response['data']['acquisition_status']);
                            $('#side-single_asset_portfolio').val(response['data']['single_asset_portfolio']);
                            $('#side-portfolio').val(response['data']['portfolio']);
                            $('#side-existing_bedroom_no').val(response['data']['existing_bedroom_no']);
                            $('#side-asking_price').val(response['data']['asking_price']);
                            $('#side-offer_price').val(response['data']['offer_price']);
                            $('#side-agreed_purchase_price').val(response['data']['agreed_purchase_price']);
                            $('#side-difference').val(response['data']['difference']);
                            $('#side-stamp_duty').val(response['data']['stamp_duty']);
                            $('#side-acquisition_cost').val(response['data']['acquisition_cost']);
                            $('#side-agent').val(response['data']['agent']);
                            $('#side-agent_fee_percentage').val(response['data']['agent_fee_percentage']);
                            $('#side-agent_fee').val(response['data']['agent_fee']);
                            $('#side-bridge_loan').val(response['data']['bridge_loan']);
                            $('#side-estimated_period').val(response['data']['estimated_period']);
                            $('#side-loan_percentage').val(response['data']['loan_percentage']);
                            $('#side-estimated_interest').val(response['data']['estimated_interest']);
                            $('#side-estimated_tpc').val(response['data']['estimated_tpc']);
                            $('#side-offer_date').val(response['data']['offer_date']);
                            $('#side-target_completion_date').val(response['data']['target_completion_date']);
                            if (response['data']['completion_date'] != 'N/A') {
                                $('#side-completion_date').datepicker('setDate', null);
                                $("#side-completion_date" ).val('').attr('placeholder', 'dd-mm-yy');
                                $( "#side-completion_date" ).datepicker({
                                    dateFormat: "dd-mm-yy",
                                });
                            }else{
                                $('#completion_date').datepicker('setDate', response['data']['completion_date'])
                            }
                            $('#side-financing_status').val(response['data']['financing_status']);
                            $('#side-capex_budget').val(response['data']['capex_budget']);
                            $('#side-bric_y1_proposed_rent_pppw').val(response['data']['bric_y1_proposed_rent_pppw']);
                            $('#side-tenancy_length_weeks').val(response['data']['tenancy_length_weeks']);
                            $('#side-bric_purchase_yield_percentage').val(response['data']['bric_purchase_yield_percentage']);
                            $('#side-tpc_bedspace').val(response['data']['tpc_bedspace']);
                            $('#side-purchase_price_bedspace').val(response['data']['purchase_price_bedspace']);
                            $('#side-entity').val(response['data']['entity_id']);
                        }
                        $('.sidebar-popup .back-overlay').remove();
                    }
                });
            }
            function formatAsPercentage(num, decimal) {
                return new Intl.NumberFormat('default', {
                    minimumFractionDigits: decimal,
                    maximumFractionDigits: decimal,
                }).format(num / 100);
            }
            // Price Difference
            function autoPriceDifference() {
                if ($("#side-agreed_purchase_price").val() != "" && $("#side-asking_price").val() != "") {
                    var agreedPurchasePrice = formatWholeNumber($("#side-agreed_purchase_price").val());
                    var askingPrice = formatWholeNumber($("#side-asking_price").val());
                    var priceDifference = askingPrice - agreedPurchasePrice;
                    $("#side-difference").val(parseInt(priceDifference).toLocaleString());
                }
            }
            // Agent £ Calculation
            function autoAgentFee() {
                if ($("#side-agreed_purchase_price").val() != "" && $("#side-agent_fee_percentage").val() != "") {
                    var agentFeePercentage = formatAsPercentage($("#side-agent_fee_percentage").val(), 4);
                    var agreedPurchasePrice = formatWholeNumber($("#side-agreed_purchase_price").val());
                    var auto_agent_fee =  (agreedPurchasePrice * agentFeePercentage) * 1.2;
                    $('#side-agent_fee').val(parseInt(auto_agent_fee).toLocaleString());
                }
            }
            // Estimated Interest £
            function autoEstimatedInterest(){
                if ($("#side-agreed_purchase_price").val() != "" && $("#side-bridge_loan").val() != "" && $("#side-estimated_period").val() != "" && $("#side-loan_percentage").val() != "") {
                    var bridgeLoanPercentage = formatAsPercentage($("#side-bridge_loan").val(), 4);
                    var loanPercentage = formatAsPercentage($("#side-loan_percentage").val(), 4);
                    var agreedPurchasePrice = formatWholeNumber($("#side-agreed_purchase_price").val());
                    var estimatedInterest = (agreedPurchasePrice * loanPercentage) * bridgeLoanPercentage * $("#side-estimated_period").val();
                    $('#side-estimated_interest').val(parseInt(Math.round(estimatedInterest)).toLocaleString());
                }
            }
            // Estimated TPC 
            function autoEstimatedTPC(){
                if ($("#side-agreed_purchase_price").val() != "" && $("#side-stamp_duty").val() != "" && $("#side-acquisition_cost").val() != "" && $("#side-agent_fee").val() != "" && $("#side-capex_budget").val() != "" && $("#side-estimated_interest").val() != "") {
                    var agreedPurchasePrice = formatWholeNumber($("#side-agreed_purchase_price").val());
                    var stampDuty = formatWholeNumber($("#side-stamp_duty").val());
                    var acquisitionCost = formatWholeNumber($("#side-acquisition_cost").val());
                    var agentFee = formatWholeNumber($("#side-agent_fee").val());
                    var capexBudget = formatWholeNumber($("#side-capex_budget").val());
                    var estimatedInterest = formatWholeNumber($("#side-estimated_interest").val());
                    var estimatedTPC = parseInt(agreedPurchasePrice) + parseInt(stampDuty) + parseInt(acquisitionCost) + parseInt(agentFee) + parseInt(capexBudget) + parseInt(estimatedInterest);
                    $('#side-estimated_tpc').val(parseInt(Math.round(estimatedTPC)).toLocaleString());
                }
            }
            // Bric Purchase Yield
            function autoBricPurchaseYield(){
                if ($("#side-bric_y1_proposed_rent_pppw").val() != "" && $("#side-tenancy_length_weeks").val() != "" && $("#side-no_of_bric_beds").val() != "" && $("#side-estimated_tpc").val() != "") {
                    var bricY1 = formatWholeNumber($("#side-bric_y1_proposed_rent_pppw").val());
                    var estimatedTpc = formatWholeNumber($("#side-estimated_tpc").val());
                    var bricPurchaseYield = (bricY1 * $("#side-tenancy_length_weeks").val() * $("#side-no_of_bric_beds").val()) / estimatedTpc;
                    var formatedBPY = bricPurchaseYield * 100;
                    $('#side-bric_purchase_yield_percentage').val(formatedBPY.toFixed(3));
                }
            }
            // TPC / Bed Space
            function autoTPCBedSpace(){
                if ($("#side-no_of_bric_beds").val() != "" && $("#side-estimated_tpc").val() != "") {
                    var estimatedTpc = formatWholeNumber($("#side-estimated_tpc").val());
                    var tpcBedspace = (estimatedTpc / $("#side-no_of_bric_beds").val());
                    $('#side-tpc_bedspace').val(parseInt(Math.round(tpcBedspace)).toLocaleString());
                }
            }
            // Existing Bedrom No
            function autoEBN(){
                if ($("#side-existing_bedroom_no").val() != "" && $("#side-agreed_purchase_price").val() != "") {
                    var agreedPurchasePrice = formatWholeNumber($("#side-agreed_purchase_price").val());
                    var existingBedroomNo = (agreedPurchasePrice / $("#side-existing_bedroom_no").val());
                    $('#side-purchase_price_bedspace').val(parseInt(Math.round(existingBedroomNo)).toLocaleString());
                }
            }
            function validateFields(){
                var acquisition_status = $('#side-acquisition_status').val();
                var single_asset_portfolio = $('#side-single_asset_portfolio').val();
                var existing_bedroom_no = $('#side-existing_bedroom_no').val();
                var asking_price = $('#side-asking_price').val();
                var agent = $('#side-agent').val();
                var estimated_period = $('#side-estimated_period').val();
                let cdIsRequired = false;
                if ($('#side-acquisition_status').val() != "") {
                    if ($('#side-acquisition_status').val() === "Completed") {
                        if ($("#side-completion_date").datepicker('getDate') == null) {
                            cdIsRequired = true;
                        }
                    }
                }
                
                if (acquisition_status != "" && single_asset_portfolio != "" && existing_bedroom_no != "" && asking_price != "" && agent != "" && estimated_period !="" != "" && cdIsRequired == false) {
                    return true;
                }else{
                    if (acquisition_status == "") { $('#side-acquisition_status').addClass("is-invalid") }
                    if (single_asset_portfolio == "") { $('#side-single_asset_portfolio').addClass("is-invalid") }
                    if (existing_bedroom_no == "") { $('#side-existing_bedroom_no').addClass("is-invalid") }
                    if (asking_price == "") { $('#side-asking_price').addClass("is-invalid") }
                    if (agent == "") { $('#side-agent').addClass("is-invalid") }
                    if (estimated_period == "") { $('#side-estimated_period').addClass("is-invalid") }
                    if ($('#side-acquisition_status').val() != "") {
                        if ($('#side-acquisition_status').val() === "Completed") {
                            if ($('#completion_date').val() == "") {
                                $('#completion_date').addClass("is-invalid");
                            }
                        }
                    }
                    Swal.fire({
                        title: 'Please fill out all required fields',
                        confirmButtonText: 'Continue',
                        icon: 'warning',
                        })
                    return false;
                }
            }

            $('#side-col_status_log').on('keypress', function(e) {
                // Check if the pressed key is Enter (key code 13) and if there is no shift key pressed
                if (e.which == 13 && !e.shiftKey) {
                    // Do something when a new line is entered
                    // Get the current date and time
                    var now = new Date();
                    var date = moment(now).format('DD/MM/YYYY');
                    // var time = now.toLocaleTimeString();
                    var dateTime = date + ' - ';
                    // Get the textarea value and add the date and time to a new line
                    var textarea = $(this);
                    var value = textarea.val();
                    textarea.val(value + '\n' + dateTime);
                    e.preventDefault();
                }
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
        });
        function formatNumber(e) {
            // Get the user input
            var input = document.getElementById(e).value;
            if (input) {
                // Remove non-numeric characters and leading zeros
                let formattedNumber = input.replace(/[^\d]/g, '').replace(/^0+/, '');
                
                // Add commas for thousands
                formattedNumber = formattedNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                document.getElementById(e).value = formattedNumber;
            }
        }
        function formatWholeNumber(price){
            var numberValue = price;
            numberValue = numberValue.split(',').join('');
            return numberValue;
        }
    </script>
@endpush
@endsection
