@extends('layouts.app', ['pageSlug' => 'entity-import'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Import Entities</h1>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end gap-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Import Entity</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div></div>
                    <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Import</h6>
                    </div>
                    <form method="POST" action="{{route('entity.upload')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                
                                <div class="col-md-12 mb-3 mt-3">
                                    <p>Please Upload in Given Format <a href="{{ route('entity.download') }}">Sample sheet format</a></p>
                                </div>
                                {{-- File Input --}}
                                <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                                    <span style="color:red;">*</span>File Input (only accept CSV, XLSX, XLS)</label>
                                    <input 
                                        type="file" 
                                        class="form-control form-control-user @error('file') is-invalid @enderror" 
                                        id="entity-file"
                                        name="file" 
                                        value="{{ old('file') }}"
                                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                        style="height: 33px;">

                                    @error('file')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-user float-right mb-3">Upload Entities</button>
                            <a class="btn btn-primary float-right mr-3 mb-3" href="{{route('entity.create')}}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
        });
    </script>
@endpush
@endsection
