@extends('admin.index')
@section('content')

@if(Session::has('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{Session::get('message')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if ($errors->any())
    <div class="alert alert-success">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row">
    <div class="col-sm-6">
        <div class="card card-primary mt-2 ml-5">
            <div class="card-header">
                <h3 class="card-title">Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/add_product" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">category</label>
                        <select class="form-control" name="cat_id">
                            @foreach ($category as $item)
                            <option value="{{$item->cat_id}}">{{$item->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                            placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SKU</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="sku"
                            placeholder="Enter sku" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Size</label>
                        <select class="form-control" name="size" id="exampleFormControlSelect1">
                            <option>S</option>
                            <option>M</option>
                            <option>XL</option>
                            <option>XXL</option>
                            <option>120ml</option>
                            <option>400ml</option>
                            <option>600ml</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Weight</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="weight"
                            placeholder="Enter product Weight" required>
                        <select class="form-control" name="weighttype" id="exampleFormControlSelect1">
                            <option value="kg">kg</option>
                            <option value="g">g</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">TAX</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="tax"
                            placeholder="Enter TAX" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">MRP</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="mrp"
                            placeholder="Enter product mrp" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stock</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="stock"
                            placeholder="Enter product stock" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea rows="3" class="form-control" name="description"
                            placeholder="Enter product description" required></textarea>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <div class="row">
                            <div class="col-sm-8">

                                <input type="file" class="form-control" id="galary" name="galary[]"
                                    placeholder="upload image" required>

                                <div id="add" class="p-2 mt-1"></div>
                            </div>
                            <div class="col-sm-4">
                                <img src="https://img.icons8.com/flat_round/50/000000/plus.png" height="30px" id="add"
                                    class="add mt-1" onclick="myfunction()" />
                                {{-- <input type="button" value="Add a field" class="add" id="add" onclick="myfunction()" /> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <input type="button" value="Add a field" class="add" id="add" onclick="myfunction()" />
                    </div>                    --}}
                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
        </form>
    </div>
</div>
</div>
<script>
    function myfunction() {
        $('#add').append(
            '<input type="file" class="form-control p-2" id="galary" name="galary[]" placeholder="upload image">'
        );
    }

</script>




@endsection
