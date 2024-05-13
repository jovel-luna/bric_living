<ul class="nav nav-tabs" id="custom-sub-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="development-info-tab" data-toggle="pill"
            href="#development-info" role="tab" aria-controls="development-info"
            aria-selected="true"><i class="fa-solid fa-circle-info"></i> Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="development-documnet-tab" data-toggle="pill"
            href="#development-document" role="tab" aria-controls="development-document"
            aria-selected="false"><i class="fa-solid fa-file"></i> Documents</a>
    </li>
</ul>
<div class="tab-content" id="custom-tab-content">
    <div class="tab-pane fade active show" id="development-info" role="tabpanel" aria-labelledby="development-info-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('Development Overview') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Existing Beds</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['existing_beds'] ? $data['development']['existing_beds'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Exsiting stories</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['existing_stories'] ? $data['development']['existing_stories'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Bric stories</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['bric_stories'] ? $data['development']['bric_stories'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Bric Beds</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['bric_beds'] ? $data['development']['bric_beds'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Project Start Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['project_start_date'] ? $data['development']['project_start_date'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Projected Completion Date</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['projected_completion_date'] ? $data['development']['projected_completion_date'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Over running</strong></p>
                            </div>
                            <div class="col-md-7">
                                <?php
                                    if (isset($data['development']) && $data['development']['project_start_date'] != '' && $data['development']['projected_completion_date'] != '') {
                                        $now = date('d-m-Y');
                                        $projected = $data['development']['projected_completion_date'];
        
                                        $dateNow = DateTime::createFromFormat('d-m-Y', $now);
                                        $dataProjected = DateTime::createFromFormat('d-m-Y', $projected);
                                        if ($dateNow > $dataProjected) {
                                            // Calculate the difference between the dates
                                            $interval = $dateNow->diff($dataProjected);
            
                                            // Access the difference in days
                                            $diffInDays = $interval->days;
                                        }else{
                                            $diffInDays = 0;
                                        }
        
                                        echo $diffInDays;
                                    }else{
                                        echo 0;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Development Status</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['development_status'] ? $data['development']['development_status'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('Contact Details') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <label class="col-form-label document-label">Principal Contractor</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Company</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['pc_company'] ? $data['development']['pc_company'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Name</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['pc_name'] ? $data['development']['pc_name'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Mobile</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['pc_mobile'] ? $data['development']['pc_mobile'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Email</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['pc_email'] ? $data['development']['pc_email'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-form-label document-label">Building Control</label>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Company</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['bc_company'] ? $data['development']['bc_company'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Name</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['bc_name'] ? $data['development']['bc_name'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Mobile</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['bc_mobile'] ? $data['development']['bc_mobile'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Email</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['bc_email'] ? $data['development']['bc_email'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('H&S Development Compliance') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="asbestos-survery" name="hsCheckbox[]" value="Asbestos Survey" @if( isset($data["developmentHS"]) && in_array("Asbestos Survey", $data["developmentHS"])) checked @endif>
                                    
                                <label for="asbestos-survery">
                                    Asbestos Survey
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="rams" name="hsCheckbox[]" value="RAMS" @if( isset($data["developmentHS"]) && in_array("RAMS", $data["developmentHS"])) checked @endif>
                                <label for="rams">
                                    RAMS
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="coshh" name="hsCheckbox[]" value="COSHH" @if( isset($data["developmentHS"]) &&  in_array("COSHH", $data["developmentHS"])) checked @endif>
                                <label for="coshh">
                                    COSHH
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="neighbor-notified" name="hsCheckbox[]" value="Neighbours Notified" @if( isset($data["developmentHS"]) && in_array("Neighbours Notified", $data["developmentHS"])) checked @endif>
                                <label for="neighbor-notified">
                                    Neighbours Notified
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('Development Budget') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Overall Budget</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['overall_budget'] ? $data['development']['overall_budget'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Actual Spend</strong></p>
                            </div>
                            <div class="col-md-7">
                                {{ isset($data['development']) && $data['development']['actual_spend'] ? $data['development']['actual_spend'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-5">
                                <p><strong>Difference</strong></p>
                            </div>
                            <div class="col-md-7">
                                <?php
                                    if (isset($data['development']) && $data['development']['overall_budget'] != '' && $data['development']['actual_spend'] != '') {

                                        $overall_budget = intval(str_replace(',', '', $data['development']['overall_budget']));
                                        $actual_spend = intval(str_replace(',', '', $data['development']['actual_spend']));
                                        echo number_format($overall_budget - $actual_spend);
                                    }else{
                                        echo 'N/A';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="development-document" role="tabpanel" aria-labelledby="development-document-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Development Files') }}</h6>
                    <div class="col">
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <div class="loading-container hide col p-0 text-end">
                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                            </div>
                            <button type="button" class="addFileModalBtn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addFileModal" data-cat="development">
                                <i class="fas fa-plus"></i>
                                Add File
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table id="development-documents-table" class="table documents-table table-striped m-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date Added</th>
                            <th>File Name</th>
                            <th>File Type</th>
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
