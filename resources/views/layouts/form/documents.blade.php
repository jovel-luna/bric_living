<div class="row">
    <div class="col-md-12">
        <!-- Land Registrations Title -->
        <div class="mb-3">
            <label for="land_registration" class="col-form-label document-label"><span>{{ __('Land Registrations Title') }}</span></i></label>
            <div class="row">
                <div class="col-md-6">
                    <label for="tenure" class="col-form-label">{{ __('Tenure') }}<span class="isRequired"> * </span></label>
                    <select name="tenure" id="tenure" form="create" class="form-control form-control-alternative{{ $errors->has('tenure') ? ' is-invalid' : '' }}">
                        <option value="">Please Select</option>
                        <option value="Freehold">Freehold</option>
                        <option value="Leasehold">Leasehold</option>
                    </select>
                    @error('tenure')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="ground_rent_due" class="col-form-label">{{ __('Ground Rent Due') }}</label>
                    <input id="ground_rent_due" type="text" class="form-control @error('ground_rent_due') is-invalid @enderror" name="ground_rent_due" value="{{ old('ground_rent_due') }}" required autocomplete="ground_rent_due" autofocus>
                    @error('ground_rent_due')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="ground_rent" class="col-form-label">{{ __('Ground Rent') }}</label>
                    <input id="ground_rent" type="text" class="form-control @error('ground_rent') is-invalid @enderror" name="ground_rent" value="{{ old('ground_rent') }}" required autocomplete="ground_rent" autofocus>
                    @error('ground_rent')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Land Registrations -->
        <div class="">
            <label for="land_registration" class="col-form-label document-label document-status-icon">
                <span>{{ __('Land Registrations') }}</span>
                <i class="fa-solid fa-circle-xmark has-file-not-checked"></i>
            </label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file">
                        <input id="land_registration" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="land_registration" multiple />
                    </span>
                    <span>Add/Upload</span>
                </div>

                <label for="land_registration" class="col-form-label document-label"><span>{{ __('Document') }}</span></i></label>
                <ul class="document-list">
                    <li class="text-center">No Document.</li>
                </ul>
            </div>

        </div>
        <!-- Completion Statement -->
        <div class="">
            <label for="completion_statement" class="col-form-label document-label document-status-icon"><span>{{ __('Completion Statement') }}</span> <i class="fa-solid fa-circle-xmark has-file-not-checked"></i></label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file">
                        <input id="completion_statement" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="completion_statement" multiple />
                    </span>
                    <span>Add/Upload</span>
                </div>

                <label for="completion_statement" class="col-form-label document-label"><span>{{ __('Document') }}</span></i></label>
                <ul class="document-list">
                    <li class="text-center">No Document.</li>
                </ul>
            </div>
        </div>
        <!-- Insurance Documents -->
        <div class="">
            <label for="insurance_documents" class="col-form-label document-label"><span>{{ __('Insurance Documents') }}</span><i class="fa-solid document-status-icon fa-circle-xmark has-file-not-checked"></i></label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file add-new-folder">
                    </span>
                    <span>Add New Folder</span>
                </div>

                <label for="insurance_documents" class="col-form-label document-label"><span>{{ __('Folder/s') }}</span></i></label>
                <ul class="folder-document">
                    <li class="text-center">No Folder.</li>
                    <!-- <li class="folder-items">
                        <div class="f-items">
                            <span class="folder-title">Folder 1</span>
                            <span class="actions">
                                <i class="fa-solid fa-file-circle-plus"></i>
                                <i id="edit-btn" class="fa-solid fa-pen-to-square"></i>
                                <i id="trash-btn" class="fa-solid fa-trash-can"></i>
                            </span>
                        </div>
                        <ul class="document-list">
                            <li class="document-item">
                                <span class="document-title">Document 1</span>
                                <span class="actions">
                                    <i id="trash-btn" class="fa-solid fa-trash-can"></i>
                                </span>
                            </li>
                            <li class="document-item">
                                <span class="document-title">Document 1</span>
                                <span class="actions">
                                    <i id="trash-btn" class="fa-solid fa-trash-can"></i>
                                </span>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
        <!-- Mortgage Documents -->
        <div class="">
            <label for="mortgage_phase" class="col-form-label document-label document-status-icon"><span>{{ __('Mortgage Documents') }}</span> <i class="fa-solid fa-circle-xmark has-file-not-checked"></i></label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file">
                        <input id="mortgage_phase" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="mortgage_phase" multiple />
                    </span>
                    <span>Add/Upload</span>
                </div>

                <label for="mortgage_phase" class="col-form-label document-label"><span>{{ __('Document') }}</span></i></label>
                <ul class="document-list">
                    <li class="text-center">No Document.</li>
                </ul>
            </div>
        </div>
        <!-- COL/Planning -->
        <div class="">
            <label for="col_planning" class="col-form-label document-label document-status-icon"><span>{{ __('COL/Planning') }}</span><i class="fa-solid fa-circle-xmark has-file-not-checked"></i></label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file">
                        <input id="col_planning" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="col_planning" multiple />
                    </span>
                    <span>Add/Upload</span>
                </div>

                <label for="col_planning" class="col-form-label document-label"><span>{{ __('Document') }}</span></i></label>
                <ul class="document-list">
                    <li class="text-center">No Document.</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Floor Plans -->
        <div class="">
            <label for="floor_plans" class="col-form-label document-label document-status-icon"><span>{{ __('Floor Plans') }}</span><i class="fa-solid fa-circle-xmark has-file-not-checked"></i></i></label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file">
                        <input id="floor_plans" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="floor_plans" multiple />
                    </span>
                    <span>Add/Upload</span>
                </div>

                <label for="floor_plans" class="col-form-label document-label"><span>{{ __('Document') }}</span></i></label>
                <ul class="document-list">
                    <li class="text-center">No Document.</li>
                </ul>
            </div>
        </div>
        <!-- Property Accreditation -->
        <div class="">
            <label for="property_accreditation" class="col-form-label document-label document-status-icon"><span>{{ __('Property Accreditation') }}</span><i class="fa-solid fa-circle-xmark has-file-not-checked"></i></label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file">
                        <input id="property_accreditation" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="property_accreditation" multiple />
                    </span>
                    <span>Add/Upload</span>
                </div>

                <label for="property_accreditation" class="col-form-label document-label"><span>{{ __('Document') }}</span></i></label>
                <ul class="document-list">
                    <li class="text-center">No Document.</li>
                </ul>
            </div>
        </div>
        <!-- Loan Offers -->
        <div class="">
            <label for="loan_offers" class="col-form-label document-label document-status-icon"><span>{{ __('Loan Offers') }}</span><i class="fa-solid fa-circle-xmark has-file-not-checked"></i></i></label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file">
                        <input id="property_accreditation" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="property_accreditation" multiple />
                    </span>
                    <span>Add/Upload</span>
                </div>

                <label for="property_accreditation" class="col-form-label document-label"><span>{{ __('Document') }}</span></i></label>
                <ul class="document-list">
                    <li class="text-center">No Document.</li>
                </ul>
            </div>
        </div>
        <!-- MoM -->
        <div class="">
            <label for="mom" class="col-form-label document-label document-status-icon"><span>{{ __('MoM') }}</span><i class="fa-solid fa-circle-xmark has-file-not-checked"></i></i></label>

            <div class="add-file-cont">
                <div class="d-flex align-items-center">
                    <span class="fa-solid fa-circle-plus btn-file">
                        <input id="property_accreditation" accept="image/*, .pdf, .csv, .doc, .docx, .xslx" class="add-file-btn" type="file" name="property_accreditation" multiple />
                    </span>
                    <span>Add/Upload</span>
                </div>

                <label for="property_accreditation" class="col-form-label document-label"><span>{{ __('Document') }}</span></i></label>
                <ul class="document-list">
                    <li class="text-center">No Document.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between">
    <button class="prev">Previous</button>
    <button class="submit">Submit</button>
</div>