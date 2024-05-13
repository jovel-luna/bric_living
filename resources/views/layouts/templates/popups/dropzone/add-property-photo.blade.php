<div class="modal fade" id="addPropertyPhotoModal" tabindex="-1" role="dialog" aria-labelledby="addPropertyPhotoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPropertyPhotoModalLabel">Add Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <span class="dropzone-note"><strong>NOTE:</strong> Maximum of 5 photo per upload</span>
                    <div class="col-md-12">
                        <form action="{{ route('upload.property-photo', $data['id']) }}" class="dropzone" id="my-dropzone-pp">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="uploadPhototButton">
                    <i class="fas fa-upload"></i>
                    Upload
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>