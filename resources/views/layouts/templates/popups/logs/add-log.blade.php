<?php

?>
<div class="modal fade" id="addLogs" tabindex="-1" role="dialog" aria-labelledby="addLogsTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-logs" data-action="create">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLogsTitle">New Log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="pid" name="pid">
                    <input type="hidden" id="type" name="type">
                    <div class="col-md-12">
                        <div class="mb-1">
                            <textarea name="log_details" id="log_details" cols="10" rows="5" class="form-control" placeholder="Enter Log" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="save-logs" type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>