<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Acquisition') }}</label>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <!-- Aquisition Status -->
                    <div class="mb-3">
                        <label for="acquisition_status" class="col-form-label">{{ __('Acquisition Status') }}<span class="isRequired"> * </span></label>
                        <select name="acquisition_status" id="acquisition_status" class="form-control form-control-alternative{{ $errors->has('acquisition_status') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="Watching">Watching</option>
                            <option value="Analysing">Analysing</option>
                            <option value="Offer Made">Offer Made</option>
                            <option value="Offer Rejected">Offer Rejected</option>
                            <option value="Offer Accepted">Offer Accepted</option>
                            <option value="Exchanged">Exchanged</option>
                            <option value="Completed">Completed</option>
                        </select>            
                        @error('acquisition_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Single Asset or Portfolio -->
                    <div class="mb-3">
                        <label for="single_asset_portfolio" class="col-form-label">{{ __('Single Asset / Portfolio') }}<span class="isRequired"> * </span></label>
                        <select name="single_asset_portfolio" id="single_asset_portfolio" class="form-control form-control-alternative{{ $errors->has('single_asset_portfolio') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="Single Asset">Single Asset</option>
                            <option value="Portfolio">Portfolio</option>
                            <option value="Block">Block</option>
                        </select>              
                        @error('single_asset_portfolio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Portfolio -->
                    <div class="mb-3">
                        <label for="portfolio" class="col-form-label">{{ __('Portfolio') }}</label>
                        <input id="portfolio" type="text" class="form-control @error('portfolio') is-invalid @enderror" name="portfolio" value="{{ old('portfolio') }}" autocomplete="portfolio">

                        @error('portfolio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                     <!-- Existing Bedroom No. -->
                    <div class="mb-3">
                        <label for="existing_bedroom_no" class="col-form-label">{{ __('Existing Bedroom No.') }}<span class="isRequired"> * </span></label>

                        <div class="">
                            <input id="existing_bedroom_no" type="number" min="1" max="99" placeholder="1-99" class="form-control @error('existing_bedroom_no') is-invalid @enderror" name="existing_bedroom_no" value="{{ old('existing_bedroom_no') }}" autocomplete="existing_bedroom_no">

                            @error('existing_bedroom_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- Stamp Duty -->
                    <div class="mb-3">
                        <label for="stamp_duty" class="col-form-label">{{ __('Stamp Duty') }}</label>
                        <input id="stamp_duty" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('stamp_duty') is-invalid @enderror" name="stamp_duty" value="{{ old('stamp_duty') }}" autocomplete="stamp_duty">

                        @error('stamp_duty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Agent -->
                    <div class="mb-3">
                        <label for="agent" class="col-form-label">{{ __('Agent') }}<span class="isRequired"> * </span></label>
                        <input id="agent" type="text" class="form-control @error('agent') is-invalid @enderror" name="agent" value="{{ old('agent') }}" autocomplete="agent">

                        @error('agent')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Agent Fee % (excl. VAT) -->
                    <div class="mb-3">
                        <label for="agent_fee_percentage" class="col-form-label">{{ __('Agent Fee % (excl. VAT)') }}</label>
                        <input id="agent_fee_percentage" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('agent_fee_percentage') is-invalid @enderror" name="agent_fee_percentage" value="{{ old('agent_fee_percentage') }}" autocomplete="agent_fee_percentage">
                        @error('agent_fee_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Agent Fee £ -->
                    <div class="mb-3">
                        <label for="agent_fee" class="col-form-label">{{ __('Agent £') }}</label>
                        <input id="agent_fee" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('agent_fee') is-invalid @enderror is-disabled" name="agent_fee" value="{{ old('agent_fee') }}" autocomplete="agent_fee">

                        @error('agent_fee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Estimated TPC -->
                    <div class="mb-3">
                        <label for="estimated_tpc" class="col-form-label">{{ __('Estimated TPC') }}</label>
                        <input id="estimated_tpc" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('estimated_tpc') is-invalid @enderror is-disabled" name="estimated_tpc" value="{{ old('estimated_tpc') }}" autocomplete="estimated_tpc">

                        @error('estimated_tpc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Offer Date -->
                    <div class="mb-3">
                        <label for="offer_date" class="col-form-label">{{ __('Offer Date') }}</label>
                        <input id="offer_date" type="text" class="form-control @error('offer_date') is-invalid @enderror has-datepicker" name="offer_date" value="{{ old('offer_date') }}" placeholder="dd-mm-yyyy" autocomplete="offer_date">

                        @error('offer_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Target Completion Date -->
                    <div class="mb-3">
                        <label for="target_completion_date" class="col-form-label">{{ __('Target Completion Date') }}</label>
                        <input id="target_completion_date" type="text" class="form-control @error('target_completion_date') is-invalid @enderror has-datepicker" name="target_completion_date" value="{{ old('target_completion_date') }}" placeholder="dd-mm-yyyy" autocomplete="target_completion_date">

                        @error('completion_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Completion Date -->
                    <div class="mb-3">
                        <label for="completion_date" class="col-form-label">{{ __('Completion Date') }}</label>
                        <input id="completion_date" type="text" class="form-control @error('completion_date') is-invalid @enderror is-disabled has-datepicker" name="completion_date" value="{{ old('completion_date') }}" placeholder="dd-mm-yyyy" autocomplete="completion_date">

                        @error('completion_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- COL Status -->
                    <div class="mb-3">
                        <label for="col_status" class="col-form-label">{{ __('COL Status') }}</label>
                        <select name="col_status" id="col_status" class="form-control form-control-alternative{{ $errors->has('col_status') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="No evidence received">No evidence received</option>
                            <option value="Evidence requested">Evidence requested</option>
                            <option value="Partial evidence received">Partial evidence received</option>
                            <option value="All evidence received">All evidence received</option>
                            <option value="COL submitted">COL submitted</option>
                            <option value="COL granted">COL granted</option>
                        </select>            
                        @error('col_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- COL Status Log -->
                    {{-- <div class="mb-3">
                        <label for="col_status_log" class="col-form-label">{{ __('COL Log') }}</label>
                        <textarea id="col_status_log" rows="5" type="text" class="form-control @error('col_status_log') is-invalid @enderror" name="col_status_log" value="{{ old('col_status_log') }}" autocomplete="col_status_log"></textarea>
                        @error('col_status_log')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <!-- Financing Status -->
                    <div class="mb-3">
                        <label for="financing_status" class="col-form-label">{{ __('Purchase Financing Status') }}</label>
                        <select name="financing_status" id="financing_status" class="form-control form-control-alternative{{ $errors->has('financing_status') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="Cash">Cash</option>
                            <option value="Bridge Loan">Bridge Loan</option>
                        </select> 
                        @error('financing_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Acquisition Finance') }}</label>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <!-- Asking Price -->
                    <div class="mb-3">
                        <label for="asking_price" class="col-form-label">{{ __('Asking £') }}<span class="isRequired"> * </span></label>
                        <input id="asking_price" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('asking_price') is-invalid @enderror" name="asking_price" value="{{ old('asking_price') }}" autocomplete="asking_price">

                        @error('asking_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Offer Price -->
                    <div class="mb-3">
                        <label for="offer_price" class="col-form-label">{{ __('Offer £') }}</label>
                        <input id="offer_price" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('offer_price') is-invalid @enderror" name="offer_price" value="{{ old('offer_price') }}" autocomplete="offer_price">

                        @error('offer_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Agreed Purchase -->
                    <div class="mb-3">
                        <label for="agreed_purchase_price" class="col-form-label">{{ __('Agreed £') }}</label>
                        <input id="agreed_purchase_price" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('agreed_purchase_price') is-invalid @enderror" name="agreed_purchase_price" value="{{ old('agreed_purchase_price') }}" autocomplete="agreed_purchase_price">

                        @error('agreed_purchase_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Price Difference +/- -->
                    <div class="mb-3">
                        <label for="difference" class="col-form-label">{{ __('Price Difference +/-') }}</label>
                        <input id="difference" type="text" class="form-control is-disabled @error('difference') is-invalid @enderror" name="difference" value="{{ old('difference') }}" autocomplete="difference">
    
                        @error('difference')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Acquisition Cost -->
                    <div class="mb-3">
                        <label for="acquisition_cost" class="col-form-label">{{ __('Acquisition Cost £') }}</label>
                        <input id="acquisition_cost" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('acquisition_cost') is-invalid @enderror" name="acquisition_cost" value="{{ old('acquisition_cost') }}" autocomplete="acquisition_cost">

                        @error('acquisition_cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Bridge Loan % -->
                    <div class="mb-3">
                        <label for="bridge_loan" class="col-form-label">{{ __('Bridge Loan %') }}</label>
                        <input id="bridge_loan" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('bridge_loan') is-invalid @enderror" name="bridge_loan" value="{{ old('bridge_loan') }}" autocomplete="bridge_loan">

                        @error('bridge_loan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Estimated Period (months) -->
                    <div class="mb-3">
                        <label for="estimated_period" class="col-form-label">{{ __('Estimated bridge loan period (months)') }}<span class="isRequired"> * </span></label>
                        <input id="estimated_period" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('estimated_period') is-invalid @enderror" name="estimated_period" value="{{ old('estimated_period') }}" autocomplete="estimated_period">
    
                        @error('estimated_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Loan % -->
                    <div class="mb-3">
                        <label for="loan_percentage" class="col-form-label">{{ __('Loan %') }}</label>
                        <input id="loan_percentage" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('loan_percentage') is-invalid @enderror" name="loan_percentage" value="{{ old('loan_percentage') }}" autocomplete="loan_percentage">
    
                        @error('loan_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Estimated Interest £ -->
                    <div class="mb-3">
                        <label for="estimated_interest" class="col-form-label">{{ __('Estimated Interest £') }}</label>
                        <input id="estimated_interest" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('estimated_interest') is-invalid @enderror is-disabled" name="estimated_interest" value="{{ old('estimated_interest') }}" autocomplete="estimated_interest">
    
                        @error('estimated_interest')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('CAPEX') }}</label>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <!-- CAPEX Budget -->
                    <div class="mb-3">
                        <label for="capex_budget" class="col-form-label">{{ __('CAPEX Budget') }}<span class="isRequired"> * </span></label>
                        <input id="capex_budget" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('capex_budget') is-invalid @enderror" name="capex_budget" value="{{ old('capex_budget') }}" autocomplete="capex_budget">

                        @error('capex_budget')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Investment') }}</label>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <!-- Valuation Yield % -->
                    <div class="mb-3">
                        <label for="bric_purchase_yield_percentage" class="col-form-label">{{ __('Valuation Yield %') }}</label>
                        <input id="bric_purchase_yield_percentage" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('bric_purchase_yield_percentage') is-invalid @enderror is-disabled" name="bric_purchase_yield_percentage" value="{{ old('bric_purchase_yield_percentage') }}" autocomplete="bric_purchase_yield_percentage">

                        @error('bric_purchase_yield_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- TPC / Bed Space -->
                    <div class="mb-3">
                        <label for="tpc_bedspace" class="col-form-label">{{ __('TPC / Bed Space') }}</label>
                        <input id="tpc_bedspace" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('tpc_bedspace') is-invalid @enderror is-disabled" name="tpc_bedspace" value="{{ old('tpc_bedspace') }}" autocomplete="tpc_bedspace">

                        @error('tpc_bedspace')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Purchase Price / Bed Space -->
                    <div class="mb-3">
                        <label for="purchase_price_bedspace" class="col-form-label">{{ __('Purchase Price / Bed Space') }}</label>
                        <input id="purchase_price_bedspace" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('purchase_price_bedspace') is-invalid @enderror is-disabled" name="purchase_price_bedspace" value="{{ old('purchase_price_bedspace') }}" autocomplete="purchase_price_bedspace">

                        @error('purchase_price_bedspace')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Bric Y1 proposed rent PPPW -->
                    <div class="mb-3">
                        <label for="bric_y1_proposed_rent_pppw" class="col-form-label">{{ __('Bric Y1 proposed rent PPPW') }}</label>
                        <input id="bric_y1_proposed_rent_pppw" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('bric_y1_proposed_rent_pppw') is-invalid @enderror" name="bric_y1_proposed_rent_pppw" value="{{ old('bric_y1_proposed_rent_pppw') }}" autocomplete="bric_y1_proposed_rent_pppw">

                        @error('bric_y1_proposed_rent_pppw')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Tenancy length (weeks) -->
                    <div class="mb-3">
                        <label for="tenancy_length_weeks" class="col-form-label">{{ __('Tenancy length (weeks)') }}</label>
                        <input id="tenancy_length_weeks" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('tenancy_length_weeks') is-invalid @enderror" name="tenancy_length_weeks" value="{{ old('tenancy_length_weeks') }}" autocomplete="tenancy_length_weeks">

                        @error('tenancy_length_weeks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Land Registry') }}</label>
            <div class="row">
            <div class="col-md-3 mb-3">
                    <!-- Tennure -->
                    <div class="mb-3">
                        <label for="tennure" class="col-form-label">{{ __('Tennure') }}<span class="isRequired"> * </span></label>
                        <select name="tennure" id="tennure" class="form-control form-control-alternative{{ $errors->has('tennure') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="Freehold">Freehold</option>
                            <option value="Leasehold">Leasehold</option>
                        </select>              
                        @error('tennure')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Ground Rent -->
                    <div class="mb-3">
                        <label for="ground_rent" class="col-form-label">{{ __('Ground Rent') }}</label>
                        <input id="ground_rent" onkeyup="formatNumber(this.id)" type="text" class="form-control @error('ground_rent') is-invalid @enderror" name="ground_rent" value="{{ old('ground_rent') }}" autocomplete="ground_rent">

                        @error('ground_rent')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Grand Rent Due -->
                    <div class="mb-3">
                        <label for="ground_rent_due" class="col-form-label">{{ __('Grand Rent Due') }}</label>
                        <input id="ground_rent_due" type="text" class="form-control @error('ground_rent_due') is-invalid @enderror has-datepicker" name="ground_rent_due" value="{{ old('ground_rent_due') }}" placeholder="dd-mm-yyyy" autocomplete="ground_rent_due">

                        @error('ground_rent_due')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 insurance-card d-none"> <!-- insurance-card d-none -->
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Insurance') }}</label>
            <div class="row">
                <div class="col-md-3 mb-3 d-flex align-items-center justify-content-center">
                    <!-- Insurance In Place -->
                        <div class="d-flex align-items-center gap-2">
                            <input name="insurance_in_place" id="insurance_in_place" type="checkbox" style="width:25px;height:25px;"> <span style="font-size: 16px;">{{ __('Insurance in Place') }}<span class="isRequired"> * </span></span>
                        </div>

                        @error('insurance_in_place')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Insurance Value -->
                    <div class="mb-3">
                        <label for="insurance_value" class="col-form-label">{{ __('Insurance Value') }}<span class="isRequired"> * </span></label>
                        <input id="insurance_value" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('insurance_value') is-invalid @enderror" name="insurance_value" value="{{ old('insurance_value') }}" autocomplete="insurance_value">

                        @error('insurance_value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Insurance Cost -->
                    <div class="mb-3">
                        <label for="insurance_in_cost" class="col-form-label">{{ __('Insurance Cost') }}<span class="isRequired"> * </span></label>
                        <input id="insurance_in_cost" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('insurance_in_cost') is-invalid @enderror" name="insurance_in_cost" value="{{ old('insurance_in_cost') }}" autocomplete="insurance_in_cost">

                        @error('insurance_in_cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- Insurance Renewal Date -->
                    <div class="mb-3">
                        <label for="insurance_renewal_date" class="col-form-label">{{ __('Insurance Renewal Date') }}<span class="isRequired"> * </span></label>
                        <input id="insurance_renewal_date" type="text" class="form-control @error('insurance_renewal_date') is-invalid @enderror has-datepicker" name="insurance_renewal_date" value="{{ old('insurance_renewal_date') }}" placeholder="dd-mm-yyyy" autocomplete="insurance_renewal_date">

                        @error('insurance_renewal_date')
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
<div class="d-flex justify-content-between mt-3">
    <button class="prev d-none d-sm-inline-block btn btn-primary shadow-sm">Previous</button>
    <button type="submit" class="d-none d-sm-inline-block btn btn-success shadow-sm">Save</button>
    <!-- <button class="next d-none d-sm-inline-block btn btn-primary shadow-sm">Next</button> -->
</div>