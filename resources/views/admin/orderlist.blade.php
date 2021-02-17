@extends('admin.index')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card-body">
    <table id="example2" class="table table-bordered table-hover text-center">
    <thead>
        <tr>
            <th>OrderId</th>
            <th>Buyer</th>
            <th>Product Name</th>
            <th>Address</th>
            <th>Contact no</th>
            <th>Order Status</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Order Receipt</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->productname}}</td>
                <td>{{$item->address}}</td> 
                <td>{{$item->contact}}</td> 
                <td>    
                        <script>
                            function submit(){
                                document.getElementById('jsform').submit();
                                alert("value changed");
                            }
                        </script>
                        
                 <form id="jsform" action="/orderstatus" method="post" onchange="submit()">       
                    <div class="input-group mb-3">
                        @csrf
                        <select class="form-select" id="inputGroupSelect01" name="status">
                        <option selected>{{$item->status}}</option>
                        <option value="pending">Pending</option>
                        <option value="confirm">confirm</option>
                        <option value="dispatched">Dispathced</option>
                        <option value="delivered">Delivered</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="{{$item->id}}">
                </form>
                </td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->payment_method}}</td>
                <td>{{$item->payment_status}}</td>
                <td><a href="/receipt/{{$item->id}}"><i class="fa fa-file" aria-hidden="true"></i></a></td>
            </tr>
        @endforeach
    </tbody>
    
    
</table>

</div>

<div class="d-flex justify-content-center">
    {{ $orders->links() }}
</div>



@endsection