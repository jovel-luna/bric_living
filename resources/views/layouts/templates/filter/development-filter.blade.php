<?php


?>
<div class="row mb-3">
    <div class="col">
        <div class="col align-self-center p-0">
            @if(!request()->is('letting') && !request()->is('lettings/history'))
            <div class="d-flex gap-1">
                <select id="show_limit" name="showlimit" class="custom-select custom-select-sm form-control form-control-sm">
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="all">All</option>
                </select>
                @if(!request()->is('acquisition') && hasAccess('can_import') === 'true')
                    <div class="form-actions">
                        <a href="{{ route('view.import') }}" class="import-btn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <img src="{{ url('storage/image/excel.svg') }}" alt="Excel" style="width:20px;"/>
                            Import
                        </a>
                    </div>
                @endif
            </div>
            @endif
            @if (Auth::check())
                @if(isset(Auth::user()->id) == 1 && request()->is('letting'))
                    {{-- <button id="edit-mode" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                        <i class="fa-regular fa-pen-to-square ml-1"></i> <span>Edit</span>
                    </button> --}}
                    {{-- <button id="edit-mode" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class="fa-regular fa-circle-check ml-1"></i> <span>Save</span>
                    </button> --}}
                    <div class="d-flex gap-2">
                        <div class="margin">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Bulk Action</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <button class="dropdown-item b-archive">Archive</button>
                                    <button class="dropdown-item b-update">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <div class="col">
        <div class="row justify-content-end align-items-center">
            <div class="loading-container hide col p-0 text-end">
                <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>
            </div>
            <div class="col-md-2">
                <button class="filter-btn d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#filterModal-Development">
                    <i class="fa fa-filter"></i>
                    Filter
                </button>
            </div>
            <div class="col-md-3">
                <input type="text" id="searching" name="search" class="form-control form-control-sm" placeholder="Search">
            </div>
        </div>
    </div>
</div>
