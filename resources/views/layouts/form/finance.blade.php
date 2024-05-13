<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="col-form-label document-label">{{ __('Finance') }}</label>
            <div class="row">
                <div class="col-md-3">
                    <!-- Current Valuation -->
                    <div class="mb-3">
                        <label for="current_valuation" class="col-form-label">{{ __('Current Valuation') }}</label>
                        <input id="current_valuation" type="text" class="form-control @error('current_valuation') is-invalid @enderror" name="current_valuation" value="{{ old('current_valuation') }}" autocomplete="current_valuation">

                        @error('current_valuation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Equity -->
                    <div class="mb-3">
                        <label for="equity" class="col-form-label">{{ __('Equity') }}</label>
                        <input id="equity" type="text" class="form-control @error('equity') is-invalid @enderror" name="equity" value="{{ old('equity') }}" autocomplete="equity">

                        @error('equity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Date Mortgage -->
                    <div class="mb-3">
                        <label for="date_mortgage" class="col-form-label">{{ __('Date Mortgage') }}</label>
                        <input id="date_mortgage" type="date" class="form-control @error('date_mortgage') is-invalid @enderror" name="date_mortgage" value="{{ old('date_mortgage') }}" autocomplete="date_mortgage">

                        @error('date_mortgage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- End of Fixed Rate Period -->
                    <div class="mb-3">
                        <label for="end_of_fixed_rate_period" class="col-form-label">{{ __('End of Fixed Rate Period') }}</label>
                        <input id="end_of_fixed_rate_period" type="date" class="form-control @error('end_of_fixed_rate_period') is-invalid @enderror" name="end_of_fixed_rate_period" value="{{ old('end_of_fixed_rate_period') }}" autocomplete="end_of_fixed_rate_period">

                        @error('end_of_fixed_rate_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Fixed Rate Period -->
                    <div class="mb-3">
                        <label for="fixed_rate_period" class="col-form-label">{{ __('Fixed Rate Period') }}</label>
                        <select name="fixed_rate_period" id="fixed_rate_period" form="create" class="form-control form-control-alternative{{ $errors->has('fixed_rate_period') ? ' is-invalid' : '' }}">
                            <option value="">Please Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>             
                        @error('fixed_rate_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Monthly Repayment -->
                    <div class="mb-3">
                        <label for="monthly_payment" class="col-form-label">{{ __('Monthly Repayment') }}</label>
                        <input id="monthly_payment" type="date" class="form-control @error('monthly_payment') is-invalid @enderror" name="monthly_payment" value="{{ old('monthly_payment') }}" autocomplete="monthly_payment">

                        @error('monthly_payment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Payment Date -->
                    <div class="mb-3">
                        <label for="payment_date" class="col-form-label">{{ __('Payment Date') }}</label>
                        <input id="payment_date" type="text" class="form-control @error('payment_date') is-invalid @enderror" name="payment_date" value="29th every month" autocomplete="payment_date">

                        @error('payment_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Mortgage Provider -->
                    <div class="mb-3">
                        <label for="mortgage_provider" class="col-form-label">{{ __('Mortgage Provider') }}</label>
                        <input id="mortgage_provider" type="text" class="form-control @error('mortgage_provider') is-invalid @enderror" name="mortgage_provider" value="{{ old('mortgage_provider') }}" autocomplete="mortgage_provider">

                        @error('mortgage_provider')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Mortgage Account No. -->
                    <div class="mb-3">
                        <label for="mortgage_account_no" class="col-form-label">{{ __('Mortgage Account No.') }}</label>
                        <input id="mortgage_account_no" type="text" class="form-control @error('mortgage_account_no') is-invalid @enderror" name="mortgage_account_no" value="{{ old('mortgage_account_no') }}" autocomplete="mortgage_account_no">

                        @error('mortgage_account_no')
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
    <button class="prev">Previous</button>
    <button class="next">Next</button>
</div>