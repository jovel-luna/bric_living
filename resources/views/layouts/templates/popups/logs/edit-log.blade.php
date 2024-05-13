<?php

?>
<div class="modal fade" id="editLogs" tabindex="-1" role="dialog" aria-labelledby="editLogsTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-update-logs" data-action="update">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editLogsTitle">Update Log</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update_pid" name="update_pid">
                    <input type="hidden" id="update_type" name="update_type">
                    <div class="col-md-12">
                        <div class="mb-1">
                            <textarea name="update_log_details" id="update_log_details" cols="10" rows="5" class="form-control" placeholder="Enter Log" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="update-Logs" type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>