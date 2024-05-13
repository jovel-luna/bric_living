@extends('layouts.app', ['pageSlug' => 'property-import'])

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Import</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Import</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div></div>
                        <a href="{{ URL::previous() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Import</h6>
                        </div>
                        <form method="POST" action="{{route('upload.import')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="type" class="col-form-label">{{ __('Module Section') }}<span class="isRequired"> * </span></label>
                                        <div class="custom-dropdown">
                                            <select id="uploadType" name="type" class="form-control form-control-sm select_menu" required>
                                                <option value="">Please Select Module</option>
                                                <option value="Properties" {{ $data['referrer'] == '/home' ? 'selected': ''}}>Properties</option>
                                                <option value="Development" {{ $data['referrer'] == '/development' ? 'selected': ''}}>Development</option>
                                                <option value="Operations" {{ $data['referrer'] == '/operation' ? 'selected': ''}}>Operations</option>
                                                <option value="Budget">Budget</option>
                                                <option value="Expenditure">Expenditure</option>
                                                <option value="Lettings" {{ $data['referrer'] == '/letting' ? 'selected': ''}}>Lettings</option>
                                                <option value="Contract Status">Contract Status</option>
                                                <option value="Finance" {{ $data['referrer'] == '/finance' ? 'selected': ''}}>Finance</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                        $dlUrl = '';
                                        if ($data['referrer'] != "") {
                                            switch ($data['referrer']) {
                                                case '/home':
                                                    $dlUrl = url('sample-sheet-format-download/property');
                                                    break;
                                                case '/development':
                                                    $dlUrl = url('sample-sheet-format-download/development');
                                                    break;
                                                case '/operation':
                                                    $dlUrl = url('sample-sheet-format-download/operations');
                                                    break;
                                                case '/letting':
                                                    $dlUrl = url('sample-sheet-format-download/lettings');
                                                    break;
                                                case '/finance':
                                                    $dlUrl = url('sample-sheet-format-download/finance');
                                                    break;
                                            }
                                            
                                        }else{
                                            $dlUrl = '#';
                                        }
                                    ?>
                                    <div id="sheet-format" class="col-md-12 {{$data['referrer'] == "" ? 'd-none': ''}}">
                                        <p>Please Upload in Given Format <a href="{{$dlUrl}}">Sample sheet format</a></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{-- File Input --}}
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <span style="color:red;">*</span>File Input (only accept CSV, XLSX, XLS)</label>
                                        <input 
                                            type="file" 
                                            class="form-control form-control-user @error('file') is-invalid @enderror" 
                                            id="property-file"
                                            name="file" 
                                            value="{{ old('file') }}"
                                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                            required>
    
                                        @error('file')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
    
                                </div>
                            </div>
    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-user d-flex align-items-center gap-1 float-right mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 9l5 -5l5 5"></path>
                                        <path d="M12 4l0 12"></path>
                                     </svg>    
                                    Upload
                                </button>
                                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ URL::previous() }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
    <script>
        $(document).ready( function () {
            $(document).on('change', '#uploadType', function(e){
                if (e.target.value != "") {
                    $('#sheet-format').removeClass('d-none');
                    switch (e.target.value) {
                        case 'Properties':
                            $('#sheet-format a').attr('href', baseUrl+'/sample-sheet-format-download/property');
                            break;
                        case 'Development':
                            $('#sheet-format a').attr('href', baseUrl+'/sample-sheet-format-download/development');
                            break;
                        case 'Operations':
                            $('#sheet-format a').attr('href', baseUrl+'/sample-sheet-format-download/operations');
                            break;
                        case 'Budget':
                            $('#sheet-format a').attr('href', baseUrl+'/sample-sheet-format-download/budgets');
                            break;
                        case 'Expenditure':
                            $('#sheet-format a').attr('href', baseUrl+'/sample-sheet-format-download/expenditure');
                            break;
                        case 'Lettings':
                            $('#sheet-format a').attr('href', baseUrl+'/sample-sheet-format-download/lettings');
                            break;
                        case 'Contract Status':
                            $('#sheet-format a').attr('href', baseUrl+'/sample-sheet-format-download/contract-status');
                            break;
                        case 'Finance':
                            $('#sheet-format a').attr('href', baseUrl+'/sample-sheet-format-download/finance');
                            break;
                    }
                }else{
                    $('#sheet-format').addClass('d-none');
                    $('#sheet-format a').attr('href','#');
                }
            })
        });
    </script>
@endpush
@endsection
