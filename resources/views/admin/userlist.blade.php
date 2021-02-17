@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="text-center">
            <h2>User-List({{$count}})</h2>
        </div>
    </div>
</div>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    @foreach ($data as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
        </tr>
    @endforeach
</table>
@endsection