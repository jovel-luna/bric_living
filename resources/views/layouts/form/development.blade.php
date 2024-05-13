<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Development') }}</label>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <!-- Existing Beds -->
                    <div class="mb-3">
                        <label for="dev_existing_beds" class="col-form-label">{{ __('Existing Beds') }}<span class="isRequired"> * </span></label>
                        <input id="dev_existing_beds" type="number" min="1" max="99" placeholder="1-99" class="form-control @error('dev_existing_beds') is-invalid @enderror" name="dev_existing_beds" value="{{ old('dev_existing_beds') }}" required autocomplete="dev_existing_beds" autofocus>

                        @error('dev_existing_beds')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Existing Stories -->
                    <div class="mb-3">
                        <label for="existing_stories" class="col-form-label">{{ __('Existing Stories') }}</label>
                        <input id="existing_stories" type="number" min="1" max="99" placeholder="1-99" class="form-control @error('existing_stories') is-invalid @enderror" name="existing_stories" value="{{ old('existing_stories') }}" required autocomplete="existing_stories" autofocus>

                        @error('existing_stories')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Bric Stories -->
                    <div class="mb-3">
                        <label for="bric_stories" class="col-form-label">{{ __('Bric Stories') }}</label>
                        <input id="bric_stories" type="number" min="1" max="99" placeholder="1-99" class="form-control @error('bric_stories') is-invalid @enderror" name="bric_stories" value="{{ old('bric_stories') }}" required autocomplete="bric_stories" autofocus>

                        @error('bric_stories')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Bric Y1 (date) -->
                    <div class="mb-3">
                        <label for="bric_y1" class="col-form-label">{{ __('Bric Y1 (date)') }}<span class="isRequired"> * </span></label>
                        <select name="bric_y1" id="bric_y1" form="create" class="form-control form-control-alternative{{ $errors->has('bric_y1') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="1">21/22</option>
                            <option value="2">22/23</option>
                            <option value="3">23/24</option>
                            <option value="4">24/25</option>
                            <option value="5">25/26</option>
                            <option value="6">26/27</option>
                        </select>            
                        @error('bric_y1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <!-- CAPEX Budget -->
                    <div class="mb-3">
                        <label for="dev_capex_budget" class="col-form-label">{{ __('CAPEX Budget') }}</label>
                        <input id="dev_capex_budget" type="text" class="form-control @error('dev_capex_budget') is-invalid @enderror" name="dev_capex_budget" value="{{ old('dev_capex_budget') }}" required autocomplete="dev_capex_budget" autofocus>

                        @error('dev_capex_budget')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- CAPEX per Bed -->
                    <div class="mb-3">
                        <label for="capex_per_bed" class="col-form-label">{{ __('CAPEX per Bed') }}</label>
                        <input id="capex_per_bed" type="text" class="form-control @error('capex_per_bed') is-invalid @enderror" name="capex_per_bed" value="{{ old('capex_per_bed') }}" required autocomplete="capex_per_bed" autofocus>

                        @error('capex_per_bed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- Contractor -->
                    <div class="mb-3">
                        <label for="contractor" class="col-form-label">{{ __('Contractor') }}</label>
                        <input id="contractor" type="text" class="form-control @error('contractor') is-invalid @enderror" name="contractor" value="{{ old('contractor') }}" required autocomplete="contractor" autofocus>

                        @error('contractor')
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
<div class="d-flex justify-content-between">
    <button class="prev d-none d-sm-inline-block btn btn-primary shadow-sm">Previous</button>
    <button class="next d-none d-sm-inline-block btn btn-primary shadow-sm">Next</button>
</div>