<div class="modal fade" id="addPropertyFloorplanModal" tabindex="-1" role="dialog" aria-labelledby="addPropertyFloorplanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPropertyFloorplanModalLabel">Add Floorplan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <span class="dropzone-note"><strong>NOTE:</strong> Maximum of 1 photo</span>
                    <div class="col-md-12">
                        <form action="{{ route('upload.property-floorplan', $data['id']) }}" class="dropzone" id="my-dropzone-fp">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="uploadFloorplanButton">
                    <i class="fas fa-upload"></i>
                    Upload
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>