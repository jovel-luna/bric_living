<div class="modal fade" id="addPropertyVideoModal" tabindex="-1" role="dialog" aria-labelledby="addPropertyVideoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPropertyVideoModalLabel">Add Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <span class="dropzone-note"><strong>NOTE:</strong> Maximum of 1 video</span>
                    <div class="col-md-12">
                        <form action="{{ route('upload.property-video', $data['id']) }}" class="dropzone" id="my-dropzone-v">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="uploadVideoButton">
                    <i class="fas fa-upload"></i>
                    Upload
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>