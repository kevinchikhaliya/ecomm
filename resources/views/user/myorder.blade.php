@extends('theme.layout.layout')

@section('content')
<div class="custom-product">
    <div class="col-sm-10">
        <div class="trending-wrapper">
            <h2>Orders List</h2>
            {{-- <a class="btn btn-success" href="/ordernow">Order Now</a> <br> <br> --}}
            <div class="">
                @foreach ($order as $item)
                <div class="p-2">
                    <div class="row search-item cart-list-devider">
                        <div class="col-sm-4">
                            <div class="pi-pic">
                                <a href="detail/{{$item->id}}">
                                    @php
                                    $image=explode(',',$item->galary);
                                    @endphp
                                    <img src="/public/productimage/{{$image[0]}}" height="250px" alt="">
                                    {{-- <img class="trending-img" src="{{$item->galary}}"> --}}
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="">
                                <h3>{{$item->productname}}</h3>
                                <h5>Price: {{$item->price}}</h5>
                                <h5>Delivery status: {{$item->status}}</h5>
                                <h5>Payment status: {{$item->payment_status}}</h5>
                                <h5>Payment method: {{$item->payment_method}}</h5>
                                <h5>Delivery Address: {{$item->address}}</h5>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            {{-- <div class="mt-5"><a href="/removecart/{{$item->cart_id}}" class="btn
                            btn-warning">Remove From Cart</a></div> --}}
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <a class="btn btn-success" href="/ordernow">Order Now</a> <br> <br> --}}

        </div>
    </div>
</div>

</div>
@endsection
