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

<div class="row">
    <div class="col-sm-7">
        <div class="card card-primary mt-2 ml-5">
            <div class="card-header">
                <h3 class="card-title">Add Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/add_category" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="exampleInputEmail1">category</label> --}}
                        <input type="text" class="form-control" id="exampleInputEmail1" name="cat_name"
                            placeholder="Enter category name" required>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="exampleInputEmail1">category</label> --}}
                        <input type="file" class="form-control" id="exampleInputEmail1" name="cat_image" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card text-center">
    <div class="card-header">
      <h3 class="card-title">DataTable</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover text-center">
        <thead>
            <tr>
                <th>category id</th>
                <th>category name</th>
                <th>Image(300*122)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $item)
            <tr>
                <td>{{$item->cat_id}}</td>
                <td>{{$item->cat_name}}</td>
                <td><img src="/public/cat_image/{{$item->cat_image}}" alt="" width="150px" height="150px"></td>
                <td><a href="delete/{{$item->cat_id}}"><i class="fas fa-trash-alt"></a></td>
            </tr>
            @endforeach
        </tbody>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection
