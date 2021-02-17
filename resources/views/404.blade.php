@extends('theme.layout.layout')

@section('content')
{{-- <div class="container" style="height: 500px;margin-top:120px">
    <div class="row">
        <div class="col-lg-4 offset-5 p-5">
            <h2>ERROR 404</h2>
        </div>
    </div>
</div> --}}
<section class="content">
    <div class="error-page container" style="height: 500px;margin-top:120px">
      <h2 class="headline text-warning"> 404</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

        <p>
          We could not find the page you were looking for.
          Meanwhile, you may <a href="/">return to shopping page</a>
        </p>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
@endsection