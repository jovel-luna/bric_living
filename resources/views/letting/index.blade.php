@extends('layouts.app', ['pageSlug' => 'letting'])

@section('content')

<div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Lettings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Lettings</li>
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
                <div id="lettings" class="col-md-12">
                    @include('layouts.templates.filter.filter')
                    <table id="letting-table" class="table table-bordered letting-table property-list-table m-0" style="width:100%;" autoCompletet>
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox d-flex align-items-center justify-content-center">
                                        <input id="toggleAll" class="mark-all" type="checkbox" value="" checked>
                                    </div>
                                </th>
                                <th>Entity</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>House No./Street</th>
                                <th>Postcode</th>
                                <th>Property Phase</th>
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

                $('#letting-table').DataTable().destroy();
                letting(property_phase, entity, city, area, no_bric_beds, status, postcode, address, show_limit, $('#searching').val(), property_contract_status);
            });

            $('#searching').keyup(function(){
                var search = $(this).val();
                getArrayData();
                $('#letting-table').DataTable().destroy();
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
                var lettingTable = $('#letting-table').DataTable({
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
                        url:"{{ route('letting.index') }}",
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
                        {data: 'checkbox', name: 'checkbox', orderable: false, render:function(data, type, row){
                            return '<input class="selectItem" type="checkbox" value="" checked>';
                        }},
                        {data: 'entity', name: 'entity', orderable: true},
                        {data: 'city', name: 'city', orderable: true},
                        {data: 'area', name: 'area', orderable: true},
                        {data: 'house_and_street', name: 'house_and_street', orderable: true},
                        {data: 'postcode', name: 'postcode', orderable: true},
                        {data: 'property_phase', name: 'property_phase', orderable: true},
                        {data: 'date_available', name: 'date_available', orderable: true,  render:function(data, type, row){
                            if (cua === true || cua === 'true') {
                                return '<input id="date_available_'+row.DT_RowIndex+'" type="text" class="form-control has-datepicker" name="date_available" value="'+ (row.projected_completion_date == null || row.projected_completion_date == '' ? '' : row.projected_completion_date)+'" placeholder="dd-mm-yyyy" style="height: 30px; padding: 0;">';
                            }else{
                                return row.projected_completion_date != 'null' || row.projected_completion_date != '' ? "" : row.projected_completion_date;
                            }
                        }},
                        {data: 'property_contract_status', name: 'property_contract_status', orderable: true, render:function(data, type, row){
                            if (cua === true || cua === 'true') {
                                var csList = [
                                    "Available",
                                    "Pending Info",
                                    "App Sent",
                                    "Contract Sent",
                                    "In Refurb",
                                    "Signed"
                                ];
                                var tempPSoption = '';
                                $.each(csList, function (cs, csVal) {
                                    if (csVal == row.property_contract_status) {
                                        tempPSoption += '<option value="'+csVal+'" selected>'+csVal+'</option>';
                                    }else{
                                        tempPSoption += '<option value="'+csVal+'">'+csVal+'</option>';
                                    }
                                });
                                var tempPSselect =  '<select id="contract_status_'+row.DT_RowIndex+'" name="contract_status" class="form-control contract_status" style="height: 30px; padding: 0;"><option value="">Please Select</option>'+ tempPSoption +'</select>';
                                return tempPSselect;
                            }else{
                                return row.letting_status_name ? row.letting_status_name : 'N/A';
                            }
                        }},
                        {data: 'bed_bath', name: 'bed_bath', orderable: true, render:function(data, type, row){
                            if (cua === true || cua === 'true') {
                                var tempBedBath =   '<div class="row justify-content-center align-items-center">'+
                                                    '<input id="bric_bed" name="bric_bed" type="text" class="form-control" style="padding: 0; width: 25px; height: 30px;" value="'+row.no_bric_beds+'">'+
                                                    '&nbsp;/&nbsp;'+
                                                    '<input id="bric_bath" name="bric_bath" type="text" class="form-control" style="padding: 0; width: 25px; height: 30px;" value="'+row.no_bric_bathrooms+'">'+
                                                    '</div>';
                                return tempBedBath;
                            }else{
                                return row.no_bric_beds+'/'+row.no_bric_bathrooms;
                            }
                        }},
                        {data: 'version', name: 'version', orderable: true, render:function(data, type, row){
                            if (cua === true || cua === 'true') {
                                var vList = [
                                    "V0",
                                    "V1",
                                    "V2",
                                    "External Client"
                                ];
                                var tempVoption = '';
                                $.each(vList, function (xvl, xvlv) {
                                    if (xvlv == row.version) {
                                        tempVoption += '<option value="'+xvlv+'" selected>'+xvlv+'</option>';
                                    }else{
                                        tempVoption += '<option value="'+xvlv+'">'+xvlv+'</option>';
                                    }
                                });
                                var tempVselect =  '<select id="version_'+row.DT_RowIndex+'" name="version" class="form-control version" style="height: 30px; padding: 0;"><option value="">Please Select</option>'+ tempVoption+ '</select>';
                                return tempVselect;
                            }else{
                                return row.version ? row.version : 'N/A';
                            }
                        }},
                        {data: 'target_weekly_rent', name: 'target_weekly_rent', orderable: true, render:function(data, type, row){
                            if (cua === true || cua === 'true') {
                                var twr = row.target_weekly_rent ?  row.target_weekly_rent : '';
                                var temptwr = '<input type="text" id="target_weekly_rent_'+row.DT_RowIndex+'" name="target_weekly_rent" onkeyup="formatNumber(this.id)" class="form-control mx-auto target_weekly_rent" value="'+twr+'" style="padding: 0; height: 30px;" placeholder="Enter amount">';
                                return temptwr;
                            }else{
                                return row.target_weekly_rent ?  row.target_weekly_rent : 'N/A';
                            }
                        }},
                        {data: 'notes', name: 'notes', orderable: false, render:function(data, type, row){
                            if (cua === true || cua === 'true') {
                                // var tempNotes = '<textarea class="form-control" rows="1" cols="10" placeholder="Enter notes"></textarea>';
                                var tempNotes = '<div>'+
                                                    '<a href="#" type="button" data-id="'+row.id+'" class="btn btn-success btn-xs mb-1 add-notes" data-toggle="modal" data-target="#addNotes">'+
                                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                            '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                            '<path d="M12 5l0 14"></path>'+
                                                            '<path d="M5 12l14 0"></path>'+
                                                        '</svg>'+
                                                    '</a>'+
                                                '</div>'+
                                                '<div>'+
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
                                return tempNotes;
                            }else{
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
                            }
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

            // Bulk Action
            $(document).on('click','.b-archive,.b-update', function(e) {
                if ($('table tbody input[type="checkbox"]:checked').length > 0) {
                    switch (e.target.innerText) {
                        case 'Archive':
                            var archiveData = [];
                            var hasError = false;
                            $('table tbody tr').each(function(e) {
                                if ($(this).find('.selectItem').is(':checked')) {
                                    var letid = $(this).attr('id');
                                    if ($(this).find('.contract_status').val() == "Signed") {
                                        archiveData.push({
                                            'id': parseInt(letid),
                                        });
                                    }else{
                                        hasError = true;
                                        return false;
                                    }
                                }
                            });
                            if (!hasError) {
                                Swal.fire({
                                    title: 'Are you sure to archive the selected properties?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes',
                                    confirmButtonColor: '#3085d6'
                                }).then((result) => {
                                    if (result.isConfirmed){
                                        $.ajax({
                                            url: "{{ route('lettings.bulk-archive') }}",
                                            type: 'post',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                data: archiveData
                                            },
                                            success: function(response){
                                                if (response['status'] == 1) {
                                                    Toast.fire({
                                                        icon: 'success',
                                                        text: 'Properties are Successfully Archived'
                                                    });
                                                    $('table').DataTable().ajax.reload();
                                                }
                                            }
                                        });
                                    }
                                });
                            }else{
                                Toast.fire({
                                    icon: 'warning',
                                    text: 'Archiving Failed, There are properties that isn\'t yet set to \"Signed\"'
                                });
                            }

                            break;
                        case 'Update':
                            var updateData = [];

                            $('table tbody tr').each(function(e) {
                                if ($(this).find('.selectItem').is(':checked')) {
                                    var letid = $(this).attr('id');
                                    updateData.push({
                                        'id': parseInt(letid),
                                        'available': $(this).find('input[name="date_available"]').val(),
                                        'contract_status': $(this).find('.contract_status').children("option:selected").val(),
                                        'bric_bed': $(this).find('#bric_bed').val(),
                                        'bric_bath': $(this).find('#bric_bath').val(),
                                        'version': $(this).find('.version').children("option:selected").val(),
                                        'target_weekly_rent': $(this).find('input[name="target_weekly_rent"]').val(),
                                    });
                                }
                            });
                            
                            $.ajax({
                                url: "{{ route('lettings.bulk-update') }}",
                                type: 'post',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    data: updateData
                                },
                                success: function(response){
                                    if (response['status'] == 1) {
                                        Toast.fire({
                                            icon: 'success',
                                            text: 'Properties are Successfully Updated'
                                        });
                                        $('table').DataTable().ajax.reload();
                                    }
                                }
                            });

                            break;
                    }
                } else {
                    Toast.fire({
                        icon: 'warning',
                        text: 'Please a select property to '+e.target.innerText.toLowerCase()+'!',
                        close: true
                    });
                }
            });

            // toggle checkbox
            $("#toggleAll").click(function() {
                $(".selectItem").prop("checked", $(this).prop("checked"));
            });

            // Individual Checkbox
            $(".selectItem").change(function() {
                if ($(".selectItem:checked").length == $(".selectItem").length) {
                $("#toggleAll").prop("checked", true);
                } else {
                $("#toggleAll").prop("checked", false);
                }
            });

            // Add notes
            $('#addNotes').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                $('#nid').val(id);
                $('#note_details').val("");
            });
            var parent_row = '';

            $('#form-notes').submit(function (e) {
                e.preventDefault();
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
                formData['type'] = 'Lettings';

                $.ajax({
                    url: "{{ route('create.notes') }}",
                    method: 'post',
                    data: {
                        formData: formData,
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            Toast.fire({
                                icon: 'success',
                                text: 'Note Successfully added!'
                            });
                            $(".close").trigger('click');
                        }
                    }
                });
            });
            $('#form-update-notes').submit(function (e) {
                e.preventDefault();
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
                formData['type'] = 'Lettings';

                $.ajax({
                    url: 'notes/update/'+formData['update_nid'],
                    method: 'post',
                    data: {
                        formData: formData,
                    },
                    success: function(response){
                        console.log("🚀 ~ file: index.blade.php:430 ~ response:", response)
                        if (response['status'] == 1) {
                            Toast.fire({
                                icon: 'success',
                                text: 'Note Successfully updated!'
                            });
                            var name = response['data']['first_name']+' '+(response['data']['middle_name'] ? response['data']['middle_name'] : '')+' '+response['data']['last_name'];
                            var has_update = moment(response['data']['created_at']).isSame(response['data']['updated_at']);
                            var date_time_created_format = moment(response['data']['created_at']).format('MMMM Do YYYY, h:mm a');
                            var date_time_updated_format = moment(response['data']['updated_at']).format('MMMM Do YYYY, h:mm a');
                            var date_time_diff_created_format = moment(response['data']['created_at']).startOf('hour').fromNow();
                            var date_time_diff_updated_format = moment(response['data']['updated_at']).startOf('hour').fromNow();

                            var note_date = has_update ? date_time_created_format : date_time_updated_format;
                            var note_label = has_update ? 'Created by: ' : 'Updated by: ';
                            var note_diff = has_update ? date_time_diff_created_format : date_time_diff_updated_format;
                            parent_row.find('.note_date').text(note_date);
                            parent_row.find('.note_label').text(note_label);
                            parent_row.find('.note_publisher').text(name);
                            parent_row.find('.note_description').text(response['data']['description']);
                            parent_row.find('.note_diff').text(note_diff);
                            $("#editNotes .close").trigger('click');
                        }
                    }
                });
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
                                    if (cua === true || cua === 'true') {
                                        accessTmp = '<div class="d-flex gap-1">'+
                                                        '<a href="#" data-action="edit" data-id="'+xVal['id']+'" class="edit icon edit-note">'+
                                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>'+
                                                                '<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>'+
                                                                '<path d="M16 5l3 3"></path>'+
                                                            '</svg>'+
                                                        '</a>'+
                                                        '<a href="#" data-action="delete" data-id="'+xVal['id']+'" class="delete icon delete-note">'+
                                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                '<path d="M4 7l16 0"></path>'+
                                                                '<path d="M10 11l0 6"></path>'+
                                                                '<path d="M14 11l0 6"></path>'+
                                                                '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>'+
                                                                '<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>'+
                                                            '</svg>'+
                                                        '</a>'+
                                                    '</div>';
                                    }
                                    noteTmp += '<li class="note-item mb-2">'+
                                                '<div class="mb-1 d-flex justify-content-between">'+
                                                    '<div>'+
                                                        '<div>Date: <strong class="note_date">'+(has_update ? date_time_created_format : date_time_updated_format)+'</strong></div>'+
                                                        '<div><span class="note_label">'+ (has_update ? 'Created':'Updated') +' by: </span><strong class="note_publisher">'+name+'</strong></div>'+
                                                    '</div>'+(cua === true || cua === 'true' ? accessTmp : '')+'</div>'+
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

            // update
            $(document).on('click', '.edit-note', function (e) {
                e.preventDefault();
                parent_row = $(this).closest('.note-item');
                var nid = $(this).attr('data-id');
                $.ajax({
                    url: 'notes/get-single-notes/'+nid,
                    type: 'get',
                    data: {
                        type: 'Lettings'
                    },
                    success: function(response){
                        if (response['data']) {
                            $('#update_nid').val(response['data']['id']);
                            $('#update_note_details').val(response['data']['description']);
                            $('#editNotes').modal('show');
                        }
                    }
                });
            });

            // delete notes
            $(document).on('click', '.delete-note', function(e){
                event.preventDefault();
                var parent_item = $(this).closest('.note-item');
                var nid = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure to remove this note?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Remove',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/notes/delete/' + nid ,
                            method: 'get',
                            success: function(response){
                                if (response.success == 1) {
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Note successfully removed!'
                                    });
                                    parent_item.fadeOut(500, function() { 
                                        $(this).remove();
                                        console.log("🚀 ~ file: index.blade.php:565 ~ $ ~ children:", $("#notes-logs").children("li").length)
                                        if ($("#notes-logs").children("li").length == 0) {
                                            noteTmp = '<li class="no-result"> <h4>No Available Notes</h4> </li>';
                                            $("#notes-logs").empty().append(noteTmp);
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
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
