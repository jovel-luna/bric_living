@extends('layouts.app', ['pageSlug' => 'finance'])

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Finance</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Finance</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            @if (Session::has('success'))
            <div class="alert-container p-3">
                <div class="alert alert-success p-3">
                    <strong>Success:</strong> {{Session::get('success')}}
                </div>
            </div>
            @endif
            <div class="d-sm-flex align-items-center justify-content-end mb-3 gap-2">
                <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                </a>
            </div>
            <div id="reports" class="col-md-12">
                <div class="card card-secondary shadow mb-4 p-0">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">{{ __('Edit Finance') }}</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="editFinance" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-secondary shadow mb-4 p-0">
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold">{{ __('Current Mortgage / Bridging Loan') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12 mb-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <!-- hidden id -->
                                                 <input type="hidden" name='id' value='{{$id}}'>

                                                <!-- Mortgage Status -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_mortgage_status" class="col-form-label">{{ __('Mortgage Status') }}</label>
                                                    <select name="cm_mortgage_status" id="cm_mortgage_status" class="form-control form-control-alternative{{ $errors->has('cm_mortgage_status') ? ' is-invalid' : '' }}">             
                                                        <option value="">Please Select</option>
                                                        <option value="Expiring" {{ $data->cm_mortgage_status == "Expiring" ? 'selected' : '' }}>Expiring</option>
                                                        <option value="Application Submitted" {{ $data->cm_mortgage_status == "Application Submitted" ? 'selected' : '' }}>Application Submitted</option>
                                                        <option value="Valuation Instructed" {{ $data->cm_mortgage_status == "Valuation Instructed" ? 'selected' : '' }}>Valuation Instructed</option>
                                                        <option value="Awaiting offer" {{ $data->cm_mortgage_status == "Awaiting offer" ? 'selected' : '' }}>Awaiting offer</option>
                                                        <option value="Offered / legals" {{ $data->cm_mortgage_status == "Offered / legals" ? 'selected' : '' }}>Offered / legals</option>
                                                        <option value="Completed" {{ $data->cm_mortgage_status == "Completed" ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Provider -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_provider" class="col-form-label">{{ __('Provider') }}</label>
                                                    <input id="cm_provider" type="text" class="form-control @error('cm_provider') is-invalid @enderror" name="cm_provider" value="{{ old('cm_provider', $data->cm_provider) }}" autocomplete="cm_provider">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Account No. -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_account_no" class="col-form-label">{{ __('Account No.') }}</label>
                                                    <input id="cm_account_no" type="text" class="form-control @error('cm_account_no') is-invalid @enderror" name="cm_account_no" value="{{ old('cm_account_no', $data->cm_account_no) }}" autocomplete="cm_account_no">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <!-- Start Date -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_start_date" class="col-form-label">{{ __('Start Date') }}</label>
                                                    <input id="cm_start_date" type="text" class="form-control @error('cm_start_date') is-invalid @enderror has-datepicker" name="cm_start_date" value="{{ old('cm_start_date', $data->cm_start_date) }}" autocomplete="cm_start_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <!-- Expiration Date -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_expiration_date" class="col-form-label">{{ __('Expiration Date') }}</label>
                                                    <input id="cm_expiration_date" type="text" class="form-control @error('cm_expiration_date') is-invalid @enderror has-datepicker" name="cm_expiration_date" value="{{ old('cm_expiration_date', $data->cm_expiration_date) }}" autocomplete="cm_expiration_date">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Loan period (years) -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_loan_period" class="col-form-label">{{ __('Loan period (years)') }}</label>
                                                    <input id="cm_loan_period" type="text" class="form-control @error('cm_loan_period') is-invalid @enderror" name="cm_loan_period" value="{{ old('cm_loan_period', $data->cm_loan_period) }}" autocomplete="cm_loan_period">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Current valuation -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_current_valuation" class="col-form-label">{{ __('Current valuation') }}</label>
                                                    <input id="cm_current_valuation" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('cm_current_valuation') is-invalid @enderror" name="cm_current_valuation" value="{{ old('cm_current_valuation', $data->cm_current_valuation) }}" autocomplete="cm_current_valuation">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Loan amount -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_loan_amount" class="col-form-label">{{ __('Loan Amount') }}</label>
                                                    <input id="cm_loan_amount" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('cm_loan_amount') is-invalid @enderror" name="cm_loan_amount" value="{{ old('cm_loan_amount', $data->cm_loan_amount) }}" autocomplete="cm_loan_amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <!-- Loan % -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_loan" class="col-form-label">{{ __('Loan %') }}</label>
                                                    <input id="cm_loan" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('cm_loan') is-invalid @enderror" name="cm_loan" value="{{ old('cm_loan', $data->cm_loan) }}" autocomplete="cm_loan">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Interest rate -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_interest_rate" class="col-form-label">{{ __('Interest rate') }}</label>
                                                    <input id="cm_interest_rate" onkeyup="formatNumber(this.id)" type="text" class="form-control @error('cm_interest_rate') is-invalid @enderror" name="cm_interest_rate" value="{{ old('cm_interest_rate', $data->cm_interest_rate) }}" autocomplete="cm_interest_rate">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <!-- Monthly repayment -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_monthly_repayments" class="col-form-label">{{ __('Monthly repayment') }}</label>
                                                    <input id="cm_monthly_repayments" onkeyup="formatNumber(this.id)" type="text" class="form-control @error('cm_monthly_repayments') is-invalid @enderror" name="cm_monthly_repayments" value="{{ old('cm_monthly_repayments', $data->cm_monthly_repayments) }}" autocomplete="cm_monthly_repayments">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <!-- Monthly repayment date -->
                                                <div class="mb-3 form-group">
                                                    <label for="cm_monthly_payment_date" class="col-form-label">{{ __('Monthly repayment date') }}</label>
                                                    <input id="cm_monthly_payment_date" type="text" class="form-control @error('cm_monthly_payment_date') is-invalid @enderror has-datepicker" name="cm_monthly_payment_date" value="{{ old('cm_monthly_payment_date', $data->cm_monthly_payment_date) }}" autocomplete="cm_monthly_payment_date">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card card-secondary shadow mb-4 p-0">
                                    <div class="card-header py-2">
                                        <h6 class="m-0 font-weight-bold">{{ __('Mortgage') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12 mb-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Provider -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_provider" class="col-form-label">{{ __('Provider') }}</label>
                                                        <input id="m_provider" type="text" class="form-control @error('m_provider') is-invalid @enderror" name="m_provider" value="{{ old('m_provider', $data->m_provider) }}" autocomplete="m_provider">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Account No. -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_account_no" class="col-form-label">{{ __('Account No.') }}</label>
                                                        <input id="m_account_no" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('m_account_no') is-invalid @enderror" name="m_account_no" value="{{ old('m_account_no', $data->m_account_no) }}" autocomplete="m_account_no">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <!-- Start Date -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_start_date" class="col-form-label">{{ __('Start Date') }}</label>
                                                        <input id="m_start_date" type="text" class="form-control @error('m_start_date') is-invalid @enderror has-datepicker" name="m_start_date" value="{{ old('m_start_date', $data->m_start_date) }}" autocomplete="m_start_date">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <!-- Expiry Date -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_expiration_date" class="col-form-label">{{ __('Expiration Date') }}</label>
                                                        <input id="m_expiration_date" type="text" class="form-control @error('m_expiration_date') is-invalid @enderror has-datepicker" name="m_expiration_date" value="{{ old('m_expiration_date', $data->m_expiration_date) }}" autocomplete="m_expiration_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Loan period (years) -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_loan_period" class="col-form-label">{{ __('Loan period (years)') }}</label>
                                                        <input id="m_loan_period" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('m_loan_period') is-invalid @enderror" name="m_loan_period" value="{{ old('m_loan_period', $data->m_loan_period) }}" autocomplete="m_loan_period">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Estimated loan -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_estimated_loan" class="col-form-label">{{ __('Estimated Loan') }}</label>
                                                        <input id="m_estimated_loan" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('m_estimated_loan') is-invalid @enderror" name="m_estimated_loan" value="{{ old('m_estimated_loan', $data->m_estimated_loan) }}" autocomplete="m_estimated_loan">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Agreed loan -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_agreed_loan" class="col-form-label">{{ __('Agreed Loan') }}</label>
                                                        <input id="m_agreed_loan" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('m_agreed_loan') is-invalid @enderror" name="m_agreed_loan" value="{{ old('m_agreed_loan', $data->m_agreed_loan) }}" autocomplete="m_agreed_loan">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Estimated eqiuty release -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_estimated_equity_release" class="col-form-label">{{ __('Estimated eqiuty release') }}</label>
                                                        <input id="m_estimated_equity_release" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('m_estimated_equity_release') is-invalid @enderror" name="m_estimated_equity_release" value="{{ old('m_estimated_equity_release', $data->m_estimated_equity_release) }}" autocomplete="m_estimated_equity_release">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Equity release -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_equity_release" class="col-form-label">{{ __('Equity release ') }}</label>
                                                        <input id="m_equity_release" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('m_equity_release') is-invalid @enderror" name="m_equity_release" value="{{ old('m_equity_release', $data->m_equity_release) }}" autocomplete="m_equity_release">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- Loan % -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_loan" class="col-form-label">{{ __('Loan %') }}</label>
                                                        <input id="m_loan" type="text" onkeyup="formatNumber(this.id)" class="form-control @error('m_loan') is-invalid @enderror" name="m_loan" value="{{ old('m_loan', $data->m_loan) }}" autocomplete="m_loan">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!--  -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_start_fixed_rate_period" class="col-form-label">{{ __(' Start of fixed rate period') }}</label>
                                                        <input id="m_start_fixed_rate_period" type="text" class="form-control @error('m_start_fixed_rate_period') is-invalid @enderror has-datepicker" name="m_start_fixed_rate_period" value="{{ old('m_start_fixed_rate_period', $data->m_start_fixed_rate_period) }}" autocomplete="m_start_fixed_rate_period">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- End of fixed rate period -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_end_fixed_rate_period" class="col-form-label">{{ __('End of fixed rate period') }}</label>
                                                        <input id="m_end_fixed_rate_period" type="text" class="form-control @error('m_end_fixed_rate_period') is-invalid @enderror" name="m_estimated_loan" value="{{ old('m_end_fixed_rate_period', $data->m_end_fixed_rate_period) }}" autocomplete="m_end_fixed_rate_period">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <!-- Monthly Repayment -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_monthly_repayment" class="col-form-label">{{ __('Monthly Repayment') }}</label>
                                                        <input id="m_monthly_repayment" type="text" class="form-control @error('m_monthly_repayment') is-invalid @enderror" name="m_monthly_repayment" value="{{ old('m_monthly_repayment', $data->m_monthly_repayment) }}" autocomplete="m_monthly_repayment">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <!-- Payment date -->
                                                    <div class="mb-3 form-group">
                                                        <label for="m_monthly_repayment" class="col-form-label">{{ __('Payment date') }}</label>
                                                        <input id="m_monthly_payment_date" type="text" class="form-control @error('m_monthly_payment_date') is-invalid @enderror" name="m_monthly_payment_date" value="{{ old('m_monthly_payment_date', $data->m_monthly_payment_date) }}" autocomplete="m_monthly_payment_date">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 d-flex justify-content-center gap-2">
                                <a href="{{ URL::previous() }}" class="btn btn-danger shadow-sm" style="width:10%;">Cancel</a>
                                <button type="submit" id="finance-edit-btn" class="btn btn-success shadow-sm" style="width:10%;">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $(".has-datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            onSelect: function(date) {
                switch ($(this).attr('name')) {
                    case 'projected_completion_date':
                        checkOverrunning();
                        break;
                    default:
                        break;
                }
            }
        });

        $("#finance-edit-btn").click(function(e) {
            e.preventDefault();
            let form = $('#editFinance');
            let formId = document.getElementById('editFinance')
            let data = new FormData(formId);
            console.log(data)
            $.ajax({
                url: "{{ route('get.update-finance', $data) }}",
                type: "POST",
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false,

                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: "Finance Successfully Updated!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = baseUrl + "/property/details/" + response['id'];
                        } else {
                            window.location.href = baseUrl + "/property/details/" + response['id'];
                        }
                    })

                },
                error: function(xhr, status, error) {

                    console.log(xhr.responseJSON.errors)
                    console.log(typeof(xhr.responseJSON.errors))
                    console.log(status)
                    console.log(error)
                    Swal.fire({
                        title: 'Error',
                        text: "Review your inputs and try again",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        // capex_budget
                        // xhr.responseJSON.errors.forEach(function (value, index, array) {
                        //     console.log(value)
                        //     // $('#').addClass('is-invalid');
                        // });

                        for (const property in xhr.responseJSON.errors) {
                            // console.log(`${property}: ${xhr.responseJSON.errors[property]}`);
                            $('#' + property).addClass('is-invalid');
                            $('.invalid-feedback.' + property).addClass('is-invalid').html('<strong>' + xhr.responseJSON.errors[property] + '</strong>');
                            // <span class="invalid-feedback capex_budget" role="alert">
                        }

                    })
                }

            });

        })

    });

    function formatNumber(e) {
        // Get the user input
        var input = document.getElementById(e).value;
        if (input) {
            // Remove non-numeric characters and leading zeros
            let formattedNumber = input.replace(/[^\d]/g, '').replace(/^0+/, '');

            // Add commas for thousands
            formattedNumber = formattedNumber.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            document.getElementById(e).value = formattedNumber;
        }
    }

    function formatWholeNumber(price) {
        var numberValue = price;
        numberValue = numberValue.split(',').join('');
        return numberValue;
    }
</script>
@endpush
@endsection