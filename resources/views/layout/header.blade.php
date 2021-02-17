<?php 
use App\Http\COntrollers\ProductController;
$total=0;
if(Session::has('user'))
{
  $total=ProductController::cartItem();
}
?>
{{--<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="/">CrazyKitch</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active mr-3">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active mr-3">
                <a class="nav-link" href="/myorder">Orders</a>
            </li>
            <li class="nav-item m-auto">
                <form class="form-inline my-2 my-lg-0">
                <form action="/search" class="form-inline my-2 my-lg-0">
                    
                        <input type="text" name="query" type="search" class="form-control search-form" placeholder="Search">
                        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </li>

        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item"><a class="nav-link" href="cartlist">Cart({{$total}})</a></li>
            @if(Session::has('user'))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{Session::get('user')['name']}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </li>
            @else

            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>

            @endif
        </ul>
    </div>
</nav> --}}

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">CrazyKitch</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item p-2">
          <a class="nav-link" href="#">Home</a>
        </li>
       
        <form class="form-inline my-2 my-lg-0 p-2" action="/search">
            <input class="form-control mr-sm-2  search-form" type="search" placeholder="Search" name="query" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>

        @if(Session::has('user'))
        <li class="nav-item p-2">
            <a class="nav-link" href="/myorder">Orders</a>
        </li>
        <li class="nav-item p-2">
            <a class="nav-link" href="cartlist">Cart({{$total}})</a>
        </li>
        <li class="nav-item dropdown p-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                {{Session::get('user')['username']}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/profile/{{Session::get('user')['id']}}">Profile</a>
                <a class="dropdown-item" href="/logout">Logout</a>
            </div>
        </li>
        @else

        <li class="nav-item p-2"><a class="nav-link" href="/login">Login</a></li>
        <li class="nav-item p-2"><a class="nav-link" href="/register">Register</a></li>
       
        @endif

      </ul>
      
    </div>
  </nav>
  