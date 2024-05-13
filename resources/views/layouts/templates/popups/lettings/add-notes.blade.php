<?php

?>
<div class="modal fade" id="addNotes" tabindex="-1" role="dialog" aria-labelledby="addNotesTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-notes" data-action="create">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNotesTitle">New Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="nid" name="nid">
                    <div class="col-md-12">
                        <div class="mb-1">
                            <textarea name="note_details" id="note_details" cols="10" rows="5" class="form-control" placeholder="Enter Note" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="save-notes" type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>