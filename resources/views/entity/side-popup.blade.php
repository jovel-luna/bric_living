<div class="sidebar-popup">
    <form action="#" id="side-popup-form">
        <span id="close-sidebar-btn" aria-hidden="true" class="fa-regular fa-circle-xmark"></span>
        <div class="action-btns mb-4 d-flex gap-1">
            <span class="action-option d-inline-flex gap-1">
                <a href="#" class="btn btn-warning shadow-sm side-btn-edit">
                    Edit
                </a>
            </span>
        </div>
        <div class="d-flex flex-column side-content">
            <div class="row">
                <div class="mb-3">
                    <label for="company_registration_number" class="col-form-label">{{ __('Company Registered Number:') }}<span class="isRequired"> * </span></label>
                    <input id="side-company_registration_number" type="text" class="form-control @error('company_registration_number') is-invalid @enderror is-disabled" name="company_registration_number" value="{{ old('company_registration_number') }}" autocomplete="company_registration_number" required>
                    @error('company_registration_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="entity" class="col-form-label">{{ __('Entity Name:') }}<span class="isRequired"> * </span></label>
                    <input id="side-entity" type="text" class="form-control @error('entity') is-invalid @enderror is-disabled" name="entity" value="{{ old('entity') }}" autocomplete="entity" required>
                    @error('entity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="registered_address" class="col-form-label">{{ __('Registered Address:') }}<span class="isRequired"> * </span></label>
                    <input id="side-registered_address" type="text" class="form-control @error('registered_address') is-invalid @enderror is-disabled" name="registered_address" value="{{ old('registered_address') }}" autocomplete="registered_address" required>
                </div>
                <div class="mb-3">
                    <label for="statement_due_date" class="col-form-label">{{ __('Statement Due Date:') }}</label>
                    <input id="side-statement_due_date" type="text" class="form-control @error('statement_due_date') is-invalid @enderror is-disabled has-datepicker" name="statement_due_date" value="{{ old('statement_due_date') }}" autocomplete="statement_due_date">
                </div>
                <div class="mb-3">
                    <label for="financial_year_start_date" class="col-form-label">{{ __('Financial Year Start Date:') }}<span class="isRequired"> * </span></label>
                    <input id="side-financial_year_start_date" type="text" class="form-control @error('financial_year_start_date') is-invalid @enderror is-disabled has-datepicker" name="financial_year_start_date" value="{{ old('financial_year_start_date') }}" autocomplete="financial_year_start_date" required>
                </div>
                <div class="mb-3">
                    <label for="financial_year_end_date" class="col-form-label">{{ __('Financial Year End Date:') }}<span class="isRequired"> * </span></label>
                    <input id="side-financial_year_end_date" type="text" class="form-control @error('financial_year_end_date') is-invalid @enderror is-disabled has-datepicker" name="financial_year_end_date" value="{{ old('financial_year_end_date') }}" autocomplete="financial_year_end_date" required>
                </div>
            </div>
        </div>
    </form>
</div>