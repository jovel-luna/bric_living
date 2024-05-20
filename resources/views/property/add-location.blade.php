@extends('layouts.app', ['pageSlug' => 'add-location'])
@section('content')
<table id="locations-table" class="table table-bordered letting-table property-list-table m-0" style="width:100%;" autoCompletet>
    <thead>
        <tr>
            <th>
                <div class="checkbox d-flex align-items-center justify-content-center">
                    <input id="toggleAll" class="mark-all" type="checkbox" value="" checked>
                </div>
            </th>
            <th>Ref ID</th>
            <th>Postcode</th>
            <th>Area</th>
            <th>City</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection