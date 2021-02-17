@extends('layout/master')
@section('content')


<?php
use App\Http\COntrollers\ProductController;

  $total=ProductController::cartItem();

  if($total != 0){ ?>


<div class="custom-product">
          <div class="col-sm-10">
            <div class="trending-wrapper">
                <h2>Cart List</h2>
                {{-- <a class="btn btn-success" href="/ordernow">Order Now</a> <br> <br> --}}
                <div class="">
                  @foreach ($cartlist as $item)
                  <div class="row search-item cart-list-devider">
                    <div class="col-sm-3">
                        <a href="detail/{{$item->id}}">
                            <img class="trending-img" src="{{$item->galary}}">
                            </a>
                    </div>
                    <div class="col-sm-3">  
                              <div class="">
                              <h3>{{$item->productname}}</h3>
                              <h5>{{$item->description}}</h5>
                              </div>  
                    </div>
                    <div class="col-sm-3">
                        <div class="mt-5"><a href="/removecart/{{$item->cart_id}}" class="btn btn-warning">Remove From Cart</a></div>
                    </div>
                  </div>  
                  @endforeach
                    <a class="btn btn-success" href="/ordernow">Order Now</a> <br> <br>

                </div>
              </div>
          </div>
          <?php } else {?>
          <h2>No orders</h2>
          <?php } ?>
</div>
@endsection