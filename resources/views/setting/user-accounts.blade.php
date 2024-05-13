<div class="card card-secondary shadow mb-0 p-0">
    <div class="card-header py-1">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">{{ __('Users List') }}</h6>
            <div class="col">
                <div class="d-flex gap-2 justify-content-end align-items-center">
                    <div class="loading-container hide col p-0 text-end">
                        <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                    </div>
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addFileModal">
                        <i class="fas fa-plus"></i>
                        Add User
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <table id="user-account-table" class="table user-account-table table-striped m-0" style="width: 100%;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>