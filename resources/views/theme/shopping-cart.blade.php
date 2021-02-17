@extends('theme.layout.layout')

@section('content')


<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th class="p-name">Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                {{-- <th>TAX</th> --}}
                                <th>Total</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $total=0;
                            @endphp
                            @foreach ($cartlist as $item)
                            <?php
                            $image=explode(",",$item->galary);
                            // dd($image);
                            ?>
                            <tr>
                                <td class="cart-pic first-row"><img src="public/productimage/{{$image[0]}}" alt=""
                                        width="150px" height="150px"></td>
                                <td class="cart-title first-row">
                                    <h5 class="font-weight-bold">{{$item->productname}}</h5>
                                </td>
                                <td class="p-price first-row">₹{{$item->price}}</td>

                                <td class="p-price first-row">{{$item->quantity}}</td>
                                {{-- <td class="p-price first-row">{{$item->TAX}}</td> --}}
                                @php
                                $totalprice=0;
                                $totalprice=$item->quantity * $item->price;


                                $total+=$totalprice;
                                @endphp

                                {{-- <td class="total-price first-row">₹{{$totalprice}}</td> --}}

                                <td class="total-price first-row" name="price">₹{{$totalprice}}</td>
                                <td class="close-td first-row"><a class="alink" href="/removecart/{{$item->cart_id}}"><i
                                            class="ti-close"></i></a></td>
                            </tr>

                            @endforeach


                        </tbody>
                    </table>
                    @if ($cartlist->count()==0)
                    <div class="row">
                        <div class="col-sm-12 text-center p-5">
                            <h2>CART IS EMPTY</h2>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-4">

                        <div class="cart-buttons">
                            <a href="/shop" class="primary-btn">Continue shopping</a>
                            {{-- <a href="#" class="primary-btn up-cart">Update cart</a> --}}
                        </div>
                        {{-- <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div> --}}
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <?php 
                                    if($total > 499){
                                        // $totalprice+=0;
                                        $charge="Free Delivery";
                                    }else{
                                        
                                        $charge=100;
                                        $total+=100;
                                    }

                                    if($cartlist->count()==0){
                                        $charge=0;
                                        $total=0;
                                    }
                                    ?>

                        <div class="proceed-checkout">
                            <ul>
                                <?php
                                    if($charge==100){
                                        ?>
                                <li class="subtotal" value="">Subtotal <span>₹{{$total-$charge}}</span></li>
                                <li class="subtotal">Delivery Fee<span>₹{{$charge}}</span></li>
                                <?php
                                       } else{ ?>

                                <li class="subtotal" value="">Subtotal <span>₹{{$total}}</span></li>
                                <li class="subtotal">Delivery Fee<span>{{$charge}}</span></li>
                                <?php }
                                    ?>

                                <li class="cart-total">Total <span>₹{{$total}}</span></li>
                            </ul>
                            <a href="/ordernow" class="proceed-btn">PROCEED TO CHECK OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection
