<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crazy Kitch | Invoice</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-header">
                            <i class="fas fa-globe"></i> Crazykitch
                            <?php
// Print the array from getdate()
// print_r(getdate());
// Return date/time info of a timestamp; then format the output
$mydate=getdate(date("U"));
// echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
?>
                            <small class="float-right">Date:
                                <?php echo "$mydate[mday]" ?>/<?php echo "$mydate[mon]"?>/<?php echo "$mydate[year]" ?></small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Admin, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{$data->name}}</strong><br>
                            {{$data->address}}
                            <br>
                            Phone:{{$data->contact}}<br>
                            Email:{{$data->email}}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #{{$data->id}}</b><br>
                        <br>
                        <b>Order ID:</b> {{$data->orderid}}<br>
                        <b>Payment Due:</b> 2/22/2014<br>
                        <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                    <th>Serial #</th>
                                    {{-- <th>Description</th> --}}
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$data->quantity}}</td>
                                    <td>{{$data->productname}}</td>
                                    <td>{{$data->sku}}</td>
                                    {{-- <td>El snort testosterone trophy driving gloves handsome</td> --}}
                                    <td>₹{{$data->price}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        <p class="lead">Payment Methods:</p>
                        <img src="../../dist/img/credit/visa.png" alt="Visa">
                        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                        <img src="../../dist/img/credit/american-express.png" alt="American Express">
                        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                        {{-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p> --}}
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>₹{{$data->price}}</td>
                                </tr>
                                <tr>
                                    <th>Tax ({{$data->TAX}}%)</th>
                                    <?php 
                                        $price=$data->price;
                                        $tax=$data->TAX;
                                        $taxamount=number_format($price*$tax/(100+$tax),2);
                                    ?>
                                    <td>₹{{$taxamount}}</td>
                                </tr>
                                <tr>
                                    <th>Shipping:</th>
                                    <?php 
              if($price > 499){
                  $charge=0;
              }else {
                  $charge=100;
              }
              ?>
                                    <td>₹{{$charge}}</td>
                                </tr>
                                <tr>
                                    <th>Total:(include TAX)</th>
                                    <td>₹{{$data->price}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->
        <!-- Page specific script -->
    </div>
    <script>
        window.addEventListener("load", window.print());

    </script>
</body>

</html>
