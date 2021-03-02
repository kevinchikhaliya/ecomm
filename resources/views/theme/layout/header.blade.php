<?php 
use App\Http\COntrollers\ProductController;
$total=0;
if(Session::has('user'))
{
  $total=ProductController::cartItem();
}
$category=ProductController::category();
?>      
      <!-- Page Preloder -->
      <div id="preloder">
          <div class="loader"></div>
      </div>


      <!-- Header Section Begin -->
      <header class="header-section">
          <div class="header-top">
              <div class="container">
                  <div class="ht-left">
                      <div class="mail-service">
                          <i class="fa fa-envelope"></i>
                          kevinpatel828@gmail.com
                      </div>
                      <div class="phone-service">
                          <i class="fa fa-phone"></i>
                          +918238222848
                      </div>
                  </div>
                  <div class="ht-right">
                      @if(Session::has('user'))
                      <a href="/profile" class="login-panel">{{session()->get('user')['name']}}</a>
                      {{-- <a href="/logout" class="login-panel">Logout</a> --}}
                      @else
                      <a href="/login" class="login-panel font-weight-bold">Login</a>
                      @endif
                      
                      <div class="ht-right">
                          @if(Session::has('user'))
                            <form action="logout" method="post">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none login-panel">logout</button>
                            </form>
                          @endif
                          {{-- <select class="language_drop" name="countries" id="countries" style="width:300px;">
                              <option value='yt' data-image="img/flag-1.jpg" data-imagecss="flag yt"
                                  data-title="English">English</option>
                              <option value='yu' data-image="img/flag-2.jpg" data-imagecss="flag yu"
                                  data-title="Bangladesh">German </option>
                          </select> --}}
                      </div>
                      <div class="top-social">
                          <a href="#"><i class="ti-facebook"></i></a>
                          <a href="#"><i class="ti-twitter-alt"></i></a>
                          <a href="#"><i class="ti-linkedin"></i></a>
                          <a href="#"><i class="ti-pinterest"></i></a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="container">
              <div class="inner-header">
                  <div class="row">
                      <div class="col-lg-2 col-md-2">


                          <div class="logo">
                              <a href="/">
                                    <h3><b>CrazyKitch</b></h3>
                                  {{-- <img src="../img /logo.png" alt=""> --}}
                                  {{-- brand logo --}}
                              </a>
                          </div>


                      </div>
                      <div class="col-lg-7 col-lg-7">
                          <div class="advanced-search">
                              <button type="button" class="category-btn">All Categories</button>
                              <form action="/search" class="input-group">
                                  <input type="text" name="query" placeholder="What do you need?">
                                  <button type="submit"><i class="ti-search"></i></button>
                              </form>
                          </div>
                      </div>
                      <div class="col-lg-3 text-right col-lg-3">
                          <ul class="nav-right">
                              {{-- <li class="heart-icon"><a href="#">
                                      <i class="icon_heart_alt"></i>
                                      <span>1</span>
                                  </a>
                              </li> --}}
                              <li class="cart-icon"><a href="/cart">
                                      <i class="icon_bag_alt"></i>
                                      <span>{{$total}}</span>
                                  </a>
                                  {{-- <div class="cart-hover">
                                      <div class="select-items">
                                          <table>
                                              <tbody>
                                                  <tr>
                                                      <td class="si-pic"><img src="img/select-product-1.jpg" alt="">
                                                      </td>
                                                      <td class="si-text">
                                                          <div class="product-selected">
                                                              <p>$60.00 x 1</p>
                                                              <h6>Kabino Bedside Table</h6>
                                                          </div>
                                                      </td>
                                                      <td class="si-close">
                                                          <i class="ti-close"></i>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td class="si-pic"><img src="img/select-product-2.jpg" alt="">
                                                      </td>
                                                      <td class="si-text">
                                                          <div class="product-selected">
                                                              <p>$60.00 x 1</p>
                                                              <h6>Kabino Bedside Table</h6>
                                                          </div>
                                                      </td>
                                                      <td class="si-close">
                                                          <i class="ti-close"></i>
                                                      </td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                      <div class="select-total">
                                          <span>total:</span>
                                          <h5>$120.00</h5>
                                      </div>
                                      <div class="select-button">
                                          <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                          <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                      </div>
                                  </div> --}}
                              </li>
                                <li class="orders">
                                  <a href="/myorder" class="btn">My orders</a>
                                    {{-- <form action="/myorder" method="GET">
                                        <button type="submit" class="btn btn-flat">Orders</button>
                                    </form> --}}
                                </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <div class="nav-item">
              <div class="container">
                  <div class="nav-depart">
                      <div class="depart-btn">
                          {{-- <i class="ti-menu"></i> --}}
                          <span>All departments</span>
                          <ul class="depart-hover">
                              {{-- <li class="active"><a href="#">Women’s Clothing</a></li> --}}
                              @foreach ($category as $item)
                              <li><a href="/category/{{$item->cat_id}}">{{$item->cat_name}}</a></li>
                              @endforeach
                              
                          </ul>
                      </div>
                  </div>
                  <nav class="nav-menu mobile-menu">
                      <ul>
                          <li><a href="/">Home</a></li>
                          <li><a href="../shop">Shop</a></li>
                          <li><a href="#">Collection</a>
                              <ul class="dropdown">
                                @foreach ($category as $item)
                                <li><a href="/category/{{$item->cat_id}}">{{$item->cat_name}}</a></li>
                                @endforeach
                              </ul>
                          </li>
                          <li><a href="./blog.html">Blog</a></li>
                          <li><a href="./contact.html">Contact</a></li>
                          <li><a href="#">Pages</a>
                              <ul class="dropdown">
                                  <li><a href="./blog-details.html">Blog Details</a></li>
                                  <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                  <li><a href="./check-out.html">Checkout</a></li>
                                  <li><a href="./faq.html">Faq</a></li>
                                  <li><a href="./register.html">Register</a></li>
                                  <li><a href="./login.html">Login</a></li>
                              </ul>
                          </li>
                      </ul>
                  </nav>
                  <div id="mobile-menu-wrap"></div>
              </div>
          </div>
      </header>

      <!-- Breadcrumb Section Begin -->
      <div class="breacrumb-section">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      {{-- <div class="breadcrumb-text">
                            <a href="/"><i class="fa fa-home"></i> Home</a>
                            <span>Register</span>
                        </div> --}}
                  </div>
              </div>
          </div>
      </div>
      <!-- Breadcrumb Form Section Begin -->
      <!-- Header End -->
