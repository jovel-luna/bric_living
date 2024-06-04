<div class="modal fade" id="addPlanningModal" tabindex="-1" role="dialog" aria-labelledby="addPlanningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="planningForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlanningModalLabel">Add Planning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Bric Planning Ref # -->
                                        <div class="form-group">
                                            <label for="bric_planning_ref_no" class="col-form-label">{{ __('Bric Planning Ref #') }}<span class="isRequired"> * </span></label>
                                            <!-- <input id="bric_planning_ref_no" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control @error('bric_planning_ref_no') is-invalid @enderror" name="bric_planning_ref_no" value="{{ old('bric_planning_ref_no') }}" autocomplete="bric_planning_ref_no"> -->
                                            <input id="bric_planning_ref_no" type="text" class="form-control @error('bric_planning_ref_no') is-invalid @enderror" name="bric_planning_ref_no" value="{{ old('bric_planning_ref_no') }}" autocomplete="bric_planning_ref_no">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Date Submitted -->
                                        <div class="form-group">
                                            <label for="date_submitted" class="col-form-label">{{ __('Date Submitted') }}<span class="isRequired"> * </span></label>
                                            <input id="date_submitted" type="text" class="form-control @error('date_submitted') is-invalid @enderror has-datepicker" name="date_submitted" value="{{ old('date_submitted') }}" placeholder="dd-mm-yyyy" autocomplete="date_submitted">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Approved -->
                                        <div class="form-group">
                                            <label for="approved" class="col-form-label">{{ __('Approved') }}<span class="isRequired"> * </span></label>
                                            <select name="approved" id="approved" class="form-control form-control-alternative{{ $errors->has('approved') ? ' is-invalid' : '' }}">
                                                <option value="">Select Choice</option>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>      
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Application Description -->
                                        <div class="form-group">
                                            <label for="application_desc" class="col-form-label">{{ __('Application Description') }}<span class="isRequired"> * </span></label>
                                            <textarea id="application_desc" rows="5" type="text" class="form-control @error('application_desc') is-invalid @enderror" name="application_desc" value="{{ old('application_desc') }}" autocomplete="application_desc"></textarea>      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="save">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>