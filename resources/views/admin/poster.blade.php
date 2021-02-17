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

<form action="/addposter" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">poster</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="poster" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">category</label>
            <select class="form-control" name="category">
                @foreach ($category as $item)
                <option value="{{$item->cat_name}}">{{$item->cat_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">heading</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="heading" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">content</label>
            <textarea class="form-control" id="exampleInputEmail1" name="content" placeholder="content"
                required></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">discount</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="discount" required>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Add poster</button>
    </div>
</form>


<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th scope="col">Image</th>
                <th scope="col">Category</th>
                <th scope="col">Discount</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($poster as $item)
                <tr class="text-center">
                <td><img src="public/posterimage/{{$item->poster}}" alt="{{$item->poster}}" height="150px" width="250px"></th>
                <td>{{$item->category}}</td>
                <td>{{$item->discount}}%</td>
                <td><a href="/removeposter/{{$item->id}}"><i class="fas fa-trash-alt"></a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
            
        </table>
    </div>
</div>
@endsection
