<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Lettings') }}</label>
            <div class="row">
                <!-- Version -->
                <div class="col-md-3 mb-3">
                    <div class="mb-3">
                        <label for="version" class="col-form-label">{{ __('Version') }}</label>
                        <select name="version" id="version" form="create" class="form-control form-control-alternative{{ $errors->has('version') ? ' is-invalid' : '' }}">
                                <option value="">Please Select</option>
                                <option value="V0">V0</option>
                                <option value="V1">V1</option>
                                <option value="v2">v2</option>
                                <option value="V2E">V2E</option>
                                <option value="External Client">External Client</option>
                            </select>          
                        @error('version')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Current Academic Year') }}</label>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <!-- Letting Status -->
                    <div class="mb-3">
                        <label for="current_letting_status" class="col-form-label">{{ __('Letting Status') }}</label>
                        <select name="current_letting_status" id="current_letting_status" form="create" class="form-control form-control-alternative{{ $errors->has('current_letting_status') ? ' is-invalid' : '' }}">
                                <option value="">Please Select</option>
                                <option value="Vacant">Vacant</option>
                                <option value="Applicationbs sent">Applicationbs sent</option>
                                <option value="Contracts sent">Contracts sent</option>
                                <option value="Let">Let</option>
                            </select>          
                        @error('current_letting_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Contract Status Log -->
                    <div class="mb-3">
                        <label for="current_contract_status_log" class="col-form-label">{{ __('Contract Status Log') }}</label>
                        <textarea id="current_contract_status_log" rows="5" type="text" cols class="form-control @error('current_contract_status_log') is-invalid @enderror" name="current_contract_status_log" value="{{ old('current_contract_status_log') }}" autocomplete="current_contract_status_log"></textarea>

                        @error('current_contract_status_log')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Beds Let -->
                    <div class="mb-3">
                        <label for="beds_let" class="col-form-label">{{ __('Beds Let') }}</label>
                        <ul class="beddings-room">
                            <li><input name="current_bedroom1" id="current_bedroom1" type="checkbox"> <span>Bedroom 1</span></li>
                            <li><input name="current_bedroom2" id="current_bedroom2" type="checkbox"> <span>Bedroom 2</span></li>
                            <li><input name="current_bedroom3" id="current_bedroom3" type="checkbox"> <span>Bedroom 3</span></li>
                            <li><input name="current_bedroom4" id="current_bedroom4" type="checkbox"> <span>Bedroom 4</span></li>
                            <li><input name="current_bedroom5" id="current_bedroom5" type="checkbox"> <span>Bedroom 5</span></li>
                            <li><input name="current_bedroom6" id="current_bedroom6" type="checkbox"> <span>Bedroom 6</span></li>
                            <li><input name="current_bedroom7" id="current_bedroom7" type="checkbox"> <span>Bedroom 7</span></li>
                            <li><input name="current_bedroom8" id="current_bedroom8" type="checkbox"> <span>Bedroom 8</span></li>
                            <li><input name="current_bedroom9" id="current_bedroom9" type="checkbox"> <span>Bedroom 9</span></li>
                            <li><input name="current_bedroom10" id="current_bedroom10" type="checkbox"> <span>Bedroom 10</span></li>
                        </ul>
                        @error('beds_let')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Total -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-start cay-total">
                            <label for="current_total" class="col-form-label">{{ __('Total') }}</label>
                            <input id="current_total" type="text" class="form-control @error('current_total') is-invalid @enderror" name="current_total" value="{{ old('current_total') }}" autocomplete="current_total">
                        </div>

                        @error('current_total')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-9 mb-3">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Target Weekly Rent PPPW -->
                            <div class="mb-3">
                                <label for="current_target_weekly_rent_pppw" class="col-form-label">{{ __('Target Weekly Rent PPPW') }}</label>
                                <input id="current_target_weekly_rent_pppw" type="text" class="form-control @error('current_target_weekly_rent_pppw') is-invalid @enderror" name="current_target_weekly_rent_pppw" value="{{ old('current_target_weekly_rent_pppw') }}" autocomplete="current_target_weekly_rent_pppw">

                                @error('current_target_weekly_rent_pppw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Target Annual Rent -->
                            <div class="mb-3">
                                <label for="current_target_annual_rent" class="col-form-label">{{ __('Target Annual Rent') }}</label>
                                <input id="current_target_annual_rent" type="text" class="form-control @error('current_target_annual_rent') is-invalid @enderror" name="current_target_annual_rent" value="{{ old('current_target_annual_rent') }}" autocomplete="current_target_annual_rent">

                                @error('current_target_annual_rent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Rent +/- -->
                            <div class="mb-3">
                                <label for="current_rent_diff" class="col-form-label">{{ __('Rent +/-') }}</label>
                                <input id="current_rent_diff" type="text" class="form-control @error('current_rent_diff') is-invalid @enderror" name="current_rent_diff" value="{{ old('current_rent_diff') }}" autocomplete="current_rent_diff">

                                @error('current_rent_diff')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Secured Weekly Rent PPPW -->
                            <div class="mb-3">
                                <label for="current_secured_weekly_rent_pppw" class="col-form-label">{{ __('Secured Weekly Rent PPPW') }}</label>
                                <input id="current_secured_weekly_rent_pppw" type="text" class="form-control @error('current_secured_weekly_rent_pppw') is-invalid @enderror" name="current_secured_weekly_rent_pppw" value="{{ old('current_secured_weekly_rent_pppw') }}" autocomplete="current_secured_weekly_rent_pppw">

                                @error('current_secured_weekly_rent_pppw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Secured Annual Rent -->
                            <div class="mb-3">
                                <label for="current_Secured_annual_rent" class="col-form-label">{{ __('Secured Annual Rent') }}</label>
                                <input id="current_Secured_annual_rent" type="text" class="form-control @error('current_Secured_annual_rent') is-invalid @enderror" name="current_Secured_annual_rent" value="{{ old('current_Secured_annual_rent') }}" autocomplete="current_Secured_annual_rent">

                                @error('current_Secured_annual_rent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Tenancy Start Date -->
                            <div class="mb-3">
                                <label for="current_tenancy_start" class="col-form-label">{{ __('Tenancy Start Date') }}</label>
                                <input id="current_tenancy_start" type="date" class="form-control @error('current_tenancy_start') is-invalid @enderror" name="current_tenancy_start" value="{{ old('current_tenancy_start') }}" autocomplete="current_tenancy_start">

                                @error('current_tenancy_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Tenancy End Date -->
                            <div class="mb-3">
                                <label for="current_tenancy_end" class="col-form-label">{{ __('Tenancy End Date') }}</label>
                                <input id="current_tenancy_end" type="date" class="form-control @error('current_tenancy_end') is-invalid @enderror" name="current_tenancy_end" value="{{ old('current_tenancy_end') }}" autocomplete="current_tenancy_end">

                                @error('current_tenancy_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Tenancy Period -->
                            <div class="mb-3">
                                <label for="current_tenancy_period" class="col-form-label">{{ __('Tenancy Period') }}</label>
                                <input id="current_tenancy_period" type="text" class="form-control @error('current_tenancy_period') is-invalid @enderror" name="current_tenancy_period" value="{{ old('current_tenancy_period') }}" autocomplete="current_tenancy_period">

                                @error('current_tenancy_period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Beds Vacant -->
                            <div class="mb-3">
                                <label for="current_beds_vacant" class="col-form-label">{{ __('Beds Vacant') }}</label>
                                <input id="current_beds_vacant" type="text" class="form-control @error('current_beds_vacant') is-invalid @enderror" name="current_beds_vacant" value="{{ old('current_beds_vacant') }}" autocomplete="current_beds_vacant">

                                @error('current_beds_vacant')
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
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('New Academic Year') }}</label>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <!-- Letting Status -->
                    <div class="mb-3">
                        <label for="new_letting_status" class="col-form-label">{{ __('Letting Status') }}</label>
                        <select name="new_letting_status" id="new_letting_status" form="create" class="form-control form-control-alternative{{ $errors->has('new_letting_status') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="Vacant">Vacant</option>
                            <option value="Applicationbs sent">Applicationbs sent</option>
                            <option value="Contracts sent">Contracts sent</option>
                            <option value="Let">Let</option>
                        </select>          
                        @error('new_letting_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Contract Status Log -->
                    <div class="mb-3">
                        <label for="new_contract_status_log" class="col-form-label">{{ __('Contract Status Log') }}</label>
                        <textarea id="new_contract_status_log" rows="5" type="text" cols class="form-control @error('new_contract_status_log') is-invalid @enderror" name="new_contract_status_log" value="{{ old('new_contract_status_log') }}" autocomplete="new_contract_status_log"></textarea>

                        @error('new_contract_status_log')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Beds Let -->
                    <div class="mb-3">
                        <label for="beds_let" class="col-form-label">{{ __('Beds Let') }}</label>
                        <ul class="beddings-room">
                            <li><input name="new_bedroom1" id="new_bedroom1" type="checkbox"> <span>Bedroom 1</span></li>
                            <li><input name="new_bedroom2" id="new_bedroom2" type="checkbox"> <span>Bedroom 2</span></li>
                            <li><input name="new_bedroom3" id="new_bedroom3" type="checkbox"> <span>Bedroom 3</span></li>
                            <li><input name="new_bedroom4" id="new_bedroom4" type="checkbox"> <span>Bedroom 4</span></li>
                            <li><input name="new_bedroom5" id="new_bedroom5" type="checkbox"> <span>Bedroom 5</span></li>
                            <li><input name="new_bedroom6" id="new_bedroom6" type="checkbox"> <span>Bedroom 6</span></li>
                            <li><input name="new_bedroom7" id="new_bedroom7" type="checkbox"> <span>Bedroom 7</span></li>
                            <li><input name="new_bedroom8" id="new_bedroom8" type="checkbox"> <span>Bedroom 8</span></li>
                            <li><input name="new_bedroom9" id="new_bedroom9" type="checkbox"> <span>Bedroom 9</span></li>
                            <li><input name="new_bedroom10" id="new_bedroom10" type="checkbox"> <span>Bedroom 10</span></li>
                        </ul>
                        @error('beds_let')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Total -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-start cay-total">
                            <label for="new_total" class="col-form-label">{{ __('Total') }}</label>
                            <input id="new_total" type="text" class="form-control @error('new_total') is-invalid @enderror" name="new_total" value="{{ old('new_total') }}" autocomplete="new_total">
                        </div>

                        @error('new_total')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-9 mb-3">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Target Weekly Rent PPPW -->
                            <div class="mb-3">
                                <label for="new_target_weekly_rent_pppw" class="col-form-label">{{ __('Target Weekly Rent PPPW') }}</label>
                                <input id="new_target_weekly_rent_pppw" type="text" class="form-control @error('new_target_weekly_rent_pppw') is-invalid @enderror" name="new_target_weekly_rent_pppw" value="{{ old('new_target_weekly_rent_pppw') }}" autocomplete="new_target_weekly_rent_pppw">

                                @error('new_target_weekly_rent_pppw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Target Annual Rent -->
                            <div class="mb-3">
                                <label for="new_target_annual_rent" class="col-form-label">{{ __('Target Annual Rent') }}</label>
                                <input id="new_target_annual_rent" type="text" class="form-control @error('new_target_annual_rent') is-invalid @enderror" name="new_target_annual_rent" value="{{ old('new_target_annual_rent') }}" autocomplete="new_target_annual_rent">

                                @error('new_target_annual_rent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Rent +/- -->
                            <div class="mb-3">
                                <label for="new_rent_diff" class="col-form-label">{{ __('Rent +/-') }}</label>
                                <input id="new_rent_diff" type="text" class="form-control @error('new_rent_diff') is-invalid @enderror" name="new_rent_diff" value="{{ old('new_rent_diff') }}" autocomplete="new_rent_diff">

                                @error('new_rent_diff')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Secured Weekly Rent PPPW -->
                            <div class="mb-3">
                                <label for="new_secured_weekly_rent_pppw" class="col-form-label">{{ __('Secured Weekly Rent PPPW') }}</label>
                                <input id="new_secured_weekly_rent_pppw" type="text" class="form-control @error('new_secured_weekly_rent_pppw') is-invalid @enderror" name="new_secured_weekly_rent_pppw" value="{{ old('new_secured_weekly_rent_pppw') }}" autocomplete="new_secured_weekly_rent_pppw">

                                @error('new_secured_weekly_rent_pppw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Secured Annual Rent -->
                            <div class="mb-3">
                                <label for="new_Secured_annual_rent" class="col-form-label">{{ __('Secured Annual Rent') }}</label>
                                <input id="new_Secured_annual_rent" type="text" class="form-control @error('new_Secured_annual_rent') is-invalid @enderror" name="new_Secured_annual_rent" value="{{ old('new_Secured_annual_rent') }}" autocomplete="new_Secured_annual_rent">

                                @error('new_Secured_annual_rent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Tenancy Start Date -->
                            <div class="mb-3">
                                <label for="new_tenancy_start" class="col-form-label">{{ __('Tenancy Start Date') }}</label>
                                <input id="new_tenancy_start" type="date" class="form-control @error('new_tenancy_start') is-invalid @enderror" name="new_tenancy_start" value="{{ old('new_tenancy_start') }}" autocomplete="new_tenancy_start">

                                @error('new_tenancy_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Tenancy End Date -->
                            <div class="mb-3">
                                <label for="new_tenancy_end" class="col-form-label">{{ __('Tenancy End Date') }}</label>
                                <input id="new_tenancy_end" type="date" class="form-control @error('new_tenancy_end') is-invalid @enderror" name="new_tenancy_end" value="{{ old('new_tenancy_end') }}" autocomplete="new_tenancy_end">

                                @error('new_tenancy_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Tenancy Period -->
                            <div class="mb-3">
                                <label for="new_tenancy_period" class="col-form-label">{{ __('Tenancy Period') }}</label>
                                <input id="new_tenancy_period" type="text" class="form-control @error('new_tenancy_period') is-invalid @enderror" name="new_tenancy_period" value="{{ old('new_tenancy_period') }}" autocomplete="new_tenancy_period">

                                @error('new_tenancy_period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <!-- Beds Vacant -->
                            <div class="mb-3">
                                <label for="new_beds_vacant" class="col-form-label">{{ __('Beds Vacant') }}</label>
                                <input id="new_beds_vacant" type="text" class="form-control @error('new_beds_vacant') is-invalid @enderror" name="new_beds_vacant" value="{{ old('new_beds_vacant') }}" autocomplete="new_beds_vacant">

                                @error('new_beds_vacant')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Date Listed on Rightmove -->
                            <div class="mb-3">
                                <label for="new_date_listed_on_rightmove" class="col-form-label">{{ __('Date Listed on Rightmove') }}</label>
                                <input id="new_date_listed_on_rightmove" type="date" class="form-control @error('new_date_listed_on_rightmove') is-invalid @enderror" name="new_date_listed_on_rightmove" value="{{ old('new_date_listed_on_rightmove') }}" autocomplete="new_date_listed_on_rightmove">

                                @error('new_date_listed_on_rightmove')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Virtual Tour -->
                            <div class="mb-3">
                                <label for="new_virtual_tour" class="col-form-label">{{ __('Virtual Tour') }}</label>
                                <input id="new_virtual_tour" type="text" class="form-control @error('new_virtual_tour') is-invalid @enderror" name="new_virtual_tour" value="{{ old('new_virtual_tour') }}" autocomplete="new_virtual_tour">

                                @error('new_virtual_tour')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <!-- Date Updated on Rightmove -->
                            <div class="mb-3">
                                <label for="new_date_updated_on_rightmove" class="col-form-label">{{ __('Date Updated on Rightmove') }}</label>
                                <input id="new_date_updated_on_rightmove" type="date" class="form-control @error('new_date_updated_on_rightmove') is-invalid @enderror" name="new_date_updated_on_rightmove" value="{{ old('new_date_updated_on_rightmove') }}" autocomplete="new_date_updated_on_rightmove">

                                @error('new_date_updated_on_rightmove')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Similar Properties -->
                            <div class="mb-3">
                                <label for="new_similar_properties" class="col-form-label">{{ __('Similar Properties') }}</label>
                                <input id="new_similar_properties" type="text" class="form-control @error('new_similar_properties') is-invalid @enderror" name="new_similar_properties" value="{{ old('new_similar_properties') }}" autocomplete="new_similar_properties">

                                @error('new_similar_properties')
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
<div class="d-flex justify-content-between">
    <button class="prev">Previous</button>
    <button class="next">Next</button>
</div>