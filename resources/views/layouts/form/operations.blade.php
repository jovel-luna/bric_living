<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="col-form-label document-label">{{ __('Utilities') }}</label>
                    <!-- Gas Provider -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Gas Provider -->
                            <div class="mb-3">
                                <label for="gas_provider" class="col-form-label">{{ __('Gas Provider') }}</label>
                                <input id="gas_provider" type="text" class="form-control @error('gas_provider') is-invalid @enderror" name="gas_provider" value="{{ old('gas_provider') }}" autocomplete="gas_provider">

                                @error('gas_provider')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Gas Contact Start Date -->
                            <div class="mb-3">
                                <label for="gas_provider_contract_start" class="col-form-label">{{ __('Gas Contact Start Date') }}</label>
                                <input id="gas_provider_contract_start" type="text" class="form-control @error('gas_provider_contract_start') is-invalid @enderror has-datepicker" name="gas_provider_contract_start" value="{{ old('gas_provider_contract_start') }}" placeholder="dd-mm-yyyy" autocomplete="gas_provider_contract_start">

                                @error('gas_provider_contract_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Gas Conract End Date -->
                            <div class="mb-3">
                                <label for="gas_provider_contract_end" class="col-form-label">{{ __('Gas Conract End Date') }}</label>
                                <input id="gas_provider_contract_end" type="text" class="form-control @error('gas_provider_contract_end') is-invalid @enderror has-datepicker" name="gas_provider_contract_end" value="{{ old('gas_provider_contract_end') }}" placeholder="dd-mm-yyyy" autocomplete="gas_provider_contract_end">

                                @error('gas_provider_contract_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Gas Account number -->
                            <div class="mb-3">
                                <label for="gas" class="col-form-label">{{ __('Gas Account No.') }}</label>
                                <input id="gas" type="number" class="form-control @error('gas') is-invalid @enderror" name="gas" value="{{ old('gas') }}" autocomplete="gas">

                                @error('gas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Electricity Provider -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Electric Provider -->
                            <div class="mb-3">
                                <label for="electric_provider" class="col-form-label">{{ __('Electric Provider') }}</label>
                                <input id="electric_provider" type="text" class="form-control @error('electric_provider') is-invalid @enderror" name="electric_provider" value="{{ old('electric_provider') }}" autocomplete="electric_provider">

                                @error('electric_provider')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Electric Contract Start Date -->
                            <div class="mb-3">
                                <label for="electricity_provider_contract_start" class="col-form-label">{{ __('Electric Contract Start Date') }}</label>
                                <input id="electricity_provider_contract_start" type="text" class="form-control @error('electricity_provider_contract_start') is-invalid @enderror has-datepicker" name="electricity_provider_contract_start" value="{{ old('electricity_provider_contract_start') }}" placeholder="dd-mm-yyyy" autocomplete="electricity_provider_contract_start">

                                @error('electricity_provider_contract_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Electric Contract End Date -->
                            <div class="mb-3">
                                <label for="electricity_provider_contract_end" class="col-form-label">{{ __('Electric Contract End Date') }}</label>
                                <input id="electricity_provider_contract_end" type="text" class="form-control @error('electricity_provider_contract_end') is-invalid @enderror has-datepicker" name="electricity_provider_contract_end" value="{{ old('electricity_provider_contract_end') }}" placeholder="dd-mm-yyyy" autocomplete="electricity_provider_contract_end">

                                @error('electricity_provider_contract_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Electric Account Number -->
                            <div class="mb-3">
                                <label for="electric" class="col-form-label">{{ __('Electric Account No.') }}</label>
                                <input id="electric" type="number" class="form-control @error('electric') is-invalid @enderror" name="electric" value="{{ old('electric') }}" autocomplete="electric">

                                @error('electric')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Water Provider -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Water Provider -->
                            <div class="mb-3">
                                <label for="water_provider" class="col-form-label">{{ __('Water Provider') }}</label>
                                <input id="water_provider" type="text" class="form-control @error('water_provider') is-invalid @enderror" name="water_provider" value="{{ old('water_provider') }}" autocomplete="water_provider">

                                @error('water_provider')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            Water Date Contract Started
                            <div class="mb-3">
                                <label for="water_provider_contract_start" class="col-form-label">{{ __('Date Contract Started') }}</label>
                                <input id="water_provider_contract_start" type="text" class="form-control @error('water_provider_contract_start') is-invalid @enderror has-datepicker" name="water_provider_contract_start" value="{{ old('water_provider_contract_start') }}" placeholder="dd-mm-yyyy" autocomplete="water_provider_contract_start">

                                @error('water_provider_contract_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            Water Date Contract Ended
                            <div class="mb-3">
                                <label for="water_provider_contract_end" class="col-form-label">{{ __('Date Contract Ended') }}</label>
                                <input id="water_provider_contract_end" type="text" class="form-control @error('water_provider_contract_end') is-invalid @enderror has-datepicker" name="water_provider_contract_end" value="{{ old('water_provider_contract_end') }}" placeholder="dd-mm-yyyy" autocomplete="water_provider_contract_end">

                                @error('water_provider_contract_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <!-- Water Account No.-->
                            <div class="mb-3">
                                <label for="water" class="col-form-label">{{ __('Water Account No.') }}</label>
                                <input id="water" type="number" class="form-control @error('water') is-invalid @enderror" name="water" value="{{ old('water') }}" autocomplete="water">

                                @error('water')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- TV Licence -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- TV Licence -->
                            <div class="mb-3">
                                <label for="tv_licence" class="col-form-label">{{ __('TV Licence') }}</label>
                                <input id="tv_licence" type="text" class="form-control @error('tv_licence') is-invalid @enderror" name="tv_licence" value="{{ old('tv_licence') }}" autocomplete="tv_licence">

                                @error('tv_licence')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- TV Licence Start Date -->
                            <div class="mb-3">
                                <label for="tv_licence_contract_start" class="col-form-label">{{ __('TV Licence Start Date') }}</label>
                                <input id="tv_licence_contract_start" type="text" class="form-control @error('tv_licence_contract_start') is-invalid @enderror has-datepicker" name="tv_licence_contract_start" value="{{ old('tv_licence_contract_start') }}" placeholder="dd-mm-yyyy" autocomplete="tv_licence_contract_start">


                                @error('tv_licence_contract_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- TV Licence End Date -->
                            <div class="mb-3">
                                <label for="tv_licence_contract_end" class="col-form-label">{{ __('TV Licence End Date') }}</label>
                                <input id="tv_licence_contract_end" type="text" class="form-control @error('tv_licence_contract_end') is-invalid @enderror has-datepicker" name="tv_licence_contract_end" value="{{ old('tv_licence_contract_end') }}" placeholder="dd-mm-yyyy" autocomplete="tv_licence_contract_end">

                                @error('tv_licence_contract_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Broadband Provider -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Broadband Provider -->
                            <div class="mb-3">
                                <label for="broadband_provider" class="col-form-label">{{ __('Broadband Provider') }}</label>
                                <input id="broadband_provider" type="text" class="form-control @error('broadband_provider') is-invalid @enderror" name="broadband_provider" value="{{ old('broadband_provider') }}" autocomplete="broadband_provider">

                                @error('broadband_provider')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Broadband Account No. -->
                            <div class="mb-3">
                                <label for="broadband" class="col-form-label">{{ __('Broadband Account No.') }}</label>
                                <input id="broadband" type="number" class="form-control @error('broadband') is-invalid @enderror" name="broadband" value="{{ old('broadband') }}" autocomplete="broadband">

                                @error('broadband')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Insurance -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Property Insurance Provider -->
                            <div class="mb-3">
                                <label for="property_insurance_provider" class="col-form-label">{{ __('Property Insurance Provider') }}</label>
                                <input id="property_insurance_provider" type="text" class="form-control @error('property_insurance_provider') is-invalid @enderror" name="property_insurance_provider" value="{{ old('property_insurance_provider') }}" autocomplete="property_insurance_provider">

                                @error('property_insurance_provider')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Property Insurance Annual Cost -->
                            <div class="mb-3">
                                <label for="property_insurance_annual_cost" class="col-form-label">{{ __('Property Insurance Annual Cost') }}</label>
                                <input id="property_insurance_annual_cost" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('property_insurance_annual_cost') is-invalid @enderror" name="property_insurance_annual_cost" value="{{ old('property_insurance_annual_cost') }}" autocomplete="property_insurance_annual_cost">

                                @error('property_insurance_annual_cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Property Insurance Start Date -->
                            <div class="mb-3">
                                <label for="property_isurance_start" class="col-form-label">{{ __('Property Insurance Start Date') }}</label>
                                <input id="property_isurance_start" type="text" class="form-control @error('property_isurance_start') is-invalid @enderror has-datepicker" name="property_isurance_start" value="{{ old('property_isurance_start') }}" placeholder="dd-mm-yyyy" autocomplete="property_isurance_start">

                                @error('property_isurance_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Property Insurance End Date -->
                            <div class="mb-3">
                                <label for="property_insurance_end" class="col-form-label">{{ __('Property Insurance End Date') }}</label>
                                <input id="property_insurance_end" type="number" class="form-control @error('property_insurance_end') is-invalid @enderror has-datepicker" name="property_insurance_end" value="{{ old('property_insurance_end') }}" placeholder="dd-mm-yyyy" autocomplete="property_insurance_end">

                                @error('property_insurance_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Insurance Policy No. -->
                            <div class="mb-3">
                                <label for="insurance_policy_no" class="col-form-label">{{ __('Insurance Policy No.') }}</label>
                                <input id="insurance_policy_no" type="number" class="form-control @error('insurance_policy_no') is-invalid @enderror" name="insurance_policy_no" value="{{ old('insurance_policy_no') }}" autocomplete="insurance_policy_no">

                                @error('insurance_policy_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Council Tax -->
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Council Tax Account No. -->
                            <div class="mb-3">
                                <label for="council_tax" class="col-form-label">{{ __('Council Tax Account No.') }}</label>
                                <input id="council_tax" type="number" class="form-control @error('council_tax') is-invalid @enderror" name="council_tax" value="{{ old('council_tax') }}" autocomplete="council_tax">

                                @error('council_tax')
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
    </div>
</div>
<!-- Budget -->
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Budget') }}</label>
            <div class="row">
                <div class="col-md-3">
                    <!-- HMO Licence Fee -->
                    <div class="mb-3">
                        <label for="budget_hmo_licence_fee" class="col-form-label">{{ __('HMO Licence Fee') }}</label>
                        <input id="budget_hmo_licence_fee" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('budget_hmo_licence_fee') is-invalid @enderror" name="budget_hmo_licence_fee" value="{{ old('budget_hmo_licence_fee') }}" autocomplete="budget_hmo_licence_fee">

                        @error('budget_hmo_licence_fee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- HMO Licence Period -->
                    <div class="mb-3">
                        <label for="budget_hmo_licence_period" class="col-form-label">{{ __('HMO Licence Period') }}</label>
                        <input id="budget_hmo_licence_period" type="text" class="form-control @error('budget_hmo_licence_period') is-invalid @enderror" name="budget_hmo_licence_period" value="{{ old('budget_hmo_licence_period') }}" autocomplete="budget_hmo_licence_period">

                        @error('budget_hmo_licence_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- HMO Fee per year -->
                    <div class="mb-3">
                        <label for="budget_hmo_fee_per_year" class="col-form-label">{{ __('HMO Fee per year') }}</label>
                        <input id="budget_hmo_fee_per_year" type="text" class="form-control @error('budget_hmo_fee_per_year') is-invalid @enderror is-disabled" name="budget_hmo_fee_per_year" value="{{ old('budget_hmo_fee_per_year') }}" autocomplete="budget_hmo_fee_per_year">

                        @error('budget_hmo_fee_per_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Maintenance/property/year -->
                    <div class="mb-3">
                        <label for="budget_maintenance_property_year" class="col-form-label">{{ __('Maintenance/property/year') }}</label>
                        <input id="budget_maintenance_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('budget_maintenance_property_year') is-invalid @enderror" name="budget_maintenance_property_year" value="{{ old('budget_maintenance_property_year') }}" autocomplete="budget_maintenance_property_year">
    
                        @error('budget_maintenance_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Maintenance/bed/year -->
                    <div class="mb-3">
                        <label for="budget_maintenance_bed_year" class="col-form-label">{{ __('Maintenance/bed/year') }}</label>
                        <input id="budget_maintenance_bed_year" type="text" class="form-control @error('budget_maintenance_bed_year') is-invalid @enderror is-disabled" name="budget_maintenance_bed_year" value="{{ old('budget_maintenance_bed_year') }}" autocomplete="budget_maintenance_bed_year">
    
                        @error('budget_maintenance_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Gas/property/year -->
                    <div class="mb-3">
                        <label for="budget_gas_property_year" class="col-form-label">{{ __('Gas/property/year') }}</label>
                        <input id="budget_gas_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('budget_gas_property_year') is-invalid @enderror" name="budget_gas_property_year" value="{{ old('budget_gas_property_year') }}" autocomplete="budget_gas_property_year">
    
                        @error('budget_gas_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Gas/bed/year -->
                    <div class="mb-3">
                        <label for="budget_gas_bed_year" class="col-form-label">{{ __('Gas/bed/year') }}</label>
                        <input id="budget_gas_bed_year" type="text" class="form-control @error('budget_gas_bed_year') is-invalid @enderror is-disabled" name="budget_gas_bed_year" value="{{ old('budget_gas_bed_year') }}" autocomplete="budget_gas_bed_year">
    
                        @error('budget_gas_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Electricity/property/year -->
                    <div class="mb-3">
                        <label for="budget_electricity_property_year" class="col-form-label">{{ __('Electricity/property/year') }}</label>
                        <input id="budget_electricity_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('budget_electricity_property_year') is-invalid @enderror" name="budget_electricity_property_year" value="{{ old('budget_electricity_property_year') }}" autocomplete="budget_electricity_property_year">
    
                        @error('budget_electricity_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Electricity/bed/year -->
                    <div class="mb-3">
                        <label for="budget_electricity_bed_year" class="col-form-label">{{ __('Electricity/bed/year') }}</label>
                        <input id="budget_electricity_bed_year" type="text" class="form-control @error('budget_electricity_bed_year') is-invalid @enderror is-disabled" name="budget_electricity_bed_year" value="{{ old('budget_electricity_bed_year') }}" autocomplete="budget_electricity_bed_year">
    
                        @error('budget_electricity_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Water/proprty/year -->
                    <div class="mb-3">
                        <label for="budget_water_property_year" class="col-form-label">{{ __('Water/proprty/year') }}</label>
                        <input id="budget_water_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('budget_water_property_year') is-invalid @enderror" name="budget_water_property_year" value="{{ old('budget_water_property_year') }}" autocomplete="budget_water_property_year">
    
                        @error('budget_water_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Water/bed/year -->
                    <div class="mb-3">
                        <label for="budget_water_bed_year" class="col-form-label">{{ __('Water/bed/year') }}</label>
                        <input id="budget_water_bed_year" type="text" class="form-control @error('budget_water_bed_year') is-invalid @enderror is-disabled" name="budget_water_bed_year" value="{{ old('budget_water_bed_year') }}" autocomplete="budget_water_bed_year">
    
                        @error('budget_water_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Internet/property/year -->
                    <div class="mb-3">
                        <label for="budget_internet_property_year" class="col-form-label">{{ __('Internet/property/year') }}</label>
                        <input id="budget_internet_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('budget_internet_property_year') is-invalid @enderror" name="budget_internet_property_year" value="{{ old('budget_internet_property_year') }}" autocomplete="budget_internet_property_year">
        
                        @error('budget_internet_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Internet/bed/year -->
                    <div class="mb-3">
                        <label for="budget_internet_bed_year" class="col-form-label">{{ __('Internet/bed/year') }}</label>
                        <input id="budget_internet_bed_year" type="text" class="form-control @error('budget_internet_bed_year') is-invalid @enderror is-disabled" name="budget_internet_bed_year" value="{{ old('budget_internet_bed_year') }}" autocomplete="budget_internet_bed_year">
        
                        @error('budget_internet_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- TV Licence per house -->
                    <div class="mb-3">
                        <label for="tv_licence_per_house" class="col-form-label">{{ __('TV Licence per house') }}</label>
                        <input id="tv_licence_per_house" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('tv_licence_per_house') is-invalid @enderror" name="tv_licence_per_house" value="{{ old('tv_licence_per_house') }}" autocomplete="tv_licence_per_house">
        
                        @error('tv_licence_per_house')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Property Insurance Annual Cost -->
                    <div class="mb-3">
                        <label for="property_annual_cost" class="col-form-label">{{ __('Property Insurance Annual Cost') }}</label>
                        <input id="property_annual_cost" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('property_annual_cost') is-invalid @enderror" name="property_annual_cost" value="{{ old('property_annual_cost') }}" autocomplete="property_annual_cost">
    
                        @error('property_annual_cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Total OPEX Budget -->
                    <div class="mb-3">
                        <label for="total_opex_budget" class="col-form-label">{{ __('Total OPEX Budget') }}</label>
                        <input id="total_opex_budget" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('total_opex_budget') is-invalid @enderror" name="total_opex_budget" value="{{ old('total_opex_budget') }}" autocomplete="total_opex_budget">
    
                        @error('total_opex_budget')
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
<!-- Expenditure -->
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Expenditure') }}</label>
            <div class="row">
                <div class="col-md-3">
                    <!-- HMO Licence Fee -->
                    <div class="mb-3">
                        <label for="expenditure_hmo_licence_fee" class="col-form-label">{{ __('HMO Licence Fee') }}</label>
                        <input id="expenditure_hmo_licence_fee" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_hmo_licence_fee') is-invalid @enderror" name="expenditure_hmo_licence_fee" value="{{ old('expenditure_hmo_licence_fee') }}" autocomplete="expenditure_hmo_licence_fee">

                        @error('expenditure_hmo_licence_fee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- HMO Licence Period -->
                    <div class="mb-3">
                        <label for="expenditure_hmo_licence_period" class="col-form-label">{{ __('HMO Licence Period') }}</label>
                        <input id="expenditure_hmo_licence_period" type="text" class="form-control @error('expenditure_hmo_licence_period') is-invalid @enderror" name="expenditure_hmo_licence_period" value="{{ old('expenditure_hmo_licence_period') }}" autocomplete="expenditure_hmo_licence_period">

                        @error('expenditure_hmo_licence_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- HMO Fee per year -->
                    <div class="mb-3">
                        <label for="expenditure_hmo_fee_per_year" class="col-form-label">{{ __('HMO Fee per year') }}</label>
                        <input id="expenditure_hmo_fee_per_year" type="text" class="form-control @error('expenditure_hmo_fee_per_year') is-invalid @enderror is-disabled" name="expenditure_hmo_fee_per_year" value="{{ old('expenditure_hmo_fee_per_year') }}" autocomplete="expenditure_hmo_fee_per_year">

                        @error('expenditure_hmo_fee_per_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Maintenance/property/year -->
                    <div class="mb-3">
                        <label for="expenditure_maintenance_property_year" class="col-form-label">{{ __('Maintenance/property/year') }}</label>
                        <input id="expenditure_maintenance_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_maintenance_property_year') is-invalid @enderror" name="expenditure_maintenance_property_year" value="{{ old('expenditure_maintenance_property_year') }}" autocomplete="expenditure_maintenance_property_year">
    
                        @error('expenditure_maintenance_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Maintenance/bed/year -->
                    <div class="mb-3">
                        <label for="expenditure_maintenance_bed_year" class="col-form-label">{{ __('Maintenance/bed/year') }}</label>
                        <input id="expenditure_maintenance_bed_year" type="text" class="form-control @error('expenditure_maintenance_bed_year') is-invalid @enderror is-disabled" name="expenditure_maintenance_bed_year" value="{{ old('expenditure_maintenance_bed_year') }}" autocomplete="expenditure_maintenance_bed_year">
    
                        @error('expenditure_maintenance_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Gas/property/year -->
                    <div class="mb-3">
                        <label for="expenditure_gas_property_year" class="col-form-label">{{ __('Gas/property/year') }}</label>
                        <input id="expenditure_gas_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_gas_property_year') is-invalid @enderror" name="expenditure_gas_property_year" value="{{ old('expenditure_gas_property_year') }}" autocomplete="expenditure_gas_property_year">
    
                        @error('expenditure_gas_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Gas/bed/year -->
                    <div class="mb-3">
                        <label for="expenditure_gas_bed_year" class="col-form-label">{{ __('Gas/bed/year') }}</label>
                        <input id="expenditure_gas_bed_year" type="text" class="form-control @error('expenditure_gas_bed_year') is-invalid @enderror is-disabled" name="expenditure_gas_bed_year" value="{{ old('expenditure_gas_bed_year') }}" autocomplete="expenditure_gas_bed_year">
    
                        @error('expenditure_gas_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Electricity/property/year -->
                    <div class="mb-3">
                        <label for="expenditure_electricity_property_year" class="col-form-label">{{ __('Electricity/property/year') }}</label>
                        <input id="expenditure_electricity_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_electricity_property_year') is-invalid @enderror" name="expenditure_electricity_property_year" value="{{ old('expenditure_electricity_property_year') }}" autocomplete="expenditure_electricity_property_year">
    
                        @error('expenditure_electricity_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Electricity/bed/year -->
                    <div class="mb-3">
                        <label for="expenditure_electricity_bed_year" class="col-form-label">{{ __('Electricity/bed/year') }}</label>
                        <input id="expenditure_electricity_bed_year" type="text" class="form-control @error('expenditure_electricity_bed_year') is-invalid @enderror is-disabled" name="expenditure_electricity_bed_year" value="{{ old('expenditure_electricity_bed_year') }}" autocomplete="expenditure_electricity_bed_year">
    
                        @error('expenditure_electricity_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Water/proprty/year -->
                    <div class="mb-3">
                        <label for="expenditure_water_property_year" class="col-form-label">{{ __('Water/proprty/year') }}</label>
                        <input id="expenditure_water_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_water_property_year') is-invalid @enderror" name="expenditure_water_property_year" value="{{ old('expenditure_water_property_year') }}" autocomplete="expenditure_water_property_year">
    
                        @error('expenditure_water_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Water/bed/year -->
                    <div class="mb-3">
                        <label for="expenditure_water_bed_year" class="col-form-label">{{ __('Water/bed/year') }}</label>
                        <input id="expenditure_water_bed_year" type="text" class="form-control @error('expenditure_water_bed_year') is-invalid @enderror is-disabled" name="expenditure_water_bed_year" value="{{ old('expenditure_water_bed_year') }}" autocomplete="expenditure_water_bed_year">
    
                        @error('expenditure_water_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Internet/property/year -->
                    <div class="mb-3">
                        <label for="expenditure_internet_property_year" class="col-form-label">{{ __('Internet/property/year') }}</label>
                        <input id="expenditure_internet_property_year" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_internet_property_year') is-invalid @enderror" name="expenditure_internet_property_year" value="{{ old('expenditure_internet_property_year') }}" autocomplete="expenditure_internet_property_year">
        
                        @error('expenditure_internet_property_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Internet/bed/year -->
                    <div class="mb-3">
                        <label for="expenditure_internet_bed_year" class="col-form-label">{{ __('Internet/bed/year') }}</label>
                        <input id="expenditure_internet_bed_year" type="text" class="form-control @error('expenditure_internet_bed_year') is-invalid @enderror is-disabled" name="expenditure_internet_bed_year" value="{{ old('expenditure_internet_bed_year') }}" autocomplete="expenditure_internet_bed_year">
        
                        @error('expenditure_internet_bed_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- TV Licence per house -->
                    <div class="mb-3">
                        <label for="expenditure_tv_licence_per_house" class="col-form-label">{{ __('TV Licence per house') }}</label>
                        <input id="expenditure_tv_licence_per_house" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_tv_licence_per_house') is-invalid @enderror" name="expenditure_tv_licence_per_house" value="{{ old('expenditure_tv_licence_per_house') }}" autocomplete="expenditure_tv_licence_per_house">
        
                        @error('expenditure_tv_licence_per_house')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Property Insurance Annual Cost -->
                    <div class="mb-3">
                        <label for="expenditure_property_annual_cost" class="col-form-label">{{ __('Property Insurance Annual Cost') }}</label>
                        <input id="expenditure_property_annual_cost" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_property_annual_cost') is-invalid @enderror" name="expenditure_property_annual_cost" value="{{ old('expenditure_property_annual_cost') }}" autocomplete="expenditure_property_annual_cost">
    
                        @error('expenditure_property_annual_cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Total OPEX Budget -->
                    <div class="mb-3">
                        <label for="expenditure_total_opex_budget" class="col-form-label">{{ __('Total OPEX Budget') }}</label>
                        <input id="expenditure_total_opex_budget" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('expenditure_total_opex_budget') is-invalid @enderror" name="expenditure_total_opex_budget" value="{{ old('expenditure_total_opex_budget') }}" autocomplete="expenditure_total_opex_budget">
    
                        @error('expenditure_total_opex_budget')
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
    <!-- <button class="next d-none d-sm-inline-block btn btn-primary shadow-sm">Next</button> -->
    <button type="submit" class="d-none d-sm-inline-block btn btn-success shadow-sm">Save</button>
</div>