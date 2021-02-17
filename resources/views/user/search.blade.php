@extends('layout/master')
@section('content')
<div class="trending-wrapper">
    <h1>Your Result</h1>
    <div class="">
      @foreach ($products as $item)
      <div class="container">
        <div class="trending-item p-1">
            <a href="detail/{{$item->id}}">
          <img class="trending-img" src="{{$item->galary}}">
            <div class="">
            <h3>{{$item->name}}</h3>
            </div>
          </a>
          </div>  
      </div>
      @endforeach
    </div>
  </div>
@endsection