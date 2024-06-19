
@extends('layouts.app', ['pageSlug' => 'advanced-search'])

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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <form action="{{ route('search-term') }}" method="get">
                @csrf
                <input type="text" name="query" />
                <input type="submit" class="btn btn-sm btn-primary" value="Search" />
            </form>

        </div>
    </div>
</section>
</div>

@endsection