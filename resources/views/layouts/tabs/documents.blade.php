<div class="card card-secondary shadow mb-4 p-0">
    <div class="card-header py-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">{{ __('Uploaded Files') }}</h6>
            <div class="col">
                <div class="d-flex gap-2 justify-content-end align-items-center">
                    <div class="loading-container hide col p-0 text-end">
                        <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                    </div>
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addFileModal">
                        <i class="fas fa-plus"></i>
                        Add File
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table id="documents-table" class="table documents-table table-striped m-0" style="width: 100%;">
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