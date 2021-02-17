@extends('theme.layout.layout')

@section('content')

<div class="container ">
    <div class="row">
        <div class="col-md-12 p-5 m-auto">
            <div class="custom-product">
                <div class="col-md-12 proceed-checkout">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>₹{{$total}}</td>
                            </tr>
                            <?php 
                            // $taxrate = 18;
                            // $tax = $total * $taxrate/100;
                            $totalprice = $total;
                            
                          ?>
                            <?php 
                          if($totalprice > 499){
                              $totalprice+=0;
                              $charge="Free Delivery";
                          }else{
                              
                              $charge=100;
                              $totalprice+=100;
                          }
                          ?>
                            {{-- <tr>
                                <td>TAX</td>
                                <td>{{$tax}} INR</td>
                            </tr> --}}
                            <tr>
                                <td>Delivery Charge</td>
                                <td>₹{{$charge}}</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>₹{{$totalprice}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group flex-auto">
                        <label cla for=""></label>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mr-3 mb-3" data-toggle="modal"
                            data-target="#payment">
                            Online Payment(5% off)
                        </button>

                        <button type="button" class="btn btn-primary mr-3" data-toggle="modal"
                        data-target="#cod">
                        Cash On Delivery
                    </button>
                        {{-- <div class="form-check">
                            <input type="radio" name="payment" id="gridRadios1" value="Cash On Delivery">
                            <label class="form-check-label" for="gridRadios1">
                                Cash On Delivery
                            </label>
                        </div> --}}

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="payment" tabindex="-1" role="dialog"
                        aria-labelledby="paymentLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="paymentLabel">Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="form1" method="POST" action="/pay">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" name="address" placeholder="Enter Address"
                                                required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                {{-- <label for="mobilenumber">Contact Number:</label> --}}
                                                {{-- <input type="number" class="form-control" name="contact" pattern="[1-9]{1}[0-9]{9}" maxlength="10"> --}}
                                                <input type="text" maxlength="10" class="form-control" name="contact"
                                                    pattern="\d{10}" title="Please enter exactly 10 digits"
                                                    value="{{$user->contact}}" readonly autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="name" value="{{$user->name}}">
                                            <input type="hidden" name="email" value="{{$user->email}}">
                                            {{-- <input type="text" name="price" value="{{$totalprice}}"> --}}
                                            <?php 
                                                
                                                $total=$totalprice-$totalprice*0.05
                                            ?>
                                            <input type="hidden" name="amount" value="{{$total}}">
                                            <input type="hidden" name="payment" value="online">
                                        </div>
                                        <div class="offset-5">
                                            {{-- onclick="phonenumber(document.form1.contact)" --}}
                                            {{-- <button type="submit" --}}
                                                {{-- class="btn btn-success btn-flat mb-3">OrderPlace</button> --}}
                                            {{-- <button class="btn btn-warning btn-flat mb-3" onclick="goBack()">Go Back</button> --}}
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">PlaceOrder</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     <!-- Modal -->
                     <div class="modal fade" id="cod" tabindex="-1" role="dialog"
                     aria-labelledby="codLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="codLabel">Cash on delivery</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 <form name="form1" method="POST" action="/orderplace">
                                     @csrf
                                     <div class="form-group">
                                         <textarea class="form-control" name="address" placeholder="Enter Address"
                                             required></textarea>
                                     </div>
                                     <div class="form-group">
                                         <div class="col-sm-4">
                                             {{-- <label for="mobilenumber">Contact Number:</label> --}}
                                             {{-- <input type="number" class="form-control" name="contact" pattern="[1-9]{1}[0-9]{9}" maxlength="10"> --}}
                                             <input type="hidden" maxlength="10" class="form-control" name="contact"
                                                 pattern="\d{10}" title="Please enter exactly 10 digits"
                                                 value="{{$user->contact}}" readonly autocomplete="off" />
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <input type="hidden" name="name" value="{{$user->name}}">
                                         <input type="hidden" name="email" value="{{$user->email}}">
                                         <input type="hidden" name="price" value="{{$totalprice}}">
                                         <input type="hidden" name="amount" value="{{$totalprice}}">
                                         <input type="hidden" name="payment" value="CashOnDelivery">
                                     </div>
                                     <div class="offset-5">
                                         {{-- onclick="phonenumber(document.form1.contact)" --}}
                                         {{-- <button type="submit" --}}
                                             {{-- class="btn btn-success btn-flat mb-3">OrderPlace</button> --}}
                                         {{-- <button class="btn btn-warning btn-flat mb-3" onclick="goBack()">Go Back</button> --}}
                                     </div>
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">PlaceOrder</button>
                             </div>
                             </form>
                         </div>
                     </div>
                 </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function goBack() {
        window.history.back();
    }

</script>


@endsection
