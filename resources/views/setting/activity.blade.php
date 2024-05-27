<div class="card card-secondary shadow mb-0 p-0">
    <div class="card-header py-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">{{ __('Log Details') }}</h6>
            <div class="col">
                <div class="d-flex gap-2 justify-content-end align-items-center">
                    <div class="loading-container hide col p-0 text-end">
                        <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table id="activity-table" class="table activity-table table-striped m-0" style="width: 100%;">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Date and Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>