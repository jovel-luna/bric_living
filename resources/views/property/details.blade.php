@extends('layouts.app', ['pageSlug' => 'details-page'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 id="details-header" class="m-0">
                    <?= ucfirst($data['referrer']); ?>
                </h1>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><?= ucfirst($data['referrer']); ?></li>
                </ol>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex flex-column justify-content-center">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-end mb-4 gap-2">
                    <?php
                        if ($data['referrer']) {
                            switch ($data['referrer']) {
                                case 'acquisition':
                                    $editURL = url('acquisition/'. $data['acquisition']['id'] .'/edit');
                                    break;
                                case 'development':
                                    $editURL = url('development/'. $data['development']['id'] .'/edit');
                                    break;
                                case 'operations':
                                    $editURL = isset($data['operation_utility']) ? url('operation/'. $data['operation_utility']['id'] .'/edit') : '#';
                                    break;
                                case 'lettings':
                                    // $editURL = isset($data['letting']) ? url('letting/'. $data['letting']['id'] .'/edit') : '#';
                                    $editURL = '#';
                                    break;
                                case 'finance':
                                    $editURL = isset($data['finance']) ? url('finance/'. $data['finance']['id'] .'/edit') : '#';
                                    break;
                                default:
                                    $editURL = '#';
                                    break;
                            }
                        }
                    ?>
                <div class="edit-btn-cont" >
                    <a  href="{{ route('property.edit', $pid); }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm edit-btn" data-id="#">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                        EDIT PROPERTY DETAILS
                    </a>
                </div>
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                </div>
                
                <div class="card card-secondary shadow mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold">Property Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Property Phase:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['property_phase'] ? $data['property']['property_phase'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Entity</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['entity'] ? $data['property']['entity'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>City</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['city'] ? $data['property']['city'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Area</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['area'] ? $data['property']['area'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>House No./Street</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        @if($data['property']['house_no_or_name'] && $data['property']['street'])
                                            {{ $data['property']['house_no_or_name'] . ' ' . $data['property']['street'] }}
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Postcode</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['postcode'] ? $data['property']['postcode'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Bric Beds</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['no_bric_beds'] ? $data['property']['no_bric_beds'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Bric Bathrooms</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['no_bric_bathrooms'] ? $data['property']['no_bric_bathrooms'] : 'N/A' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Letting Status</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['letting_status_name'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Purchase Date:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $data['property']['purchase_date'] != '00/00/0000' ? $data['property']['purchase_date'] : 'TBC'; }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="edit-btn-cont {{ $editURL == '#' ? 'd-none' : '' }}" style="display: flex; justify-content: flex-end; margin-bottom: 1.5rem !important ">
                    <a id="details-edit" href="{{ $editURL; }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm edit-btn" data-id="#">
                        <i class="fas fa-edit fa-sm text-white-50"></i>
                        EDIT
                    </a>
                </div>
                <div class="card card-secondary shadow card-outline card-outline-tabs">
                    
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?= $data['referrer'] === 'acquisition' ? 'active' : '' ; ?>" id="acquisition-tab" data-toggle="pill"
                                    href="#acquisition" role="tab" aria-controls="acquisition"
                                    aria-selected="true">Acquisition</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $data['referrer'] === 'development' ? 'active' : '' ; ?>" id="development-tab" data-toggle="pill"
                                    href="#development" role="tab" aria-controls="development"
                                    aria-selected="false">Development</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $data['referrer'] === 'operations' ? 'active' : '' ; ?>" id="operation-tab" data-toggle="pill"
                                    href="#operation" role="tab" aria-controls="operation"
                                    aria-selected="false">Operations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $data['referrer'] === 'lettings' ? 'active' : '' ; ?>" id="letting-tab" data-toggle="pill"
                                    href="#letting" role="tab" aria-controls="letting"
                                    aria-selected="false">Lettings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $data['referrer'] === 'finance' ? 'active' : '' ; ?>" id="finance-tab" data-toggle="pill"
                                    href="#finance" role="tab" aria-controls="finance"
                                    aria-selected="false">Finance</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="document-tab" data-toggle="pill"
                                    href="#document" role="tab" aria-controls="document"
                                    aria-selected="false">Documents</a>
                            </li> --}}
                        </ul>
                    </div>
                    
                    <div class="card-body">
                        
                        <div class="tab-content" id="custom-tab-content">
                            <div class="tab-pane fade <?= $data['referrer'] === 'acquisition' ? 'show active' : '' ; ?>" id="acquisition" role="tabpanel"
                                aria-labelledby="acquisition-tab">
                                @include('layouts.tabs.acquisition')
                            </div>
                            <div class="tab-pane fade <?= $data['referrer'] === 'development' ? 'show active' : '' ; ?>" id="development" role="tabpanel"
                                aria-labelledby="development-tab">
                                @include('layouts.tabs.development')
                            </div>
                            <div class="tab-pane fade <?= $data['referrer'] === 'operations' ? 'show active' : '' ; ?>" id="operation" role="tabpanel"
                                aria-labelledby="operation-tab">
                                @include('layouts.tabs.operations')
                            </div>
                            <div class="tab-pane fade <?= $data['referrer'] === 'lettings' ? 'show active' : '' ; ?>" id="letting" role="tabpanel"
                                aria-labelledby="letting-tab">
                                @include('layouts.tabs.lettings')
                            </div>
                            <div class="tab-pane fade <?= $data['referrer'] === 'finance' ? 'show active' : '' ; ?>" id="finance" role="tabpanel"
                                aria-labelledby="finance-tab">
                                @include('layouts.tabs.finance')
                            </div>
                            {{-- <div class="tab-pane fade" id="document" role="tabpanel"
                                aria-labelledby="document-tab">
                                @include('layouts.tabs.documents')
                            </div> --}}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="colLogModal" tabindex="-1" role="dialog" aria-labelledby="colLogModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="colLogModalLabel">COL Logs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" rows="10" readonly>{{$data['acquisition']['col_status_log']}}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@include('layouts.templates.popups.lettings.add-tenant')
@include('layouts.templates.popups.lettings.add-tenant-notes')
@include('layouts.templates.popups.lettings.view-tenant-notes')
@include('layouts.templates.popups.lettings.edit-tenant-notes')
@include('layouts.templates.popups.dropzone.add-file')
@include('layouts.templates.popups.dropzone.add-property-photo')
@include('layouts.templates.popups.dropzone.add-property-video')
@include('layouts.templates.popups.dropzone.add-property-floorplan')
@include('layouts.templates.popups.planning.add-planning')
@include('layouts.templates.popups.planning.edit-planning')
@include('layouts.templates.popups.logs.add-log')
@include('layouts.templates.popups.logs.view-log')
@include('layouts.templates.popups.logs.edit-log')
@push('scripts')
    <script>
        var document_type = null;
        var cua = "{{ hasAccess('lettings_table_edit') }}";
        Dropzone.autoDiscover = false;
        $(document).ready( function () {
            $( ".has-datepicker" ).datepicker({
                dateFormat: "dd-mm-yy",
                onSelect: function(date) {
                    var elementID = $(this).attr('id');
                    switch (elementID) {
                        case 'date_of_refurb':
                            save(date, 'Lettings', elementID)
                        break;
                    }
                    $('#ui-datepicker-div').css('position', 'relative');

                }
            });

            $(document).on('click', '#custom-tabs .nav-item .nav-link', function(e){
                $('#details-header, .breadcrumb-item.active').text(e.target.text);
                switch (e.target.text) {
                    case 'Acquisition':
                            $('#details-edit').attr("href", "{{url('acquisition/'. $data['acquisition']['id'] .'/edit')}}");
                            $('#details-edit').parent().removeClass('d-none');
                        break;
                    case 'Development':
                        $('#details-edit').attr("href", "{{url('development/'. $data['development']['id'] .'/edit')}}");
                        $('#details-edit').parent().removeClass('d-none');
                        break;
                    case 'Operations':
                        $('#details-edit').attr("href", "{{url('operation/'. $data['operation_utility']['id'] .'/edit')}}");
                        $('#details-edit').parent().removeClass('d-none');
                        break;
                    case 'Lettings':
                        // $('#details-edit').attr("href", "{{url('letting/'. $data['letting']['id'] .'/edit')}}");
                        $('#details-edit').parent().addClass('d-none');
                        break;
                    case 'Finance':
                        $('#details-edit').attr("href", "{{url('finance/'. $data['finance']['id'] .'/edit')}}");
                        $('#details-edit').parent().removeClass('d-none');
                        break;
                }
            })

            $('#acquisition-documents-table').DataTable({
                language: { 
                    processing: 'Loading. Please wait...',
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                    lengthMenu: "_MENU_"
                },
                processing: false,
                serverSide: true,
                bPaginate: false,
                order: [],
                ajax: {
                    url:"{{ route('get.file-documents', ['id' => $data['id'], 'type' => 'acquisition'])}}",
                    type: "GET",
                    beforeSend: function(){
                        $('.loading-container').show();
                    }
                },
                columns: [
                    {data: 'file_date', name: 'file_date', orderable: true},
                    {data: 'file_name', name: 'file_name', orderable: true},
                    {data: 'file_type', name: 'file_type', orderable: true, render:function(data, type, row){
                        return (row.file_type).toUpperCase();
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                        var ft = row.file_type;
                        switch (true) {
                            case (ft == 'jpeg' || ft == 'png' || ft == 'jpg' || ft == 'jpeg' || ft == 'PNG' || ft == 'JPG' || ft == 'JPEG'):
                                var target = '_blank';
                                break;
                            case (ft == 'pdf' || ft == 'PDF'):
                                var target = '_blank';
                                break;
                            case (ft == 'csv' || ft == 'CSV'):
                                var target = '_blank';
                                break;
                            case (ft == 'xlsx' || ft == 'XLSX'):
                                var target = '_blank';
                                break;
                        }
                        return  '<div class="action-btn files-action d-flex justify-content-center">'+
                                    '<a href="'+baseUrl+'/'+row.file_path+'" target="'+target+'" data-type="document" id="preview-btn" class="view">Preview</a>'+
                                    '<a href="#" data-id="'+row.id+'" data-type="document" data-cat="acquisition" id="remove-btn" class="delete-file">Remove</a>'+
                                '</div>';
                    }},
                ]
            });
            $('#development-documents-table').DataTable({
                language: { 
                    processing: 'Loading. Please wait...',
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                    lengthMenu: "_MENU_"
                },
                processing: false,
                serverSide: true,
                bPaginate: false,
                order: [],
                ajax: {
                    url:"{{ route('get.file-documents', ['id' => $data['id'], 'type' => 'development'])}}",
                    type: "GET",
                    beforeSend: function(){
                        $('.loading-container').show();
                    }
                },
                columns: [
                    {data: 'file_date', name: 'file_date', orderable: true},
                    {data: 'file_name', name: 'file_name', orderable: true},
                    {data: 'file_type', name: 'file_type', orderable: true, render:function(data, type, row){
                        return (row.file_type).toUpperCase();
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                        var ft = row.file_type;
                        switch (true) {
                            case (ft == 'jpeg' || ft == 'png' || ft == 'jpg' || ft == 'jpeg' || ft == 'PNG' || ft == 'JPG' || ft == 'JPEG'):
                                var target = '_blank';
                                break;
                            case (ft == 'pdf' || ft == 'PDF'):
                                var target = '_blank';
                                break;
                            case (ft == 'csv' || ft == 'CSV'):
                                var target = '_blank';
                                break;
                            case (ft == 'xlsx' || ft == 'XLSX'):
                                var target = '_blank';
                                break;
                        }
                        return  '<div class="action-btn files-action d-flex justify-content-center">'+
                                    '<a href="'+baseUrl+'/'+row.file_path+'" target="'+target+'" data-type="document" id="preview-btn" class="view">Preview</a>'+
                                    '<a href="#" data-id="'+row.id+'" data-type="document" data-cat="development" id="remove-btn" class="delete-file">Remove</a>'+
                                '</div>';
                    }},
                ]
            });
            $('#operations-documents-table').DataTable({
                language: { 
                    processing: 'Loading. Please wait...',
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                    lengthMenu: "_MENU_"
                },
                processing: false,
                serverSide: true,
                bPaginate: false,
                order: [],
                ajax: {
                    url:"{{ route('get.file-documents', ['id' => $data['id'], 'type' => 'operations'])}}",
                    type: "GET",
                    beforeSend: function(){
                        $('.loading-container').show();
                    }
                },
                columns: [
                    {data: 'file_date', name: 'file_date', orderable: true},
                    {data: 'file_name', name: 'file_name', orderable: true},
                    {data: 'file_type', name: 'file_type', orderable: true, render:function(data, type, row){
                        return (row.file_type).toUpperCase();
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                        var ft = row.file_type;
                        switch (true) {
                            case (ft == 'jpeg' || ft == 'png' || ft == 'jpg' || ft == 'jpeg' || ft == 'PNG' || ft == 'JPG' || ft == 'JPEG'):
                                var target = '_blank';
                                break;
                            case (ft == 'pdf' || ft == 'PDF'):
                                var target = '_blank';
                                break;
                            case (ft == 'csv' || ft == 'CSV'):
                                var target = '_blank';
                                break;
                            case (ft == 'xlsx' || ft == 'XLSX'):
                                var target = '_blank';
                                break;
                        }
                        return  '<div class="action-btn files-action d-flex justify-content-center">'+
                                    '<a href="'+baseUrl+'/'+row.file_path+'" target="'+target+'" data-type="document" id="preview-btn" class="view">Preview</a>'+
                                    '<a href="#" data-id="'+row.id+'" data-type="document" data-cat="operations" id="remove-btn" class="delete-file">Remove</a>'+
                                '</div>';
                    }},
                ]
            });
            $('#lettings-documents-table').DataTable({
                language: { 
                    processing: 'Loading. Please wait...',
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                    lengthMenu: "_MENU_"
                },
                processing: false,
                serverSide: true,
                bPaginate: false,
                order: [],
                ajax: {
                    url:"{{ route('get.file-documents', ['id' => $data['id'], 'type' => 'lettings'])}}",
                    type: "GET",
                    beforeSend: function(){
                        $('.loading-container').show();
                    }
                },
                columns: [
                    {data: 'file_date', name: 'file_date', orderable: true},
                    {data: 'file_name', name: 'file_name', orderable: true},
                    {data: 'file_type', name: 'file_type', orderable: true, render:function(data, type, row){
                        return (row.file_type).toUpperCase();
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                        var ft = row.file_type;
                        var previewTemp = ''; 
                        switch (true) {
                            case (ft == 'jpeg' || ft == 'png' || ft == 'jpg' || ft == 'jpeg' || ft == 'PNG' || ft == 'JPG' || ft == 'JPEG'):
                                var target = '_blank';
                                break;
                            case (ft == 'pdf' || ft == 'PDF'):
                                var target = '_blank';
                                break;
                            case (ft == 'csv' || ft == 'CSV'):
                                var target = '_blank';
                                break;
                            case (ft == 'xlsx' || ft == 'XLSX'):
                                var target = '_blank';
                                break;
                        }
                        return  '<div class="action-btn files-action d-flex justify-content-center">'+
                                    '<a href="'+baseUrl+'/'+row.file_path+'" target="'+target+'" data-type="document" id="preview-btn" class="view">Preview</a>'+
                                    '<a href="#" data-id="'+row.id+'" data-type="document" data-cat="lettings" id="remove-btn" class="delete-file">Remove</a>'+
                                '</div>';
                    }},
                ]
            });
            $('#finance-documents-table').DataTable({
                language: { 
                    processing: 'Loading. Please wait...',
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                    lengthMenu: "_MENU_"
                },
                processing: false,
                serverSide: true,
                bPaginate: false,
                order: [],
                ajax: {
                    url:"{{ route('get.file-documents', ['id' => $data['id'], 'type' => 'finance'])}}",
                    type: "GET",
                    beforeSend: function(){
                        $('.loading-container').show();
                    }
                },
                columns: [
                    {data: 'file_date', name: 'file_date', orderable: true},
                    {data: 'file_name', name: 'file_name', orderable: true},
                    {data: 'file_type', name: 'file_type', orderable: true, render:function(data, type, row){
                        return (row.file_type).toUpperCase();
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                        var ft = row.file_type;
                        switch (true) {
                            case (ft == 'jpeg' || ft == 'png' || ft == 'jpg' || ft == 'jpeg' || ft == 'PNG' || ft == 'JPG' || ft == 'JPEG'):
                                var target = '_blank';
                                break;
                            case (ft == 'pdf' || ft == 'PDF'):
                                var target = '_blank';
                                break;
                            case (ft == 'csv' || ft == 'CSV'):
                                var target = '_blank';
                                break;
                            case (ft == 'xlsx' || ft == 'XLSX'):
                                var target = '_blank';
                                break;
                        }
                        return  '<div class="action-btn files-action d-flex justify-content-center">'+
                                    '<a href="'+baseUrl+'/'+row.file_path+'" target="'+target+'" data-type="document" id="preview-btn" class="view">Preview</a>'+
                                    '<a href="#" data-id="'+row.id+'" data-type="document" data-cat="finance" id="remove-btn" class="delete-file">Remove</a>'+
                                '</div>';
                    }},
                ]
            });

            $('table#documents-table thead tr th').on('click', function(){
                setTimeout(function() {
                    $('.loading-container').hide();
                }, 1500);
            });

            // Planning Table
            $('#planning-table').DataTable({
                language: { 
                    processing: 'Loading. Please wait...',
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                    lengthMenu: "_MENU_"
                },
                processing: false,
                serverSide: true,
                bPaginate: false,
                order: [],
                ajax: {
                    url:"{{ route('get.planning', $data['id'])}}",
                    type: "GET",
                    beforeSend: function(){
                        $('.loading-container').show();
                    }
                },
                columns: [
                    {data: 'bric_planning_ref_no', name: 'bric_planning_ref_no', orderable: true},
                    {data: 'date_submitted', name: 'date_submitted', orderable: true},
                    {data: 'approved', name: 'approved', orderable: true , render:function(data, type, row){
                        // console.log(data)
                        // console.log(type)
                        // console.log(row)
                        if (data == 1) {
                            return 'Yes';
                        }
                        else {
                            return 'No';
                        }
                    }},
                    {data: 'application_desc', name: 'application_desc', orderable: true},
                    {data: 'action', name: 'action', orderable: false, searchable: false, render:function(data, type, row){
                        return  '<div class="action-btn planning-action d-flex justify-content-center">'+
                                    '<a href="#" data-id="'+row.id+'" data-type="planning" id="edit-text-btn" class="edit">Edit</a>'+
                                    '<a href="#" data-id="'+row.id+'" data-type="planning" id="remove-btn" class="delete">Remove</a>'+
                                '</div>';
                    }},
                ]
            });
            setTimeout(function() {
                $('.loading-container').hide();
            }, 1000);
            $('table#planning-table thead tr th').on('click', function(){
                setTimeout(function() {
                    $('.loading-container').hide();
                }, 1500);
            });

            $(".dataTables_length").addClass('d-none'); 
            $(".dataTables_filter").addClass('d-none');
            $(".dataTables_info").addClass('d-none');

            $(document).on('click', '.addFileModalBtn', function(e){
                document_type = $(this).attr('data-cat');
                dropzoneInitialization();
            });

            if ($('#my-dropzone').length) {
                // Initialize Dropzone
                var myDropzone = new Dropzone("#my-dropzone", {
                    url: baseUrl+'/upload/'+"{{$data['id']}}/"+document_type,
                    paramName: "file",
                    uploadMultiple: true,
                    maxFiles: 5,
                    parallelUploads: 5,
                    acceptedFiles: ".jpg,.jpeg,.png,.pdf,.csv,.xlsx",
                    addRemoveLinks: true,
                    dictDefaultMessage: "Drag and drop files here or click to upload",
                    autoProcessQueue: false // Disable auto processing of files
                });
    
                // Upload button click event
                $("#uploadButton").on("click", function() {
                    myDropzone.processQueue(); // Manually trigger file upload
                });
    
                // Success event handler
                myDropzone.on("success", function(file, response) {
                    if (response.success) {
                        $('#addFileModal').find('.close').trigger( "click" );
                        Toast.fire({
                            icon: 'success',
                            text: 'Files successfully uploaded!'
                        });
                        $('#'+document_type+'-documents-table').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('.loading-container').hide();
                        }, 1500);
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: 'Files failed to upload!'
                        });
                    }
                });
    
                myDropzone.on("error", function (file, message) {
                    myDropzone.removeFile(file);
                    Toast.fire({
                        icon: 'warning',
                        title: message
                    });
                }); 
                // Removed file event handler
                myDropzone.on("removedfile", function(file) {
                });
            }

            function dropzoneInitialization() {
                myDropzone.on("processing", function(file) {
                    myDropzone.options.url = baseUrl+'/upload/'+"{{$data['id']}}/"+document_type;
                });
            }

            $('#addFileModal').on('hidden.bs.modal', function() {
                myDropzone.removeAllFiles();
            });
            $(document).on('click', '.edit', function(e){
                e.preventDefault();
                var fileid = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                switch (type) {
                    case 'planning':
                        $.ajax({
                            url: '/acquisition/getSpecificPlanning/' + fileid ,
                            method: 'get',
                            success: function(response){
                                if (response['data']) {
                                    $('#editPlanningForm').find('#bric_planning_ref_no').val(response['data'][0]['bric_planning_ref_no']);
                                    $('#editPlanningForm').find('#edit_date_submitted').datepicker('setDate', response['data'][0]['date_submitted']);
                                    $('#editPlanningForm').find('#approved').val(response['data'][0]['approved']);
                                    $('#editPlanningForm').find('#application_desc').val(response['data'][0]['application_desc']);
                                    $('#editPlanningForm').attr('data-id', response['data'][0]['id']);
                                    $('#editPlanningModal').modal('show');
                                }
                            }
                        });
                        break;
                }
            });

            $(document).on('click', '.delete-file, .delete', function(e){
                e.preventDefault();
                var fileid = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                document_type = $(this).attr('data-cat');
                switch (type) {
                    case 'document':
                        Swal.fire({
                            title: 'Do you want to remove this file?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Remove',
                            confirmButtonColor: '#3085d6'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/document/remove-file/' + fileid ,
                                    method: 'get',
                                    success: function(response){
                                        if (response.success == 1) {
                                            Toast.fire({
                                                icon: 'success',
                                                text: 'File successfully removed!'
                                            });
                                            $('#'+document_type+'-documents-table').DataTable().ajax.reload();
                                            setTimeout(function() {
                                                $('.loading-container').hide();
                                            }, 1500);
                                        }
                                    }
                                });
                            }
                        });
                        break;
                    case 'planning':
                        Swal.fire({
                            title: 'Are you sure to remove this planning?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Remove',
                            confirmButtonColor: '#3085d6'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/acquisition/removePlanning/' + fileid ,
                                    method: 'get',
                                    success: function(response){
                                        if (response.success == 1) {
                                            Toast.fire({
                                                icon: 'success',
                                                text: 'Planning successfully removed!'
                                            });
                                            $('#planning-table').DataTable().ajax.reload();
                                            setTimeout(function() {
                                                $('.loading-container').hide();
                                            }, 1500);
                                        }
                                    }
                                });
                            }
                        });
                        break;
                }
            });

            $('#addPlanningModal').on('hidden.bs.modal', function() {
                $('#planningForm').find('.form-control').val('');
                $('#planningForm').find('.form-control').removeClass('is-invalid');
                $('#planningForm').find('.invalid-feedback').remove();
            });

            $.validator.setDefaults({
                submitHandler: function (e) {

                    const fData = $(e).serializeArray();
                    let formData = {};
                    fData.forEach((value, key) => {
                        formData[value['name']] = value['value'];
                    });
                    switch (e.id) {
                        case 'planningForm':
                            $.ajax({
                                url: "{{ route('store.planning', $data['id']) }}",
                                method: 'post',
                                data: {
                                    formData: formData,
                                },
                                success: function(response){
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Planning successfully added!'
                                    })
                                    $('#addPlanningModal').find('.close').trigger( "click" );
                                    $('#planning-table').DataTable().ajax.reload();
                                    setTimeout(function() {
                                        $('.loading-container').hide();
                                    }, 1500);
                                }
                            });
                            break;
                        case 'editPlanningForm':
                            var planningID = $('#editPlanningForm').attr('data-id');
                            $.ajax({
                                url: '/acquisition/updatePlanning/'+ planningID,
                                method: 'post',
                                data: {
                                    formData: formData,
                                },
                                success: function(response){
                                    if (response['data'] === 'Success') {
                                        Toast.fire({
                                            icon: 'success',
                                            text: 'Planning successfully updated!'
                                        });
                                        $('#editPlanningModal').find('.close').trigger( "click" );
                                        $('#planning-table').DataTable().ajax.reload();
                                        setTimeout(function() {
                                            $('.loading-container').hide();
                                        }, 1500);
                                    }
                                }
                            });
                            break;
                    }
                    return false;
                }
            });

            $('#planningForm').validate({
                rules: {
                    bric_planning_ref_no: {
                        required: true,
                    },
                    date_submitted: {
                        required: true,
                    },
                    approved: {
                        required: true
                    },
                    application_desc: {
                        required: true
                    },
                },
                messages: {
                    bric_planning_ref_no: {
                        required: "Please enter a bric planning reference #",
                    },
                    date_submitted: {
                        required: "Please select a date",
                    },
                    approved: {
                        required: "Please choose an option",
                    },
                    application_desc: {
                        required: "Please enter a application description",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#editPlanningForm').validate({
                rules: {
                    bric_planning_ref_no: {
                        required: true,
                    },
                    date_submitted: {
                        required: true,
                    },
                    approved: {
                        required: true
                    },
                    application_desc: {
                        required: true
                    },
                },
                messages: {
                    bric_planning_ref_no: {
                        required: "Please enter a bric planning reference #",
                    },
                    date_submitted: {
                        required: "Please select a date",
                    },
                    approved: {
                        required: "Please choose an option",
                    },
                    application_desc: {
                        required: "Please enter a application description",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


            // Development Tab
            var hsArray = [];
            $(document).on('change', 'input[name="hsCheckbox[]"]', function(){
                hsArray = [];
                $("input:checkbox[name='hsCheckbox[]']:checked").each(function(){
                    hsArray.push($(this).val());
                });
                var hs_development_compliance = hsArray;
                $.ajax({
                    url: "/development/updateHsDevelopment/"+"{{ $data['development']['id'] }}",
                    method: 'post',
                    data: {
                        hs_development_compliance: hs_development_compliance,
                    },
                    success: function(response){
                        if (response['data'] === 'Success') {
                            Toast.fire({
                                icon: 'success',
                                text: 'H&S Development Compliance successfully updated!'
                            });
                            
                        }
                    }
                });
            });

            // Lettings
            $('.info-floorplan').magnificPopup({
                delegate: '.popup-link',
                type:'image',
            });
            $('.lettings-floorplan-parent').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: '.lettings-floorplan-img', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled:true
                    }
                });
            });
            $('.lettings-gallery-parent').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: '.lettings-gallery-img', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled:true
                    }
                });
            });
            $('.lettings-video-parent').magnificPopup({
                delegate: '.popup-player',
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false,
                iframe: {
                    markup: '<div class="mfp-iframe-scaler">'+
                            '<div class="mfp-close"></div>'+
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                        '</div>',

                    srcAction: 'iframe_src',
                },
                gallery: {
                    enabled:true
                }
            });

            // save lettings
            $(document).on('click', '.add-floorplan', function(){
                $('#floorplan').trigger('click');
            });
            $(document).on('change', '#tv, #target_weekly_rent, #achieved_weekly_rent, #floorplan', function(e){
                var data = $(this).val();
                var category = 'Lettings';
                var field = $(this).attr('id');
                switch (field) {
                    case 'target_weekly_rent':
                        var calcTAR = 0;
                        var twrAmount = data;
                        var twrNumber = twrAmount.replace(/,/g, '');
                        calcTAR = parseFloat(twrNumber) * 52;
                        $('.target_monthly_rent').text((calcTAR/12).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                        $('.target_quarterly_rent').text((calcTAR/4).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                        $('.target_annual_rent').text(calcTAR.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                        
                    break;
                    case 'achieved_weekly_rent':
                        var calcAAR = 0;
                        var awrAmount = data;
                        var awrNumber = awrAmount.replace(/,/g, '');
                        calcAAR = parseFloat(awrNumber) * 52;
                        $('.achieved_monthly_rent').text((calcAAR/12).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                        $('.achieved_quarterly_rent').text((calcAAR/4).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                        $('.achieved_annual_rent').text(calcAAR.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                    break;
                }
                save(data, category, field);
            });
            $(document).on('click', '.add-tenant', function(e){
                var totalTenants = $('.ct-accordion').children('.accordion-item').length;
                var totalBeds = "{{$data['property']['no_bric_beds']}}";
                if (totalTenants == totalBeds) {
                    Toast.fire({
                        icon: 'warning',
                        text: 'Tenants are full: '+ totalTenants + '/' + totalBeds
                    });
                }else{
                    $('#addTenant').modal('show');
                }
            });

            $('#form-tenant').submit(function (e) {
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
                    url: "{{ route('tenant.store') }}",
                    method: 'post',
                    data: {
                        formData: formData,
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            var hasAccess = "{{ hasAccess('lettings_table_edit') }}";
                            var name = '';
                            var source = '';
                            var tenant_contract_status = '';
                            var id_certified = '';
                            var poa = '';
                            var deposits_paid = '';
                            var document_outstanding = '';
                            var contact_notes = '';
                            if (hasAccess === true || hasAccess === 'true') {
                                name += '<input type="text" name="name" class="form-control form-control-sm name" value="'+response['data']['name']+'" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;" placeholde="Enter name">';
                                source += '<input type="text" name="source" class="form-control form-control-sm source" value="'+response['data']['source']+'" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;" placeholde="Enter source">';
                                tenant_contract_status +=   '<select name="tenant_contract_status" class="form-control form-control-sm tenant_contract_status" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">'+
                                                                '<option value="">Please Select</option>'+
                                                                '<option value="Pending Info" '+(response['data']['tenant_contract_status'] == "Pending Info" ? "selected" : "")+'>Pending Info</option>'+
                                                                '<option value="App Sent" '+(response['data']['tenant_contract_status'] == "App Sent" ? "selected" : "")+'>App Sent</option>'+
                                                                '<option value="Contract Sent" '+(response['data']['tenant_contract_status'] == "Contract Sent" ? "selected" : "")+'>Contract Sent</option>'+
                                                                '<option value="Contract Signed" '+(response['data']['tenant_contract_status'] == "Contract Signed" ? "selected" : "")+'>Contract Signed</option>'+
                                                            '</select>';
                                id_certified =  '<select name="id_certified" class="form-control form-control-sm id_certified" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">'+
                                                    '<option value="">Please Select</option>'+
                                                    '<option value="1" '+(response['data']['id_certified'] == 1 ? "selected" : "")+'>Yes</option>'+
                                                    '<option value="0" '+(response['data']['id_certified'] == 0 ? "selected" : "")+'>No</option>'+
                                                '</select>';
                                poa =   '<select name="poa" class="form-control form-control-sm poa" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">'+
                                            '<option value="">Please Select</option>'+
                                            '<option value="1" '+(response['data']['poa'] == 1 ? "selected" : "")+'>Yes</option>'+
                                            '<option value="0" '+(response['data']['poa'] == 0 ? "selected" : "")+'>No</option>'+
                                        '</select>';
                                deposits_paid = '<select name="deposits_paid" class="form-control form-control-sm deposits_paid" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">'+
                                                    '<option value="">Please Select</option>'+
                                                    '<option value="1" '+(response['data']['deposits_paid'] == "1" ? "selected" : "")+'>Yes</option>'+
                                                    '<option value="0" '+(response['data']['deposits_paid'] == "0" ? "selected" : "")+'>No</option>'+
                                                '</select>';
                                document_outstanding = '<select name="document_outstanding" class="form-control form-control-sm document_outstanding" style=" width: 200px; margin: 0 auto; padding: 0; height: 30px;">'+
                                                            '<option value="">Please Select</option>'+
                                                            '<option value="1" '+(response['data']['document_outstanding'] == "1" ? "selected" : "")+'>Yes</option>'+
                                                            '<option value="0" '+(response['data']['document_outstanding'] == "0" ? "selected" : "")+'>No</option>'+
                                                        '</select>';
                                contact_notes = '<button class="btn btn-success btn-xs add-tenant-notes"  data-id="'+response['data']['id']+'" data-toggle="modal" data-target="#addTenantNotes">'+
                                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                        '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                        '<path d="M12 5l0 14"></path>'+
                                                        '<path d="M5 12l14 0"></path>'+
                                                    '</svg>'+
                                                '</button>'+
                                                '<button class="btn btn-info btn-xs view-tenant-notes ml-1" data-id="'+response['data']['id']+'">'+
                                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                        '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                        '<path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>'+
                                                        '<path d="M9 7l6 0"></path>'+
                                                        '<path d="M9 11l6 0"></path>'+
                                                        '<path d="M9 15l4 0"></path>'+
                                                    '</svg>'+
                                                '</button>';
                            }else{
                                name = response['data']['name'];
                                source = response['data']['source'] ? response['data']['source'] : 'N/A';
                                tenant_contract_status = response['data']['tenant_contract_status'] ? response['data']['tenant_contract_status'] : 'N/A';
                                id_certified = response['data']['id_certified'] == 1 ? 'Yes' : 'No';
                                poa = response['data']['poa'] == 1 ? 'Yes' : 'No';
                                deposits_paid = response['data']['deposits_paid'] == '1' ? 'Yes' : 'No';
                                document_outstanding = response['data']['document_outstanding'] == '1' ? 'Yes' : 'No'; 
                                contact_notes = '<button class="btn btn-info btn-xs view-tenant-notes ml-1" data-id="'+response['data']['id']+'">'+
                                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                        '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                        '<path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>'+
                                                        '<path d="M9 7l6 0"></path>'+
                                                        '<path d="M9 11l6 0"></path>'+
                                                        '<path d="M9 15l4 0"></path>'+
                                                    '</svg>'+
                                                '</button>';
                            }
                            var status = response['data']['status'] == 1 ? 'success' : 'warning';
                            var tid = response['data']['id'];
                            var numberoftenant = $('.ct-accordion').children('.accordion-item').length + 1;
                            var tenantTmp = '<div data-id="'+tid+'" class="col-md-12 accordion-item">'+
                                                '<div class="card card-'+ status +' card-outline mb-1">'+
                                                    '<a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse'+tid+'" aria-expanded="false">'+
                                                        '<div class="card-header">'+
                                                           '<h6 class="card-title w-100">'+
                                                                'TENANT #'+ numberoftenant + ' - <span class="tenant-name">'+response['data']['name']+'</span>'+
                                                            '</h6>'+
                                                        '</div>'+
                                                    '</a>'+
                                                    '<div id="collapse'+tid+'" class="collapse" data-parent="#accordion" style="">'+
                                                        '<div class="card-body p-0">'+
                                                            '<table data-id="'+tid+'" class="table table-striped m-0">'+
                                                                '<thead> <tr><th>#</th><th>Description</th><th>Status</th></tr></thead>'+
                                                                '<tbody>'+
                                                                    '<tr> <td>1</td> <td>Name</td> <td>'+name+'</td> </tr>'+
                                                                    '<tr> <td>2</td> <td>Source</td> <td>'+source+'</td> </tr>'+
                                                                    '<tr> <td>3</td> <td>Contract Status</td> <td>'+tenant_contract_status+'</td> </tr>'+
                                                                    '<tr> <td>4</td> <td>ID Certified</td> <td>'+id_certified+'</td> </tr>'+
                                                                    '<tr> <td>5</td> <td>POA\'s</td> <td>'+poa+'</td> </tr>'+
                                                                    '<tr> <td>6</td> <td>Contract Notes</td> <td>'+contact_notes+'</td> </tr>'+
                                                                    '<tr> <td>7</td> <td>Deposits Paid</td> <td>'+deposits_paid+'</td> </tr>'+
                                                                    '<tr> <td>8</td> <td>Complete Documents</td> <td>'+document_outstanding+'</td> </tr>'+
                                                                    '<tr> <td></td> <td></td><td><button class="btn btn-success btn-xs" title="Renew">Renew</button></td></tr>'+
                                                                '</tbody>'+
                                                            '</table>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>';
                            if (numberoftenant == 1) {
                                $('.ct-accordion').empty();
                            }
                            $('.no-of-tenants').text(numberoftenant);
                            $('.ct-accordion').append(tenantTmp);
                            Toast.fire({
                                icon: 'success',
                                text: 'A new tenant has been added!'
                            });
                            $('#addTenant #form-tenant').find('#name').val('');
                            $('#addTenant #form-tenant').find('#source').val('');
                            $('#addTenant #form-tenant').find('#tenant_contract_status').val('');
                            $('#addTenant #form-tenant').find('#id_certified').val('');
                            $('#addTenant #form-tenant').find('#poa').val('');
                            $('#addTenant #form-tenant').find('#deposits_paid').val('');
                            $('#addTenant #form-tenant').find('#document_outstanding').val('');
                            $(".close").trigger('click');
                        }
                    }
                });
            });
            function save(data, category, field){
                $.ajax({
                    url: "{{ route('lettings.update') }}",
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        data: {
                            id: '{{$data["letting"]["id"]}}',
                            value: data,
                            category: category,
                            field: field
                        }
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            var fieldUpdated = field.replace(/_/g, ' ').toUpperCase();
                            Toast.fire({
                                icon: 'success',
                                text: fieldUpdated+' successfully updated'
                            });
                        }
                    }
                });
            };

            // Link to 3D

            $('#form-links').submit(function(e){
                e.preventDefault();
                var formData = getFormData(e, 'Letting');
                
                $.ajax({
                    url: "{{ route('store.links') }}",
                    method: 'post',
                    data: {
                        formData: formData,
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            var numberoflink = $('#links').children('.link-item').length;
                            if (numberoflink == 0) {
                                $('#links').empty();
                            }
                            var link =  '<li class="link-item">'+
                                            '<div class="d-flex gap-2">'+
                                                '<a href="'+response['data']['path']+'" target="_blank" style="font-size: 15px!important;">'+response['data']['name']+'</a>'+
                                                '<span class="action-section d-flex gap-1 align-items-center">'+
                                                    '<span class="copy-link" style="color: #007bff;" title="Copy">'+
                                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>'+
                                                    '</span>'+
                                                    '<span data-id="'+response['data']['id']+'" class="remove-link" style="color: #ff0000;" title="Remove">'+
                                                        '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M4 7l16 0"></path> <path d="M10 11l0 6"></path> <path d="M14 11l0 6"></path> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>'+
                                                    '</span>'+
                                                '</span>'+
                                            '</div>'+
                                       '</li>';
                            $('#links').append(link);
                            Toast.fire({
                                icon: 'success',
                                text: 'A new link has been added!'
                            });
                            $('#url_name').val("");
                            $('#url_link').val("");
                        }
                    }
                });
                
            });

            $(document).on('click', '.copy-link', function(e){
                e.preventDefault(); // Prevents the link from navigating
                
                // Get the URL from the href attribute
                var url = $(this).closest('.link-item').find('a').attr('href');
                
                // Create a temporary input element
                var input = $("<input>");
                $("body").append(input);
                input.val(url).select();
                
                // Copy the URL to the clipboard
                document.execCommand("copy");
                
                // Remove the temporary input element
                input.remove();
                
                // Provide user feedback (optional)
                Toast.fire({
                    icon: 'success',
                    text: 'Link copied to clipboard'
                });
            });
            $(document).on('click', '.remove-link', function(e){
                e.preventDefault(); // Prevents the link from navigating
                var link_name = $(this).closest('.link-item').find('a').text();
                var parentObj = $(this).closest('.link-item');
                var linkid = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure you want to remove link?',
                    text: link_name,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed){
                        $.ajax({
                            url: "{{ route('remove.links') }}",
                            type: 'post',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: parseInt(linkid)
                            },
                            success: function(response){
                                if (response['status'] == 1) {
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Link successfully removed!'
                                    });
                                    
                                    parentObj.fadeToggle();
                                    setTimeout(function() {
                                        parentObj.remove()
                                        var numberoflink = $('#links').children('.link-item').length;
                                        if (numberoflink == 0) {
                                            var linkTmp = '<h5>No Lnks Available</h5>';
                                            $('#links').append(linkTmp);
                                        }
                                    }, 400);

                                }
                            }
                        });
                    }
                });
            });

            // Tenant Notes
            // Add notes
            $('#addTenantNotes').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                $('#tid').val(id);
                $('#tenant_note_details').val("");
            });
            var parent_row = '';

            $('#form-tenant-notes').submit(function (e) {
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
                    url: "{{ route('create.tenant-notes') }}",
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
            $('#form-update-tenant-notes').submit(function (e) {
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
                    url: baseUrl+'/notes/update-tenant-notes/'+formData['update_tenant_tnid'],
                    method: 'post',
                    data: {
                        formData: formData,
                    },
                    success: function(response){
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
                            $("#editTenantNotes .close").trigger('click');
                        }
                    }
                });
            });

            // view tenant notes
            $(document).on('click', '.view-tenant-notes', function (e) {
                e.preventDefault();
                var tnid = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('get.tenant-notes') }}",
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                        tnid: tnid,
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
                                                        '<a href="#" data-action="edit" data-id="'+xVal['id']+'" class="edit icon edit-tenant-note">'+
                                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>'+
                                                                '<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>'+
                                                                '<path d="M16 5l3 3"></path>'+
                                                            '</svg>'+
                                                        '</a>'+
                                                        '<a href="#" data-action="delete" data-id="'+xVal['id']+'" class="delete icon delete-tenant-note">'+
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
                            $("#tenant-notes-logs").empty().append(noteTmp);
                            $('#viewTenantNotes').modal('show');
                        }
                    }
                });
            });

            // update tenant notes
            $(document).on('click', '.edit-tenant-note', function (e) {
                e.preventDefault();
                parent_row = $(this).closest('.note-item');
                var tnid = $(this).attr('data-id');
                $.ajax({
                    url: baseUrl+'/notes/get-single-tenant-notes/'+tnid,
                    type: 'get',
                    data: {
                        type: 'Lettings'
                    },
                    success: function(response){
                        if (response['data']) {
                            $('#update_tenant_tnid').val(response['data']['id']);
                            $('#update_tenant_note_details').val(response['data']['description']);
                            $('#editTenantNotes').modal('show');
                        }
                    }
                });
            });

            // delete notes
            $(document).on('click', '.delete-tenant-note', function(e){
                event.preventDefault();
                var parent_item = $(this).closest('.note-item');
                var tnid = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure to remove this note?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Remove',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/notes/delete-tenant-notes/' + tnid ,
                            method: 'get',
                            success: function(response){
                                if (response.success == 1) {
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Note successfully removed!'
                                    });
                                    parent_item.fadeOut(500, function() { 
                                        $(this).remove();
                                        if ($("#tenant-notes-logs").children("li").length == 0) {
                                            noteTmp = '<li class="no-result"> <h4>No Available Notes</h4> </li>';
                                            $("#tenant-notes-logs").empty().append(noteTmp);
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });

            // Tenant Auto Update
            $(document).on('focusin', 'input.name, input.source', function(e){
                $(this).data('val', $(this).val());
            })
            $(document).on('blur', 'input.name, input.source', function(e){
                var parentobj = $(this).closest('.card');
                var tid = $(this).closest('table').attr('data-id');
                var tfield = $(this).attr('name');
                var prevVal = $(this).data('val');
                var currVal = $(this).val();

                if (prevVal != currVal) {
                    updateTenant(tid, currVal, tfield, parentobj);
                }
            })

            $(document).on('change', 'select.tenant_contract_status, select.id_certified, select.poa, select.deposits_paid, select.document_outstanding', function(e){
                var parentobj = $(this).closest('.card');
                var tid = $(this).closest('table').attr('data-id');
                var tfield = $(this).attr('name');
                var currVal = $(this).val();
                updateTenant(tid, currVal, tfield, parentobj);
            })

            function updateTenant(tid, currVal, tfield, parentobj){
                $.ajax({
                    url: baseUrl+'/tenant/update/'+tid,
                    method: 'post',
                    data: {
                        field: tfield,
                        value: currVal
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            if(tfield == 'name'){
                                parentobj.find('.tenant-name').text(currVal);
                            }
                            if (response['complete']) {
                                parentobj.removeClass('card-warning');
                                parentobj.addClass('card-success');
                            }else{
                                parentobj.removeClass('card-success');
                                parentobj.addClass('card-warning');
                            }
                            Toast.fire({
                                icon: 'success',
                                text: 'Tenant Successfully updated!'
                            });
                            
                        }
                    }
                });
            }

            // Letting Photo, Video Dropzone

            $(document).on('click', '.addPropertyPhotoModal, .addPropertyVideoModal, .addPropertyFloorplanModal', function(e){
                document_type = $(this).attr('data-cat');
                dropzoneSettings(document_type);
            });

            // Initialize Dropzone

            var uploadedFiles = [];
            function dropzoneSettings(document_type){
                switch (document_type) {
                    case 'photo':
                        if ($('#my-dropzone-pp').length) {
                            var myDropzone = new Dropzone("#my-dropzone-pp", {
                                url: baseUrl+'/upload/property-photo/'+"{{$data['id']}}/"+document_type,
                                paramName: "file",
                                uploadMultiple: true,
                                maxFiles: 5,
                                parallelUploads: 5,
                                acceptedFiles: ".jpg,.jpeg,.png",
                                addRemoveLinks: true,
                                dictDefaultMessage: "Drag and drop files here or click to upload",
                                autoProcessQueue: false // Disable auto processing of files
                            });
                            // Upload button click event
                            $("#uploadPhototButton").on("click", function() {
                                myDropzone.processQueue(); // Manually trigger file upload
                            });
                
                            // Success event handler
                            myDropzone.on("success", function(file, response) {
                                uploadedFiles = response;
                            });
                
                            myDropzone.on("error", function (file, message) {
                                myDropzone.removeFile(file);
                                Toast.fire({
                                    icon: 'warning',
                                    title: message
                                });
                            }); 

                            myDropzone.on("queuecomplete", function() {
                                if (uploadedFiles.success) {
                                    $('#addPropertyPhotoModal').find('.close').trigger( "click" );
                                    $.each(uploadedFiles['file_names'], function (x, xVal) { 
                                        var imageUrl = baseUrl+'/'+xVal['file-path'];
                                        var imageId = xVal['id'];
                                        var routeImg = '{{ route('download.file') }}/'+imageId;
                                        var photoTmp = '<div class="img-item">'+
                                                                '<a class="lettings-gallery-img" href="'+imageUrl+'">'+
                                                                    '<img width="100" height="100" src="'+imageUrl+'" alt="Photo" style="border: 1px solid #c3c3c3;">'+
                                                                '</a>'+
                                                                '<a href="#" class="remove-file" data-id="'+imageId+'" data-cat="photo">'+
                                                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                        '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                        '<path d="M4 7l16 0"></path>'+
                                                                        '<path d="M10 11l0 6"></path>'+
                                                                        '<path d="M14 11l0 6"></path>'+
                                                                        '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>'+
                                                                        '<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>'+
                                                                    '</svg>'+
                                                                '</a>'+
                                                                '<a href="'+routeImg+'" class="download-file" data-cat="photo">'+
                                                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                        '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                        '<path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>'+
                                                                        '<path d="M7 11l5 5l5 -5"></path>'+
                                                                        '<path d="M12 4l0 12"></path>'+
                                                                    '</svg>'+
                                                                '</a>'+
                                                            '</div>';
    
                                        $(photoTmp).insertAfter(".lettings-gallery-parent .addNewToGallery");
                                    });
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Photos successfully uploaded!'
                                    });
                                    myDropzone.removeAllFiles();
                                }else{
                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Photos failed to upload!'
                                    });
                                }
                            });
                            // Removed file event handler
                            myDropzone.on("removedfile", function(file) {
                            });
                        }
                        break;
                    case 'video':
                        if ($('#my-dropzone-v').length) {                            
                            var myDropzone = new Dropzone("#my-dropzone-v", {
                                url: baseUrl+'/upload/property-video/'+"{{$data['id']}}/"+document_type,
                                paramName: "file",
                                uploadMultiple: true,
                                maxFiles: 1,
                                parallelUploads: 1,
                                acceptedFiles: ".mp4",
                                addRemoveLinks: true,
                                dictDefaultMessage: "Drag and drop files here or click to upload",
                                autoProcessQueue: false // Disable auto processing of files
                            });
                            // Upload button click event
                            $("#uploadVideoButton").on("click", function() {
                                myDropzone.processQueue(); // Manually trigger file upload
                            });
                
                            // Success event handler
                            myDropzone.on("success", function(file, response) {
                                if (response.success) {
                                    $('#addPropertyVideoModal').find('.close').trigger( "click" );
                                    var imageUrl = baseUrl+'/'+response['file_names'][0]['file-path'];
                                    var imageId = response['file_names'][0]['id'];
                                    var routeImg = '{{ route('download.file') }}/'+imageId;
                                    var videoTmp = '<div class="img-item">'+
                                                        '<a class="popup-player" href="'+imageUrl+'">'+
                                                            '<video width="100" height="100" src="'+imageUrl+'" alt="Video"><i class="fa-regular fa-circle-play"></i></video>'+
                                                        '</a>'+
                                                        '<a href="#" class="remove-file" data-id="'+imageId+'" data-cat="video">'+
                                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                '<path d="M4 7l16 0"></path>'+
                                                                '<path d="M10 11l0 6"></path>'+
                                                                '<path d="M14 11l0 6"></path>'+
                                                                '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>'+
                                                                '<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>'+
                                                            '</svg>'+
                                                        '</a>'+
                                                        '<a href="'+routeImg+'" class="download-file" data-cat="video">'+
                                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                '<path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>'+
                                                                '<path d="M7 11l5 5l5 -5"></path>'+
                                                                '<path d="M12 4l0 12"></path>'+
                                                            '</svg>'+
                                                        '</a>'+
                                                    '</div>';

                                    $(videoTmp).insertAfter(".lettings-video-parent .addNewToGallery");
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Video successfully uploaded!'
                                    });
                                }else{
                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Video failed to upload!'
                                    });
                                }
                                myDropzone.removeAllFiles();
                            });
                
                            myDropzone.on("error", function (file, message) {
                                myDropzone.removeFile(file);
                                Toast.fire({
                                    icon: 'warning',
                                    title: message
                                });
                            }); 
                            // Removed file event handler
                            myDropzone.on("removedfile", function(file) {
                            });
                        }
                        break;
                    case 'floorplan':
                        if ($('#my-dropzone-fp').length) {
                            var myDropzone = new Dropzone("#my-dropzone-fp", {
                                url: baseUrl+'/upload/property-floorplan/'+"{{$data['id']}}/"+document_type,
                                paramName: "file",
                                uploadMultiple: true,
                                maxFiles: 1,
                                parallelUploads: 1,
                                acceptedFiles: ".jpg,.jpeg,.png",
                                addRemoveLinks: true,
                                dictDefaultMessage: "Drag and drop files here or click to upload",
                                autoProcessQueue: false // Disable auto processing of files
                            });
                            // Upload button click event
                            $("#uploadFloorplanButton").on("click", function() {
                                myDropzone.processQueue(); // Manually trigger file upload
                            });
                
                            // Success event handler
                            myDropzone.on("success", function(file, response) {
                                if (response.success) {
                                    $('#addPropertyFloorplanModal').find('.close').trigger( "click" );
                                    var imageUrl = baseUrl+'/'+response['file_names'][0]['file-path'];
                                    var imageId = response['file_names'][0]['id'];
                                    var routeImg = '{{ route('download.file') }}/'+imageId;
                                    var floorplanTmp = '<div class="img-item">'+
                                                            '<a class="lettings-floorplan-img" href="'+imageUrl+'">'+
                                                                '<img width="100" height="100" src="'+imageUrl+'" alt="Floorplan" style="border: 1px solid #c3c3c3;">'+
                                                            '</a>'+
                                                            '<a href="#" class="remove-file" data-id="'+imageId+'" data-cat="floorplan">'+
                                                                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                    '<path d="M4 7l16 0"></path>'+
                                                                    '<path d="M10 11l0 6"></path>'+
                                                                    '<path d="M14 11l0 6"></path>'+
                                                                    '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>'+
                                                                    '<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>'+
                                                                '</svg>'+
                                                            '</a>'+
                                                            '<a href="'+routeImg+'" class="download-file" data-cat="floorplan">'+
                                                                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                    '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                    '<path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>'+
                                                                    '<path d="M7 11l5 5l5 -5"></path>'+
                                                                    '<path d="M12 4l0 12"></path>'+
                                                                '</svg>'+
                                                            '</a>'+
                                                        '</div>';

                                    var floorplanInfoTmp =  '<a href="'+imageUrl+'" class="popup-link">'+
                                                                '<img width="30" height="30" src="'+imageUrl+'" alt="Floorplan" style="border: 1px solid #c3c3c3;">'+
                                                            '</a>';

                                    $('.lettings-floorplan-parent').empty().append(floorplanTmp);
                                    $('span.info-floorplan').empty().append(floorplanInfoTmp);
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Floorplan successfully uploaded!'
                                    });
                                }else{
                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Floorplan failed to upload!'
                                    });
                                }
                                myDropzone.removeAllFiles();
                            });
                
                            myDropzone.on("error", function (file, message) {
                                myDropzone.removeFile(file);
                                Toast.fire({
                                    icon: 'warning',
                                    title: message
                                });
                            }); 
                            // Removed file event handler
                            myDropzone.on("removedfile", function(file) {
                            });
                        }
                        break;
                }
            }
            
            $(document).on('click', '.remove-file', function(e){
                e.preventDefault();
                var fileid = $(this).attr('data-id');
                var parentObj = $(this).closest('.img-item');
                var category = $(this).attr('data-cat');

                Swal.fire({
                    title: 'Are you sure you want to remove file?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed){
                        $.ajax({
                            url: baseUrl+'/gallery/remove/'+fileid,
                            type: 'post',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response){
                                if (response['status'] == 1) {
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'File successfully removed!'
                                    });
                                    
                                    parentObj.fadeToggle();
                                    setTimeout(function() {
                                        parentObj.remove()
                                        if (category == 'floorplan') {
                                            var addTmp = '<div class="addNewToGallery">'+
                                                            '<a type="button" href="#" class="addPropertyFloorplanModal" data-toggle="modal" data-target="#addPropertyFloorplanModal" data-cat="floorplan">'+
                                                                '<i class="fa-solid fa-plus"></i>'+
                                                            '</a>'+
                                                        '</div>';
                                            $('.lettings-floorplan-parent').append(addTmp);
                                            $('span.info-floorplan').empty().append('N/A');
                                        }
                                    }, 400);

                                }
                            }
                        });
                    }
                });
            });

            function getFormData(data, type){
                const fData = new FormData(data.target);
                let formData = {};

                const form = data.currentTarget;
                if (form.checkValidity() === false) {
                    data.stopPropagation();
                } else {
                    fData.forEach((value, key) => {
                        formData[key] = value;
                    });
                }
                formData['type'] = type;

                return formData;
            }

            // ADD LOGS POPUP
            $('#addLogs').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var logtype = button.data('logtype');
                $('#addLogs #pid').val(id);
                $('#addLogs #type').val(logtype);
                $('#addLogs #log_details').val("");
            });

            var parent_row = '';

            // SAVE LOG
            $('#form-logs').submit(function (e) {
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
                $.ajax({
                    url: "{{ route('create.logs') }}",
                    method: 'post',
                    data: {
                        formData: formData,
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            Toast.fire({
                                icon: 'success',
                                text: 'Log Successfully added!'
                            });
                            $(".close").trigger('click');
                        }
                    }
                });
            });

            // UPDATE LOG
            $('#form-update-logs').submit(function (e) {
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

                $.ajax({
                    url: baseUrl+'/logs/update/'+formData['update_pid'],
                    method: 'post',
                    data: {
                        formData: formData,
                    },
                    success: function(response){
                        if (response['status'] == 1) {
                            Toast.fire({
                                icon: 'success',
                                text: 'Log Successfully updated!'
                            });
                            var name = response['data']['first_name']+' '+(response['data']['middle_name'] ? response['data']['middle_name'] : '')+' '+response['data']['last_name'];
                            var has_update = moment(response['data']['created_at']).isSame(response['data']['updated_at']);
                            var date_time_created_format = moment(response['data']['created_at']).format('MMMM Do YYYY, h:mm a');
                            var date_time_updated_format = moment(response['data']['updated_at']).format('MMMM Do YYYY, h:mm a');
                            var date_time_diff_created_format = moment(response['data']['created_at']).startOf('hour').fromNow();
                            var date_time_diff_updated_format = moment(response['data']['updated_at']).startOf('hour').fromNow();

                            var log_date = has_update ? date_time_created_format : date_time_updated_format;
                            var log_label = has_update ? 'Created by: ' : 'Updated by: ';
                            var log_diff = has_update ? date_time_diff_created_format : date_time_diff_updated_format;
                            parent_row.find('.log_date').text(log_date);
                            parent_row.find('.log_label').text(log_label);
                            parent_row.find('.log_publisher').text(name);
                            parent_row.find('.log_description').text(response['data']['description']);
                            parent_row.find('.log_diff').text(log_diff);
                            $("#editLogs .close").trigger('click');
                        }
                    }
                });
            });

            // VIEW LOGS
            $(document).on('click', '.view-logs', function (e) {
                e.preventDefault();
                var pid = $(this).attr('data-id');
                var logtype = $(this).attr('data-logtype');
                $.ajax({
                    url: "{{ route('get.logs') }}",
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                        pid: pid,
                        type: logtype
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
                                                        '<a href="#" data-action="edit" data-id="'+xVal['id']+'" data-logtype="'+xVal['type']+'" class="edit icon edit-log">'+
                                                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">'+
                                                                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'+
                                                                '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>'+
                                                                '<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>'+
                                                                '<path d="M16 5l3 3"></path>'+
                                                            '</svg>'+
                                                        '</a>'+
                                                        '<a href="#" data-action="delete" data-id="'+xVal['id']+'" data-logtype="'+xVal['type']+'" class="delete icon delete-log">'+
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
                                                        '<div>Date: <strong class="log_date">'+(has_update ? date_time_created_format : date_time_updated_format)+'</strong></div>'+
                                                        '<div><span class="log_label">'+ (has_update ? 'Created':'Updated') +' by: </span><strong class="log_publisher">'+name+'</strong></div>'+
                                                    '</div>'+(cua === true || cua === 'true' ? accessTmp : '')+'</div>'+
                                                '<div class="mb-1 log_description">'+xVal['description']+'</div>'+
                                                '<div class="d-flex justify-content-end time-passed"><strong class="log_diff">'+date_time_diff_format+'</strong></div>'+
                                            '</li>';
                                });
                            }else{
                                noteTmp += '<li class="no-result"> <h4>No Available Logs</h4> </li>';
                            }
                            $("#notes-logs").empty().append(noteTmp);
                            $('#viewLogs').modal('show');
                        }
                    }
                });
            });

            // UPDATE LOG POPUP
            $(document).on('click', '.edit-log', function (e) {
                e.preventDefault();
                parent_row = $(this).closest('.note-item');
                var pid = $(this).attr('data-id');
                var logtype = $(this).attr('data-logtype');
                $.ajax({
                    url: baseUrl+'/logs/get-single-logs/'+pid,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: logtype
                    },
                    success: function(response){
                        if (response['data']) {
                            $('#update_pid').val(response['data']['id']);
                            $('#update_type').val(response['data']['type']);
                            $('#update_log_details').val(response['data']['description']);
                            $('#editLogs').modal('show');
                        }
                    }
                });
            });

            // DELETE LOGS
            $(document).on('click', '.delete-log', function(e){
                event.preventDefault();
                var parent_item = $(this).closest('.note-item');
                var pid = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure to remove this log?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Remove',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: baseUrl+'/logs/delete/' + pid ,
                            method: 'get',
                            success: function(response){
                                if (response.success == 1) {
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'Log successfully removed!'
                                    });
                                    parent_item.fadeOut(500, function() { 
                                        $(this).remove();
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
