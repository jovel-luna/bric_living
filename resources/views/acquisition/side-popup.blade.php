<div class="sidebar-popup">
    <form action="#" id="side-popup-form-acqui">
        <span id="close-sidebar-btn" aria-hidden="true" class="fa-regular fa-circle-xmark"></span>
        <div class="action-btns mb-4 d-flex gap-1">
            <span class="action-option d-inline-flex gap-1">
                <a href="#" class="btn btn-warning shadow-sm side-btn-edit">
                    Edit
                </a>
            </span>
            <a href="#" class="btn btn-info shadow-sm side-btn-view">
                View More
            </a>
        </div>
        <div class="d-flex flex-column side-content">
            <!-- <input type="hidden" id="" name=""> -->
            <div class="row">
                <div class="mb-3">
                    <label for="col_status_log" class="col-form-label">{{ __('COL Log:') }}</label>
                    <textarea rows="4" id="side-col_status_log" type="text" class="form-control @error('col_status_log') is-invalid @enderror is-disabled" name="col_status_log" value="{{ old('col_status_log') }}" autocomplete="col_status_log" required></textarea>

                    @error('col_status_log')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="col_status" class="col-form-label">{{ __('COL Status:') }}</label>
                            <select name="col_status" id="side-col_status" class="form-control form-control-alternative{{ $errors->has('col_status') ? ' is-invalid' : '' }} is-disabled">
                                <option value="">Please Select</option>
                                @foreach($data['col_status'] as $col_status_key => $col_status_val)
                                    <option value="{{ $col_status_key }}">{{ $col_status_val }}</option>
                                @endforeach
                            </select> 
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="house_no_or_name" class="col-form-label">{{ __('House #:') }}<span class="isRequired"> * </span></label>
                                    <input id="side-house_no_or_name" type="text" class="form-control @error('house_no_or_name') is-invalid @enderror is-disabled" name="house_no_or_name" value="{{ old('house_no_or_name') }}" autocomplete="house_no_or_name" required>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label for="street" class="col-form-label">{{ __('Street:') }}<span class="isRequired"> * </span></label>
                                    <input id="side-street" type="text" class="form-control @error('street') is-invalid @enderror is-disabled" name="street" value="{{ old('street') }}" autocomplete="street" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="area" class="col-form-label">{{ __('Area:') }}<span class="isRequired"> * </span></label>
                            <input id="side-area" type="text" class="form-control @error('area') is-invalid @enderror is-disabled" name="area" value="{{ old('area') }}" required autocomplete="area" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="postcode" class="col-form-label">{{ __('Postcode:') }}<span class="isRequired"> * </span></label>
                            <input id="side-postcode" type="text" class="form-control @error('postcode') is-invalid @enderror is-disabled" name="postcode" value="{{ old('postcode') }}" autocomplete="postcode" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_of_bric_beds" class="col-form-label">{{ __('Bric Beds:') }}<span class="isRequired"> * </span></label>
                            <input id="side-no_of_bric_beds" type="text" class="form-control @error('no_of_bric_beds') is-invalid @enderror is-disabled" name="no_of_bric_beds" value="{{ old('no_of_bric_beds') }}" autocomplete="no_of_bric_beds" required>
                        </div>
                        <div class="mb-3">
                            <label for="acquisition_status" class="col-form-label">{{ __('Acquisition Status:') }}<span class="isRequired"> * </span></label>
                            <select name="acquisition_status" id="side-acquisition_status" class="form-control form-control-alternative{{ $errors->has('acquisition_status') ? ' is-invalid' : '' }} is-disabled">
                                <option value="">Please Select</option>
                                @foreach($data['acquisition_status'] as $acquisition_status_key => $acquisition_status_val)
                                    <option value="{{ $acquisition_status_key }}">{{ $acquisition_status_val }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="agreed_purchase_price" class="col-form-label">{{ __('Agreed £:') }}<span class="isRequired"> * </span></label>
                            <input id="side-agreed_purchase_price" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('agreed_purchase_price') is-invalid @enderror is-disabled" name="agreed_purchase_price" value="{{ old('agreed_purchase_price') }}" autocomplete="agreed_purchase_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="agent" class="col-form-label">{{ __('Agent:') }}<span class="isRequired"> * </span></label>
                            <input id="side-agent" type="text" class="form-control @error('agent') is-invalid @enderror is-disabled" name="agent" value="{{ old('agent') }}" autocomplete="agent" required>
                        </div>
                        <div class="mb-3">
                            <label for="single_asset_portfolio" class="col-form-label">{{ __('Single Asset / Portfolio:') }}<span class="isRequired"> * </span></label>
                            <select name="single_asset_portfolio" id="side-single_asset_portfolio" class="form-control form-control-alternative{{ $errors->has('single_asset_portfolio') ? ' is-invalid' : '' }} is-disabled">
                                @foreach($data['single_asset_portfolio'] as $single_asset_portfolio_key => $single_asset_portfolio_val)
                                    <option value="{{ $single_asset_portfolio_key }}">{{ $single_asset_portfolio_val }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="target_completion_date" class="col-form-label">{{ __('Target Completion Date:') }}</label>
                            <input id="side-target_completion_date" type="text" class="form-control @error('target_completion_date') is-invalid @enderror has-datepicker is-disabled" name="target_completion_date" value="{{ old('target_completion_date') }}" autocomplete="target_completion_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="existing_bedroom_no" class="col-form-label">{{ __('Existing Bedroom No.:') }}<span class="isRequired"> * </span></label>
                            <input id="side-existing_bedroom_no" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('existing_bedroom_no') is-invalid @enderror is-disabled" name="existing_bedroom_no" value="{{ old('existing_bedroom_no') }}" autocomplete="existing_bedroom_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="entity" class="col-form-label">{{ __('Entity:') }}<span class="isRequired"> * </span></label>
                            <select name="entity" id="side-entity" class="form-control form-control-alternative{{ $errors->has('entity') ? ' is-invalid' : '' }} is-disabled">
                                @foreach($data['entity'] as $eKey => $eVal)
                                    <option value="{{ $eVal->id }}">{{ $eVal->entity }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" class="form-control" id="side-agent_fee_percentage" name="agent_fee_percentage">
            <input type="hidden" class="form-control" id="side-agent_fee" name="agent_fee">
            <input type="hidden" class="form-control" id="side-bridge_loan" name="bridge_loan">
            <input type="hidden" class="form-control" id="side-loan_percentage" name="loan_percentage">
            <input type="hidden" class="form-control" id="side-estimated_interest" name="estimated_interest">
            <input type="hidden" class="form-control" id="side-estimated_period" name="estimated_period">
            <input type="hidden" class="form-control" id="side-asking_price" name="asking_price">
            <input type="hidden" class="form-control" id="side-stamp_duty" name="stamp_duty">
            <input type="hidden" class="form-control" id="side-estimated_tpc" name="estimated_tpc">
            <input type="hidden" class="form-control" id="side-acquisition_cost" name="acquisition_cost">
            <input type="hidden" class="form-control" id="side-capex_budget" name="capex_budget">
            <input type="hidden" class="form-control" id="side-completion_date" name="completion_date">
            <input type="hidden" class="form-control" id="side-offer_price" name="offer_price">
            <input type="hidden" class="form-control" id="side-offer_date" name="offer_date">
            <input type="hidden" class="form-control" id="side-difference" name="difference">
            <input type="hidden" class="form-control" id="side-financing_status" name="financing_status">
            <input type="hidden" class="form-control" id="side-bric_y1_proposed_rent_pppw" name="bric_y1_proposed_rent_pppw">
            <input type="hidden" class="form-control" id="side-tenancy_length_weeks" name="tenancy_length_weeks">
            <input type="hidden" class="form-control" id="side-bric_purchase_yield_percentage" name="bric_purchase_yield_percentage">
            <input type="hidden" class="form-control" id="side-tpc_bedspace" name="tpc_bedspace">
            <input type="hidden" class="form-control" id="side-purchase_price_bedspace" name="purchase_price_bedspace">
        </div>
    </form>
</div>