@extends('admin.index')
@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>product id</th>
                    <th>product name</th>
                    <th>price</th>
                    <th>TAX</th>
                    <th>MRP</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->productname}}</td>
                    <td>₹{{$item->price}}</td>
                    <td>{{$item->TAX}}%̥</td>
                    <td>₹{{$item->mrp}}</td>


                    <?php 
                  if($item->stock < 10){
                  ?><td class="text-red font-weight-bold"> {{$item->stock}}</td>
                    <?php 
                  }else { ?>
                    <td>{{$item->stock}}</td>
                    <?php }
                  ?>

                    

                    @php
                    $image=explode(',',$item->galary);
                    @endphp

                    <td><img src="/public/productimage/{{$image[0]}}" height="50px" width="50px" alt=""></td>


                    <td>{{$item->description}}</td>
                    <td>
                        <a href="remove/{{$item->id}}"><i class="fas fa-trash-alt"></i></a>
                        {{-- <a href="update/{{$item->id}}" class="ml-4"><i class="fas fa-edit"></i></a> --}}
                        <!-- Button trigger modal -->
                        <a href="#" class="ml-4" data-toggle="modal" data-target="#edit{{$item->id}}">
                            <i class="fas fa-edit"></i>
                        </a>


                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{-- model --}}
        <!-- Modal -->
        @foreach ($product as $item)
        <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="edit{{$item->id}}"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{$item->id}}">{{$item->productname}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="update/{{$item->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                    placeholder="Enter product name" value="{{$item->productname}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">product price</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="price"
                                    placeholder="Product price" value="{{$item->price}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product MRP</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" name="mrp"
                                    placeholder="Product MRP" value="{{$item->mrp}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Stock</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="stock"
                                    placeholder="Product Stock" value="{{$item->stock}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Description</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="description"
                                    placeholder="Product Description" value="{{$item->description}}" required>
                            </div>
                            @php
                            $images=explode(',',$item->galary);
                            $key=0;
                            @endphp
                            <div class="form-group">
                                <label for="image">Product images</label>

                                @foreach ($images as $key=>$item)
                                <input type="file" class="form-control p-2" name="newimage[$key]">
                                <img src="/public/productimage/{{$item}}" class="p-2" height="150px" width="150px"
                                    alt="">
                                <input type="hidden" name="oldimage[$key]" value="{{$item}}">
                                @endforeach
                                
                            </div>
                            


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        {{-- end modal --}}
        

    </div>

</div>


@endsection
