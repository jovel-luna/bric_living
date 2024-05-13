@extends('layouts.app', ['pageSlug' => 'property-create'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">New Internal Property</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Property</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form method="POST" id="propertyForm" action="{{ route('property.store') }}">
                        @csrf
                        <div class="form-head-title-actions">
                            <div></div>
                            <div class="form-actions">
                                <a href="{{ route('view.import') }}" class="import-btn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <img src="{{ url('storage/image/excel.svg') }}" alt="Excel"/>
                                    Import
                                </a>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="propertyTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="new-property-info-tab" data-toggle="tab" href="#new-property-info" role="tab" aria-controls="new-property-info" aria-selected="true">Property Info</a>
                                    </li>
                                    <li class="nav-item not-allowed">
                                        <a class="nav-link disabled" id="acquisition-tab" data-toggle="tab" href="#acquisition" role="tab" aria-controls="acquisition" aria-selected="false">Acquisition</a>
                                    </li>
                                    <!-- <li class="nav-item not-allowed">
                                        <a class="nav-link disabled" id="development-tab" data-toggle="tab" href="#development" role="tab" aria-controls="development" aria-selected="false">Development</a>
                                    </li> -->
                                    <!-- <li class="nav-item not-allowed">
                                        <a class="nav-link disabled" id="operation-tab" data-toggle="tab" href="#operation" role="tab" aria-controls="operation" aria-selected="false">Operations</a>
                                    </li> -->
                                    <!-- <li class="nav-item not-allowed">
                                        <a class="nav-link disabled" id="lettings-tab" data-toggle="tab" href="#lettings" role="tab" aria-controls="lettings" aria-selected="false">Lettings</a>
                                    </li>
                                    <li class="nav-item not-allowed">
                                        <a class="nav-link disabled" id="finance-tab" data-toggle="tab" href="#finance" role="tab" aria-controls="finance" aria-selected="false">Finance</a>
                                    </li>
                                    <li class="nav-item not-allowed">
                                        <a class="nav-link disabled" id="document-checklist-tab" data-toggle="tab" href="#document-checklist" role="tab" aria-controls="document-checklist" aria-selected="false">Documents</a>
                                    </li> -->
                                </ul>
            
                                <!-- Tab panes -->
                                <div class="tab-content mt-4">
                                    <!-- New Property -->
                                    <div class="tab-pane active" id="new-property-info" role="tabpanel" aria-labelledby="new-property-info-tab">
                                        @include('layouts.form.newproperty')
                                    </div>
                                    <!-- Acquisition -->
                                    <div class="tab-pane" id="acquisition" role="tabpanel" aria-labelledby="acquisition-tab">
                                        @include('layouts.form.acquisition')
                                    </div>             
                                    <!-- Operations -->
                                    <!-- <div class="tab-pane" id="operation" role="tabpanel" aria-labelledby="operation-tab">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="lettingStatusModal" tabindex="-1" role="dialog" aria-labelledby="lettingStatusModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="lettingStatusModalTitle">Add New Letting Status</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" id="lettingStatusForm" action="{{ route('letting-status.store') }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <div class="row">
                                <!-- Letting Status -->
                                <div class="mb-3">
                                    <label for="letting_status_name" class="col-form-label">{{ __('Letting Status Name') }}<span class="isRequired"> * </span></label>
                                    <input id="letting_status_name" type="text" class="form-control @error('letting_status_name') is-invalid @enderror" name="letting_status_name" value="{{ old('letting_status_name') }}" autocomplete="letting_status_name" required>

                                    @error('letting_status_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
            $( ".has-datepicker" ).datepicker({
                dateFormat: "dd-mm-yy",
                onSelect: function(date) {
                    switch ($(this).attr('name')) {
                        case 'completion_date':
                            $('#completion_date').removeClass("is-invalid")
                            checkASCompleted();
                            break;
                        case 'insurance_renewal_date':
                            $('#insurance_renewal_date').removeClass("is-invalid")
                            break;
                        default:
                            break;
                    }
                }
            });

            $('#propertyTab a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            const land_registration_docs = [];
            const completion_statement_docs = [];
            const mortgage_docs = [];
            const col_planning_docs = [];
            const floor_plans_docs = [];
            const property_accreditation_docs = [];
            const loan_offers_docs = [];
            const mom_docs = [];
            var land_registration_docs_counter = 0;
            var completion_statement_docs_counter = 0;
            var mortgage_docs_counter = 0;
            var col_planning_docs_counter = 0;
            var floor_plans_docs_counter = 0;
            var property_accreditation_docs_counter = 0;
            var loan_offers_docs_counter = 0;
            var mom_docs_counter = 0;
            $(document).on('change','.add-file-btn', function(evt){
                var childObj = $(this);
                var fileIdCounter = 0;
                var sectionIdentifier = $(this).attr('id');
                var documentArray = getDocumentArray(sectionIdentifier);
                if (evt.target.files.length != 0) {
                    for (var i = 0; i < evt.target.files.length; i++) {
                        var output = '';
                        fileIdCounter++;
                        var file = evt.target.files[i];
                        var filetypeArray = file.type;
                        var filetype = filetypeArray.split("/");
                        var fileId = sectionIdentifier + fileIdCounter;
                        var isImage = false;
                        var imgSrc = '';
                        if (filetype[0] === 'image') {
                            isImage = true;
                        }
                        if (documentArray.length != 0) {
                            var hasExisting = false;
                            $.each(documentArray, function (lrd, lrdVal) { 
                                 if (lrdVal['file']['name'] === file.name ) {
                                    hasExisting = true;
                                     return false;
                                 }
                            });
                            if (hasExisting === false) {
                                addDocsToArray(sectionIdentifier, fileId, file);
                                var getCounter = getCounterNum(sectionIdentifier);
                                output +=   '<li id="'+sectionIdentifier+'_'+getCounter+'" class="document-item">'+
                                                '<span class="document-title">'+escape(file.name)+'</span>'+
                                                '<img id="image-preview">'+
                                                '<span class="actions"><i id="trash-btn" class="fa-solid fa-trash-can removeFile" data-fileid="'+ fileId +'"></i>'+
                                                '</span>'+
                                            '</li>';
                                childObj.parent().parent().parent().find(".document-list").append(output);
                                if (isImage) {
                                    childObj.parent().parent().parent().find(".document-list").find('#'+sectionIdentifier+'_'+getCounter).find('.document-title').remove();
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        childObj.parent().parent().parent().find(".document-list").find('#'+sectionIdentifier+'_'+getCounter).find('#image-preview').attr('src', e.target.result);
                                        imgSrc = e.target.result;
                                    }
                                    reader.readAsDataURL(file)
                                }else{
                                    childObj.parent().parent().parent().find(".document-list").find('#'+sectionIdentifier+'_'+getCounter).find('#image-preview').remove();
                                }
                            }
                        }else{
                            addDocsToArray(sectionIdentifier, fileId, file);
                            var getCounter = getCounterNum(sectionIdentifier);
                            output +=   '<li id="'+sectionIdentifier+'_'+getCounter+'" class="document-item">'+
                                        '<span class="document-title">'+escape(file.name)+'</span>'+
                                        '<img id="image-preview">'+
                                        '<span class="actions"><i id="trash-btn" class="fa-solid fa-trash-can removeFile" data-fileid="'+ fileId +'"></i>'+
                                        '</span>'+
                                    '</li>';
                            childObj.parent().parent().parent().find(".document-list").html(output);
                            if (isImage) {
                                childObj.parent().parent().parent().find(".document-list").find('#'+sectionIdentifier+'_'+getCounter).find('.document-title').remove();
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    childObj.parent().parent().parent().find(".document-list").find('#'+sectionIdentifier+'_'+getCounter).find('#image-preview').attr('src', e.target.result);
                                    imgSrc = e.target.result;
                                }
                                reader.readAsDataURL(file)
                            }else{
                                childObj.parent().parent().parent().find(".document-list").find('#'+sectionIdentifier+'_'+getCounter).find('#image-preview').remove();
                            }
                        }
                    };
                    childObj.parent().parent().parent().parent().find('label.document-status-icon i').remove();
                    childObj.parent().parent().parent().parent().find('label.document-status-icon').append('<i class="fa-solid fa-circle-check has-file-checked">');
                }
                function getCounterNum(sectionIdentifier){
                    switch (sectionIdentifier) {
                        case 'land_registration':
                            return land_registration_docs_counter;
                            break;
                        case 'completion_statement':
                            return completion_statement_docs_counter;
                            break;
                        case 'mortgage_phase':
                            return mortgage_docs_counter;
                            break;
                        case 'col_planning':
                            return col_planning_docs_counter;
                            break;
                        case 'floor_plans':
                            break;
                            return floor_plans_docs_counter;
                        case 'property_accreditation':
                            return property_accreditation_docs_counter;
                            break;
                        case 'loan_offers':
                            return loan_offers_docs_counter;
                            break;
                        case 'mom':
                            return mom_docs_counter;
                            break;
                        default:
                            break;
                    }
                }
                function addDocsToArray(sectionIdentifier, fileId, file){
                    switch (sectionIdentifier) {
                        case 'land_registration':
                            land_registration_docs.push({
                                id: fileId,
                                file: file
                            });
                            land_registration_docs_counter++;
                            break;
                        case 'completion_statement':
                            completion_statement_docs.push({
                                id: fileId,
                                file: file
                            });
                            completion_statement_docs_counter++;
                            break;
                        case 'mortgage_phase':
                            mortgage_docs.push({
                                id: fileId,
                                file: file
                            });
                            mortgage_docs_counter++;
                            break;
                        case 'col_planning':
                            col_planning_docs.push({
                                id: fileId,
                                file: file
                            });
                            col_planning_docs_counter++;
                            break;
                        case 'floor_plans':
                            floor_plans_docs.push({
                                id: fileId,
                                file: file
                            });
                            break;
                            floor_plans_docs_counter++;
                        case 'property_accreditation':
                            property_accreditation_docs.push({
                                id: fileId,
                                file: file
                            });
                            property_accreditation_docs_counter++;
                            break;
                        case 'loan_offers':
                            loan_offers_docs.push({
                                id: fileId,
                                file: file
                            });
                            loan_offers_docs_counter++;
                            break;
                        case 'mom':
                            mom_docs.push({
                                id: fileId,
                                file: file
                            });
                            mom_docs_counter++;
                            break;
                        default:
                            break;
                    }
                }
                function getDocumentArray(sectionIdentifier){
                    switch (sectionIdentifier) {
                        case 'land_registration':
                            return land_registration_docs;
                            break;
                        case 'completion_statement':
                            return completion_statement_docs;
                            break;
                        case 'mortgage_phase':
                            return mortgage_docs;
                            break;
                        case 'col_planning':
                            return col_planning_docs;
                            break;
                        case 'floor_plans':
                            return floor_plans_docs;
                            break;
                        case 'property_accreditation':
                            return property_accreditation_docs;
                            break;
                        case 'loan_offers':
                            return loan_offers_docs;
                            break;
                        case 'mom':
                            return mom_docs;
                            break;
                        default:
                            break;
                    }
                }
            })

            var hasFolder = 0;
            $(document).on('click', '.add-new-folder', function(){
                var elementObj = $(this).parent().parent();

                Swal.fire({
                title: 'Enter Folder Name',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Add',
                showLoaderOnConfirm: true,
                icon: 'info',
                }).then((result) => {
                    if (result.isConfirmed) {
                        addFolder(result.value, elementObj);
                    }
                })
            });

            function addFolder(foldername, elementObj){
                if (hasFolder === 0) {
                    elementObj.find('.folder-document').empty();
                }
                var folderTemp  =   '<li class="folder-items">'+
                                        '<div class="f-items">'+
                                            '<span class="folder-title">'+foldername+'</span>'+
                                            '<span class="actions">'+
                                                '<i class="fa-solid fa-file-circle-plus click-icon-file">'+
                                                    '<input id="land_registration" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="land_registration" multiple />'+
                                                '</i>'+
                                                '<i id="edit-btn" class="fa-solid fa-pen-to-square"></i>'+
                                                '<i id="trash-btn" class="fa-solid fa-trash-can"></i>'+
                                            '</span>'+
                                        '</div>'+
                                        '<ul class="document-list">'+
                                        '</ul>'+
                                    '</li>';

                elementObj.find('.folder-document').append(folderTemp);
                hasFolder++;
            }
            $(document).on('click', '#edit-btn', function(){
                var titleObj = $(this).parent().parent().find('.folder-title');
                var inputValue = titleObj.text();
                Swal.fire({
                title: 'Edit Folder Name',
                input: 'text',
                inputValue: inputValue,
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                showLoaderOnConfirm: true,
                icon: 'info',
                }).then((result) => {
                    if (result.isConfirmed) {
                        titleObj.text(result.value);
                    }
                })
            });

            
            $(document).on('change', 'select', function(e){
                switch (e.target.name) {
                    case 'property_phase':
                        if (e.target.value != "") {
                            $(this).removeClass("is-invalid");
                        }
                        break;
                    case 'entity':
                        if (e.target.value === "0") {
                            $('#entityModal').modal('show');
                        }
                        break;
                    case 'city':
                        if (e.target.value != "") {
                            $(this).removeClass("is-invalid");
                            $("#area").removeClass("is-invalid");
                        }
                        var cityValue = $('select[name="city"]').val();
                        $('select[name="area"]').empty();
                        switch (cityValue) {
                            case 'Liverpool':
                                $('select[name="area"]').attr('disabled', false);
                                var areaTemp =  '<option value="Wavertree">Wavertree</option>'+
                                                '<option value="Kensington">Kensington</option>'+
                                                '<option value="Toxteth">Toxteth</option>'+
                                                '<option value="City Centre">City Centre</option>';
                                
                                break;
                            case 'Lincoln':
                                $('select[name="area"]').attr('disabled', false);
                                var areaTemp =  '<option value="West End">West End</option>'+
                                                '<option value="Monks Road">Monks Road</option>'+
                                                '<option value="High Street">High Street</option>';
                                break;
                            case 'Swansea':
                                $('select[name="area"]').attr('disabled', false);
                                var areaTemp =  '<option value="Brynmill">Brynmill</option>'+
                                                '<option value="Sandfields">Sandfields</option>'+
                                                '<option value="City Centre">City Centre</option>'+
                                                '<option value="Mount Pleasant">Mount Pleasant</option>'+
                                                '<option value="Uplands">Uplands</option>'+
                                                '<option value="St Thomas">St Thomas</option>'+
                                                '<option value="Port Tennant">Port Tennant</option>';
                                break;
                            default:
                                $('select[name="area"]').attr('disabled', true);
                                var areaTemp =  '<option value="">Please Select City First</option>';
                                break;
                        }
                        $('select[name="area"]').append(areaTemp);
                        break;
                    case 'acquisition_status':
                        if (e.target.value != "") {
                            $(this).removeClass("is-invalid");
                            if (e.target.value === 'Completed') {
                                $('#completion_date').removeClass('is-disabled');
                                $('#completion_date').parent().find('label').append('<span class="isRequired"> * </span>');
                            }else{
                                $('#completion_date').addClass('is-disabled');
                                $('#completion_date').removeClass('is-invalid');
                                $('#completion_date').parent().find('.isRequired').remove();
                                $('#completion_date').datepicker('setDate', null);
                                $("#completion_date" ).val('');
                                $( "#completion_date" ).datepicker({
                                    dateFormat: "dd-mm-yy",
                                });
                            }
                        }
                        break;
                    case 'single_asset_portfolio':
                        if (e.target.value != "") {
                            $(this).removeClass("is-invalid");
                        }
                        var single_asset_portfolio = $('select[name="single_asset_portfolio"]').val();
                        if (single_asset_portfolio === "Single Asset") {
                            $('input[name="portfolio"]').val("N/A");
                            $('input[name="portfolio"]').removeClass("is-invalid");
                        }else{
                            $('input[name="portfolio"]').val("");
                        }
                        break;
                    case 'bric_y1':
                        if (e.target.value != "") {
                            $(this).removeClass("is-invalid");
                        }
                        break;
                    default:
                        break;
                }
            });
            $(document).on('change', '#property_phase, #entity, #house_no, #street, #postcode, #acquisition_status, #asking_price, #existing_beds, #agent, #tennure, #portfolio, #existing_bedroom_no, #estimated_period, #status, #insurance_value, #insurance_in_cost, #capex_budget', function(e){
                if (e.target.value != "") {
                    $(this).removeClass("is-invalid");
                }else{
                    $(this).addClass("is-invalid");
                }
                switch (e.target.name) {
                    case 'tennure':
                        if ($(this).val() === 'Freehold') {
                            $("#ground_rent").val('N/A').addClass('is-disabled');
                            $("#ground_rent_due" ).datepicker( "destroy" );
                            
                            $("#ground_rent_due" ).val( "N/A" ).addClass('is-disabled');
                        }else{
                            $("#ground_rent" ).val("").removeClass('is-disabled');
                            $("#ground_rent_due" ).val("").removeClass('is-disabled');
                            $( "#ground_rent_due" ).datepicker({
                                dateFormat: "dd-mm-yy",
                            });
                        }
                        break;
                    case 'property_phase':
                        if($(this).val() === 'Acquiring'){
                            $("#status" ).val('2').removeClass('is-disabled');
                        }else{
                            $("#status" ).val("").removeClass('is-disabled');
                        }
                        checkASCompleted();
                        break;
                    case 'acquisition_status':
                        checkASCompleted();
                        break;
                    case 'status':
                        if ($(this).val() == '0') {
                            $('#lettingStatusModal').modal('show');
                        }
                        break;
                    default:
                        break;
                }

            });

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
            $(document).on('blur', '#asking_price, #agreed_purchase_price, #agent_fee_percentage, #bridge_loan, #estimated_period, #loan_percentage, #bric_y1_proposed_rent_pppw, #tenancy_length_weeks, #no_of_bric_beds, #estimated_tpc, #existing_bedroom_no, #capex_budget', function(e){
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

            $(document).on('click', '.next', function(event){
                event.preventDefault();
                var nextTabID = $(this).closest('.tab-pane').next().attr('aria-labelledby');
                var validationResult = validateFields($(this).closest('.tab-pane').attr('id'), nextTabID);
                // $( "#"+nextTabID ).trigger( "click" );

            });
            $(document).on('click', '.prev', function(event){
                event.preventDefault();
                var prevTabID = $(this).closest('.tab-pane').prev().attr('aria-labelledby');
                $( "#"+prevTabID ).trigger( "click" );
            });

            function validateFields(id, proceed){
                switch (id) {
                    case 'new-property-info':
                        var property_phase = $('#property_phase').val();
                        var entity = $('#entity').val();
                        var city = $('#city').val();
                        var area = $('#area').val();
                        var house_no = $('#house_no').val();
                        var street = $('#street').val();
                        var postcode = $('#postcode').val();
                        if (property_phase != "" && entity != "" && city != "" && area != "" && house_no != "" && street != "" && postcode != "") {
                            $('#property_phase, #entity, #city, #area, #house_no, #street, #postcode').removeClass("is-invalid");
                            if ($('#no_of_bric_beds').val()) {
                                $('#dev_existing_beds').val($('#no_of_bric_beds').val());
                            }
                            // Check if postcode and house number have existing record
                            jQuery.ajax({
                                url: "{{ route('property.isExisting') }}",
                                method: 'post',
                                data: {
                                    postcode: postcode,
                                    house_no: house_no,
                                },
                                success: function(response){
                                    if (response) {
                                        if (response.recordExist) {
                                            $('#house_no').addClass("is-invalid") 
                                            $('#postcode').addClass("is-invalid")
                                            Swal.fire({
                                            title: 'Warning',
                                            text: "Property with Postcode or House No Already Exist!",
                                            icon: 'warning',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Continue'
                                            }).then((result) => {
                                            });
                                        }else{
                                            $( "#"+proceed ).removeClass( "disabled" );
                                            $( "#"+proceed ).trigger( "click" );
                                        }
                                    }
                                }
                            });
                        }else{
                            if (property_phase == "") { $('#property_phase').addClass("is-invalid") }
                            if (entity == "") { $('#entity').addClass("is-invalid") }
                            if (city == "") { $('#city').addClass("is-invalid") }
                            if (area == "") { $('#area').addClass("is-invalid") }
                            if (house_no == "") { $('#house_no').addClass("is-invalid") }
                            if (street == "") { $('#street').addClass("is-invalid") }
                            if (postcode == "") { $('#postcode').addClass("is-invalid") }
                            Swal.fire({
                            title: 'Please fill out all required fields',
                            confirmButtonText: 'Continue',
                            icon: 'warning',
                            })

                            // $( "#"+proceed ).addClass( "disabled" );
                        }
                        break;
                    case 'acquisition':
                        var acquisition_status = $('#acquisition_status').val();
                        var single_asset_portfolio = $('#single_asset_portfolio').val();
                        var existing_bedroom_no = $('#existing_bedroom_no').val();
                        var asking_price = $('#asking_price').val();
                        var agent = $('#agent').val();
                        var estimated_period = $('#estimated_period').val();
                        var tennure = $('#tennure').val();
                        var capex = $('#capex_budget').val();
                        var insurance_value = $('#insurance_value').val();
                        var insurance_in_cost = $('#insurance_in_cost').val();
                        var insurance_renewal_date = $("#insurance_renewal_date").datepicker('getDate');
                        let cdIsRequired = false;
                        if (acquisition_status != "") {
                            if (acquisition_status === "Completed") {
                                if ($("#completion_date").datepicker('getDate') == null) {
                                    cdIsRequired = true;
                                }
                            }
                        }
                        var  hasInsurance = false;
                        if (acquisition_status === "Completed" && $("#completion_date").datepicker('getDate') != null) {
                            if ($('#insurance_in_place').is(':checked') && insurance_value != "" && insurance_in_cost != "" && insurance_renewal_date != "") {
                                hasInsurance = true;
                            }else{
                                hasInsurance = false;
                            }
                        }else{
                            if (acquisition_status != "Completed") {
                                hasInsurance = true;
                            }else{
                                hasInsurance = false;
                            }
                        }
                        
                        if (acquisition_status != "" && single_asset_portfolio != "" && existing_bedroom_no != "" && asking_price != "" && agent != "" && estimated_period !="" && tennure != "" && capex!= "" && hasInsurance == true && cdIsRequired == false) {
                            if($('#capex_budget').val()){
                                $('#dev_capex_budget').val($('#capex_budget').val());
                            }
                            // $( "#"+proceed ).removeClass( "disabled" );
                            // $( "#"+proceed ).trigger( "click" );
                            // submit();
                            return true;
                        }else{
                            if (acquisition_status == "") { $('#acquisition_status').addClass("is-invalid") }
                            if (single_asset_portfolio == "") { $('#single_asset_portfolio').addClass("is-invalid") }
                            if (existing_bedroom_no == "") { $('#existing_bedroom_no').addClass("is-invalid") }
                            if (asking_price == "") { $('#asking_price').addClass("is-invalid") }
                            if (agent == "") { $('#agent').addClass("is-invalid") }
                            if (estimated_period == "") { $('#estimated_period').addClass("is-invalid") }
                            if (tennure == "") { $('#tennure').addClass("is-invalid") }
                            if (capex == "") { $('#capex_budget').addClass("is-invalid") }
                            if ($("#completion_date").datepicker('getDate') != null) {
                                if (insurance_value == "") { $('#insurance_value').addClass("is-invalid") }
                                if (insurance_in_cost == "") { $('#insurance_in_cost').addClass("is-invalid") }
                                if (insurance_renewal_date == null) { $('#insurance_renewal_date').addClass("is-invalid") }
                            }
                            if ($('#acquisition_status').val() != "") {
                                if ($('#acquisition_status').val() === "Completed") {
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
                            // $( "#"+proceed ).addClass( "disabled" );
                        }
                        break;
                    case 'development':
                        var existing_beds = $('#existing_beds').val();
                        var bric_y1 = $('#bric_y1').val();
                        if (existing_beds != "" && bric_y1 != "") {
                            $( "#"+proceed ).removeClass( "disabled" );
                            $( "#"+proceed ).trigger( "click" );
                        }else{
                            if (existing_beds == "") { $('#existing_beds').addClass("is-invalid") }
                            if (bric_y1 == "") { $('#bric_y1').addClass("is-invalid") }
                            Swal.fire({
                            title: 'Please fill out all required fields',
                            confirmButtonText: 'Continue',
                            icon: 'warning',
                            })

                            // $( "#"+proceed ).addClass( "disabled" );
                        }
                        break;
                    case 'operation':
                        return true;
                        break;
                    default:
                        $( "#"+proceed ).removeClass( "disabled" );
                        $( "#"+proceed ).trigger( "click" );
                        break;
                }
            }

            $("form#propertyForm").submit(function(e){
                e.preventDefault();
                var validateStatus = validateFields('acquisition', '');

                if(validateStatus){
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

                    formData['insurance_in_place'] = $('#insurance_in_place').is(":checked") ? 1 : 0;
                    jQuery.ajax({
                        url: "{{ route('property.store') }}",
                        method: 'post',
                        data: {
                            type: 'Internal',
                            formData: formData,
                        },
                        success: function(result){
                            if (result['data'] === 'Success') {
                                Swal.fire({
                                title: 'Success',
                                text: "Property Successfully Added!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Continue'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('home')}}";
                                    }else{
                                        window.location.href = "{{ route('home')}}";
                                    }
                                })
                            }
                        }
                    });
                }
            });
            $("form#lettingStatusForm").submit(function(e){
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
                jQuery.ajax({
                    url: "{{ route('letting-status.store') }}",
                    method: 'post',
                    data: formData,
                    success: function(response){
                        if (response['status'] == 1) {
                            Swal.fire({
                            title: 'Success',
                            text: formData['letting_status_name']+" Successfully Added!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Continue'
                            }).then((result) => {
                                var options = '<option value="">Please Select</option><option value="0">Add new letting status</option>';
                                $.each(response['data'], function (x, xVal) { 
                                    options += '<option value="'+xVal['id']+'">'+xVal['letting_status_name']+'</option>';
                                });
                                $('#status').html(options);
                                $('#lettingStatusModal').modal('hide');
                            })
                        }else{
                            Swal.fire({
                            title: 'Warning',
                            text: "Letting Status Name Already Exist!",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Continue'
                            }).then((result) => {
                                $('#letting_status_name').addClass('is-invalid');
                            }) 
                        }
                    }
                });
            });

            $("#lettingStatusModal").on('hide.bs.modal', function(){
                var formFields = $(this).find('.form-control');
                $.each(formFields, function (x) { 
                     $(this).val('');
                });
            });

            function formatAsPercentage(num, decimal) {
                return new Intl.NumberFormat('default', {
                    minimumFractionDigits: decimal,
                    maximumFractionDigits: decimal,
                }).format(num / 100);
            }

            // Price Difference
            function autoPriceDifference() {
                
                if ($("input[name='agreed_purchase_price']").val() != "" && $("input[name='asking_price']").val() != "") {
                    var askingPrice = formatWholeNumber($("input[name='asking_price']").val());
                    var agreedPurchasePrice = formatWholeNumber($("input[name='agreed_purchase_price']").val());
                    var priceDifference = askingPrice - agreedPurchasePrice;
                    $("input[name='difference']").val(parseInt(priceDifference).toLocaleString());
                }
            }
            // Agent £ Calculation
            function autoAgentFee() {
                if ($("#agreed_purchase_price").val() != "" && $("#agent_fee_percentage").val() != "") {
                    var agreedPurchasePrice = formatWholeNumber($("input[name='agreed_purchase_price']").val());
                    var agentFeePercentage = formatAsPercentage($("#agent_fee_percentage").val(), 4);
                    var auto_agent_fee =  (agreedPurchasePrice * agentFeePercentage) * 1.2;
                    $('#agent_fee').val(parseInt(auto_agent_fee).toLocaleString());
                }
            }

            // Estimated Interest £
            function autoEstimatedInterest(){
                if ($("#agreed_purchase_price").val() != "" && $("#bridge_loan").val() != "" && $("#estimated_period").val() != "" && $("#loan_percentage").val() != "") {
                    var agreedPurchasePrice = formatWholeNumber($("input[name='agreed_purchase_price']").val());
                    var bridgeLoanPercentage = formatAsPercentage($("#bridge_loan").val(), 4);
                    var loanPercentage = formatAsPercentage($("#loan_percentage").val(), 4);
                    var estimatedInterest = (agreedPurchasePrice * loanPercentage) * bridgeLoanPercentage * $("#estimated_period").val();
                    $('#estimated_interest').val(parseInt(Math.round(estimatedInterest)).toLocaleString());
                }
            }

            
            // Estimated TPC 
            function autoEstimatedTPC(){
                if ($("#agreed_purchase_price").val() != "" && $("#stamp_duty").val() != "" && $("#acquisition_cost").val() != "" && $("#agent_fee").val() != "" && $("#capex_budget").val() != "" && $("#estimated_interest").val() != "") {
                    var agreedPurchasePrice = formatWholeNumber($("input[name='agreed_purchase_price']").val());
                    var stampDuty = formatWholeNumber($("#stamp_duty").val());
                    var acquisitionCost = formatWholeNumber($("#acquisition_cost").val());
                    var agentFee = formatWholeNumber($("#agent_fee").val());
                    var estimatedInterest = formatWholeNumber($("#estimated_interest").val());
                    var capexBudget = formatWholeNumber($("#capex_budget").val());
                    var estimatedTPC = parseInt(agreedPurchasePrice) + parseInt(stampDuty) + parseInt(acquisitionCost) + parseInt(agentFee) + parseInt(capexBudget) + parseInt(estimatedInterest);
                    $('#estimated_tpc').val(parseInt(Math.round(estimatedTPC)).toLocaleString());
                }
            }


            // Bric Purchase Yield
            function autoBricPurchaseYield(){
                if ($("#bric_y1_proposed_rent_pppw").val() != "" && $("#tenancy_length_weeks").val() != "" && $("#no_of_bric_beds").val() != "" && $("#estimated_tpc").val() != "") {
                    var bricY1 = formatWholeNumber($("#bric_y1_proposed_rent_pppw").val());
                    var estimatedTpc = formatWholeNumber($("#estimated_tpc").val());
                    var bricPurchaseYield = (bricY1 * $("#tenancy_length_weeks").val() * $("#no_of_bric_beds").val()) / estimatedTpc;
                    var formatedBPY = bricPurchaseYield * 100;
                    $('#bric_purchase_yield_percentage').val(formatedBPY.toFixed(3));
                }
            }

            // TPC / Bed Space
            function autoTPCBedSpace(){
                if ($("#no_of_bric_beds").val() != "" && $("#estimated_tpc").val() != "") {
                    var estimatedTpc = formatWholeNumber($("#estimated_tpc").val());
                    var tpcBedspace = (estimatedTpc / $("#no_of_bric_beds").val());
                    $('#tpc_bedspace').val(parseInt(Math.round(tpcBedspace)).toLocaleString());
                }
            }
            // Existing Bedrom No
            function autoEBN(){
                if ($("#existing_bedroom_no").val() != "" && $("#agreed_purchase_price").val() != "") {
                    var agreedPurchasePrice = formatWholeNumber($("input[name='agreed_purchase_price']").val());
                    var existingBedroomNo = (agreedPurchasePrice / $("#existing_bedroom_no").val());
                    $('#purchase_price_bedspace').val(parseInt(Math.round(existingBedroomNo)).toLocaleString());
                }
            }

            // Show Insurance if Acquisition Status is Completed
            function checkASCompleted(){
                if ($("#acquisition_status").val() === "Completed" && $("#completion_date").datepicker('getDate') != null) {
                    $(".insurance-card").removeClass('d-none');
                }else{
                    $(".insurance-card").addClass('d-none');
                }
            }

            $("#postcode").on('keyup', function(e){
                var postcode = $(this).val();
                if (postcode) {
                    $.each(locationData, function (l, lVal) { 
                        if(lVal['postcode'] === postcode){
                            $('#city').val(lVal['region']);
                            $('#area').val(lVal['town']);
                            return false;
                        }else{
                            $('#city').val('');
                            $('#area').val('');
                        }
                    });
                }
            });

            // add date to textarea by default
            // var now = new Date();
            // var date = moment(now).format('DD/MM/YYYY');
            // $('#col_status_log').val(date + ' - ');

            // $('#col_status_log').on('keypress', function(e) {
            //     // Check if the pressed key is Enter (key code 13) and if there is no shift key pressed
            //     if (e.which == 13 && !e.shiftKey) {
            //         // Do something when a new line is entered
            //         // Get the current date and time
            //         var now = new Date();
            //         var date = moment(now).format('DD/MM/YYYY');
            //         // var time = now.toLocaleTimeString();
            //         var dateTime = date + ' - ';
            //         // Get the textarea value and add the date and time to a new line
            //         var textarea = $(this);
            //         var value = textarea.val();
            //         textarea.val(value + '\n' + dateTime);
            //         e.preventDefault();
            //     }
            // });
        });
        function checkExisting(postcode,house_no){
            var hasExisting = false;
            jQuery.ajax({
                url: "{{ route('property.isExisting') }}",
                method: 'post',
                data: {
                    postcode: postcode,
                    house_no: house_no,
                },
                success: function(response){
                    if (response) {
                        if (response.postcodeMatch == true || response.houseNoMatch == true) {
                            hasExisting = true;
                            if (response.houseNoMatch) {
                                $('#house_no').addClass("is-invalid") 
                            }
                            if (response.postcodeMatch) {
                                $('#postcode').addClass("is-invalid")
                            }
                            Swal.fire({
                            title: 'Warning',
                            text: "Property with Postcode or House No Already Exist!",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Continue'
                            }).then((result) => {
                            });
                        }else{
                            hasExisting = false;
                        }
                    }
                }
            });

            return hasExisting;
        }
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
