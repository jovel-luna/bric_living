@extends('layouts.app', ['pageSlug' => 'advanced-search'])

@push('styles')
<!-- <link href="{{ asset('/css/search-form.css')}}" rel="stylesheet"> -->
@endpush

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Advanced Search</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/search">Home</a></li>
                    <li class="breadcrumb-item active">Advanced Search</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row justify-content-center align-items-center" style="height: 50vh;">
        <div class="col-md-6">
            <form action="{{ route('search-term') }}" method="get" class="search-form">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="query" class="form-control search-text-field" placeholder="Search term" />
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection