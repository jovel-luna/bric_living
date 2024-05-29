<?php

?>
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalTitle">Filter Options</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-filter" action="#">
                    <h4>Properties</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="city" class="col-form-label">City</label>
                                <input type="text" class="form-control" id="city" autocomplete="off">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="area" class="col-form-label">Area</label>
                                <input type="text" class="form-control" id="area" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="col-form-label">House No./Street</label>
                                <input type="text" class="form-control" id="address" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="col-form-label">Contract Status</label>
                                <input type="text" class="form-control" id="status" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="deposits" class="col-form-label">Paid Deposits</label>
                                <!-- <input type="text" class="form-control" id="deposits" autocomplete="off"> -->
                                <select class="form-control selectpicker" name="deposits" id="deposits">
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="docs" class="col-form-label">Complete Documents</label>
                                <select class="form-control selectpicker" name="docs" id="docs">
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id='close-modal' type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="clear-filter" type="button" class="btn btn-warning">Clear</button>
                <button id="filter-view" type="button" class="btn btn-primary" data-dismiss="modal">View</button>
            </div>
        </div>
    </div>
</div>