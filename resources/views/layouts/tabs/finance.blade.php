<ul class="nav nav-tabs" id="custom-sub-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="finance-info-tab" data-toggle="pill"
            href="#finance-info" role="tab" aria-controls="finance-info"
            aria-selected="true"><i class="fa-solid fa-circle-info"></i> Info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="finance-documnet-tab" data-toggle="pill"
            href="#finance-document" role="tab" aria-controls="finance-document"
            aria-selected="false"><i class="fa-solid fa-file"></i> Documents</a>
    </li>
</ul>
<div class="tab-content" id="custom-tab-content">
    <div class="tab-pane fade active show" id="finance-info" role="tabpanel" aria-labelledby="finance-info-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">{{ __('Current Mortgage/Bridging Loan') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Mortgage Status:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_mortgage_status'] ? $data['finance']['cm_mortgage_status'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Provider:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_provider'] ? $data['finance']['cm_provider'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Account No:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_account_no'] ? $data['finance']['cm_account_no'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Start Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_start_date'] ? $data['finance']['cm_start_date'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Expiration Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_expiration_date'] ? $data['finance']['cm_expiration_date'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Loan Period (years):</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_loan_period'] ? $data['finance']['cm_loan_period'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Current Valuation:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_current_valuation'] ? $data['finance']['cm_current_valuation'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Loan Amount:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_loan_amount'] ? $data['finance']['cm_loan_amount'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Loan %:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_loan'] ? $data['finance']['cm_loan'].'%' : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Interest Rate:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_interest_rate'] ? $data['finance']['cm_interest_rate'].'%' : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Monthly Repayments:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_monthly_repayments'] ? $data['finance']['cm_monthly_repayments'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Monthly Payment Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['cm_monthly_payment_date'] ? number_abv($data['finance']['cm_monthly_payment_date']).' every month' : 'N/A' }}
                            </div>
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Provider:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_provider'] ? $data['finance']['m_provider'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Account No:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_provider'] ? $data['finance']['m_provider'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Start Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_start_date'] ? $data['finance']['m_start_date'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Expiration Date	Loan Period (years):</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_expiration_date'] ? $data['finance']['m_expiration_date'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Estimated Loan:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_estimated_loan'] ? $data['finance']['m_estimated_loan'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Agreed Loan:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_agreed_loan'] ? $data['finance']['m_agreed_loan'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Estimated Equity Release:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_estimated_equity_release'] ? $data['finance']['m_estimated_equity_release'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Equity release:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_equity_release'] ? $data['finance']['m_equity_release'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Loan %:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_loan'] ? $data['finance']['m_loan'].'%' : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>End of Fixed Rate Period:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_end_fixed_rate_period'] ? $data['finance']['m_end_fixed_rate_period'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Monthly Repayment:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_monthly_repayment'] ? $data['finance']['m_monthly_repayment'] : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Payment Date:</strong></p>
                            </div>
                            <div class="col-md-6">
                                {{ $data['finance']['m_monthly_payment_date'] ? number_abv($data['finance']['m_monthly_payment_date']).' every month' : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="finance-document" role="tabpanel" aria-labelledby="finance-document-tab">
        <div class="card card-secondary shadow mb-4 p-0">
            <div class="card-header py-1">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">{{ __('Finance Files') }}</h6>
                    <div class="col">
                        <div class="d-flex gap-2 justify-content-end align-items-center">
                            <div class="loading-container hide col p-0 text-end">
                                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
                            </div>
                            <button type="button" class="addFileModalBtn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addFileModal" data-cat="finance">
                                <i class="fas fa-plus"></i>
                                Add File
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table id="finance-documents-table" class="table documents-table table-striped m-0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date Added</th>
                            <th>File Name</th>
                            <th>File Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>