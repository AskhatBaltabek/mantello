<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]> <html lang="en" class="ie6">    <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7">    <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8">    <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9">    <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{$page_title}} | Mantello</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Favicon
  ============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('plugins/lavoro/img/favicon.ico')}}">
  
  <!-- Fonts
  ============================================ -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
  
    <!-- CSS  -->
  
  <!-- Bootstrap CSS
  ============================================ -->      
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/bootstrap.min.css')}}">
  
  <!-- owl.carousel CSS
  ============================================ -->      
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/owl.carousel.css')}}">
  
  <!-- owl.theme CSS
  ============================================ -->      
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/owl.theme.css')}}">
    
  <!-- owl.transitions CSS
  ============================================ -->      
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/owl.transitions.css')}}">
  
  <!-- font-awesome.min CSS
  ============================================ -->      
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/font-awesome.min.css')}}">
  
  <!-- font-icon CSS
  ============================================ -->      
  <link rel="stylesheet" href="{{asset('plugins/lavoro/fonts/font-icon.css')}}">
  
  <!-- jquery-ui CSS
  ============================================ -->
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/jquery-ui.css')}}">
  
  <!-- mobile menu CSS
  ============================================ -->
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/meanmenu.min.css')}}">
  
  <!-- nivo slider CSS
  ============================================ -->
  <link rel="stylesheet" href="{{asset('plugins/lavoro/custom-slider/css/nivo-slider.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('plugins/lavoro/custom-slider/css/preview.css')}}" type="text/css" media="screen" />
  
    <!-- animate CSS
  ============================================ -->         
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/animate.css')}}">
  
    <!-- normalize CSS
  ============================================ -->        
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/normalize.css')}}">

  <!-- main CSS
  ============================================ -->          
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/main.css')}}">
  
  <!-- style CSS
  ============================================ -->          
  <link rel="stylesheet" href="{{asset('plugins/lavoro/style.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/assets/plugins/toast-master/css/jquery.toast.css')}}">
  
  <!-- responsive CSS
  ============================================ -->          
  <link rel="stylesheet" href="{{asset('plugins/lavoro/css/responsive.css')}}">
  
  <link rel="stylesheet" href="{{asset('css/shop.css')}}">

  @yield('styles')

  <script src="{{asset('plugins/lavoro/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>
<body class="home-one">
  <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <!-- header area start -->
  <header class="short-stor">
    <div class="container-fluid">
      <div class="row">
        <!-- logo start -->
        <div class="col-md-3 col-sm-12 text-center nopadding-right" style="z-index:99">
          <div class="top-logo">
            <a href="/"><img src="{{asset('plugins/lavoro/img/mantello_logo/LOGO__5BMANTELLO_5D_3.gif')}}" alt="" /></a>
          </div>
        </div>
        <!-- logo end -->
        <!-- mainmenu area start -->
        <div class="col-md-6 text-center">
          <div class="mainmenu">
            <nav>
              <ul>
                <li><a href="/">Home</a></li>
                @foreach($categories as $category)
                <li class="{{count($category->children) ? 'expand' : ''}}">
                  <a href="{{route('Shop.Grid')}}?c={{$category->id}}">{{$category->title}}</a>
                  <div class="restrain mega-menu megamenu1">
                    @foreach($category->children as $subCategory)
                    <span>
                      <a class="mega-menu-title" href="{{route('Shop.Grid')}}?c={{$subCategory->id}}">{{$subCategory->title}}</a>
                      @foreach($subCategory->children as $child)
                      <a href="{{route('Shop.Grid')}}?c={{$child->id}}">{{$child->title}}</a>
                      @endforeach
                    </span>
                    @endforeach
                    <span class="block-last">
                      <img src="{{asset('plugins/lavoro/img/block_menu.jpg')}}" alt="" />
                    </span>
                  </div>
                </li>
                @endforeach
                <li><a href="about">About</a></li>
                <li><a href="contact">Contact</a></li>
              </ul>
            </nav>
          </div>
          <!-- mobile menu start -->
          <div class="row">
            <div class="col-sm-12 mobile-menu-area">
              <div class="mobile-menu hidden-md hidden-lg" id="mob-menu">
                <span class="mobile-menu-title">Menu</span>
                <nav>
                  <ul>
                    <li><a href="/">Home</a></li>
                    @foreach($categories as $category)
                    <li>
                      <a href="{{route('Shop.Grid')}}?c={{$category->id}}">{{$category->title}}</a>
                      <ul>
                        @foreach($category->children as $subCategory)
                        <li>
                          <a href="{{route('Shop.Grid')}}?c={{$subCategory->id}}">{{$subCategory->title}}</a>
                          <ul>
                            @foreach($subCategory->children as $child)
                            <li><a href="{{route('Shop.Grid')}}?c={{$child->id}}">{{$child->title}}</a></li>
                            @endforeach
                          </ul>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                    @endforeach
                    <li><a href="about">About Us</a></li>
                    <li><a href="contact">Contact Us</a></li>
                  </ul>
                </nav>
              </div>            
            </div>
          </div>
          <!-- mobile menu end -->
        </div>
        <!-- mainmenu area end -->
        <!-- top details area start -->
        <div class="col-md-3 col-sm-12 nopadding-left">
          <div class="top-detail">
            <!-- language division start -->
            <div class="disflow">
              <div class="expand lang-all disflow">
                <a href="/"><img src="{{asset('plugins/lavoro/img/country/en.gif')}}" alt="">English</a>
                <ul class="restrain language">
                  <li><a href="/"><img src="{{asset('plugins/lavoro/img/country/de_de.gif')}}" alt="">Русский</a></li>
                  <li><a href="/"><img src="{{asset('plugins/lavoro/img/country/en.gif')}}" alt="">English</a></li>
                </ul>
              </div>
              {{-- <div class="expand lang-all disflow">
                <a href="#">$ USD</a>
                <ul class="restrain language">
                  <li><a href="#">€ Eur</a></li>
                  <li><a href="#">$ USD</a></li>
                  <li><a href="#">£ GBP</a></li>
                </ul>
              </div> --}}
            </div>
            <!-- language division end -->
            <!-- addcart top start -->
            <div class="disflow">
              <div class="circle-shopping expand">
                
              </div>
            </div>
            <!-- addcart top start -->
            {{-- <!-- search divition start -->
            <div class="disflow">
              <div class="header-search expand">
                <div class="search-icon fa fa-search"></div>
                <div class="product-search restrain">
                  <div class="container nopadding-right">
                    <form action="index.html" id="searchform" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control" maxlength="128" placeholder="Search product...">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </span>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- search divition end --> --}}
            <div class="disflow">
              <div class="expand dropps-menu">
                <a href="#"><i class="fa fa-align-right"></i></a>
                <ul class="restrain language">
                  <li><a href="login.html">My Account</a></li>
                  <li><a href="wishlist.html">My Wishlist</a></li>
                  <li><a href="cart.html">My Cart</a></li>
                  <li><a href="checkout.html">Checkout</a></li>
                  <li><a href="#">Testimonial</a></li>
                  <li><a href="login.html">Log In</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- top details area end -->
      </div>
    </div>
  </header>
  <!-- header area end -->

  @yield('content')

  <!-- FOOTER START -->
  <footer>
    <!-- top footer area start -->
    <div class="top-footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-4">
            <div class="single-snap-footer">
              <div class="snap-footer-title">
                <h4>Company info</h4>
              </div>
              <div class="cakewalk-footer-content">
                <p class="footer-des">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim adm.</p>
                <a href="#" class="read-more">Read more</a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-4">
            <div class="single-snap-footer">
              <div class="snap-footer-title">
                <h4>Information</h4>
              </div>
              <div class="cakewalk-footer-content">
                <ul>
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Careers</a></li>
                  <li><a href="#">Delivery Information</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="#">Terms & Condition</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-4">
            <div class="single-snap-footer">
              <div class="snap-footer-title">
                <h4>Fashion Tags</h4>
              </div>
              <div class="cakewalk-footer-content">
                <ul>
                  <li><a href="#">My Account</a></li>
                  <li><a href="#">Login</a></li>
                  <li><a href="#">My Cart</a></li>
                  <li><a href="#">Wishlist</a></li>
                  <li><a href="#">Checkout</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2 hidden-sm">
            <div class="single-snap-footer">
              <div class="snap-footer-title">
                <h4>Fashion Tags</h4>
              </div>
              <div class="cakewalk-footer-content">
                <ul>
                  <li><a href="#">Sitemap</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="#">Advanced Search</a></li>
                  <li><a href="#">Affiliates</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-2 hidden-sm">
            <div class="single-snap-footer">
              <div class="snap-footer-title">
                <h4>Follow Us</h4>
              </div>
              <div class="cakewalk-footer-content social-footer">
                <ul>
                  <li><a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a><span> Facebook</span></li>
                  <li><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a><span> Google Plus</span></li>
                  <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a><span> Twitter</span></li>
                  <li><a href="https://youtube.com/" target="_blank"><i class="fa fa-youtube-play"></i></a><span> Youtube</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- top footer area end -->
    <!-- info footer start -->
    <div class="info-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-4">
            <div class="info-fcontainer">
              <div class="infof-icon">
                <i class="fa fa-map-marker"></i>
              </div>
              <div class="infof-content">
                <h3>Our Address</h3>
                <p>Main Street, Banasree, Dhaka</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-4">
            <div class="info-fcontainer">
              <div class="infof-icon">
                <i class="fa fa-phone"></i>
              </div>
              <div class="infof-content">
                <h3>Phone Support</h3>
                <p>+88 0173 7803547</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-4">
            <div class="info-fcontainer">
              <div class="infof-icon">
                <i class="fa fa-envelope"></i>
              </div>
              <div class="infof-content">
                <h3>Email Support</h3>
                <p>admin@bootexperts.com</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 hidden-sm">
            <div class="info-fcontainer">
              <div class="infof-icon">
                <i class="fa fa-clock-o"></i>
              </div>
              <div class="infof-content">
                <h3>Openning Hour</h3>
                <p>Sat - Thu : 9:00 am - 22:00 pm</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- info footer end -->
    <!-- footer address area start -->
    <div class="address-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <address>{{date('Y')}} <a href="/">Mantello.</a> All Rights Reserved</address>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="footer-payment pull-right">
              <a href="#"><img src="{{asset('plugins/lavoro/img/payment.png')}}" alt="" /></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer address area end -->
  </footer>
  <!-- FOOTER END -->

  <!-- JS -->
  
  <!-- jquery-1.11.3.min js
  ============================================ -->         
  <script src="{{asset('plugins/lavoro/js/vendor/jquery-1.11.3.min.js')}}"></script>
  
  <!-- bootstrap js
  ============================================ -->         
  <script src="{{asset('plugins/lavoro/js/bootstrap.min.js')}}"></script>
  
  <!-- Nivo slider js
  ============================================ -->    
  <script src="{{asset('plugins/lavoro/custom-slider/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
  <script src="{{asset('plugins/lavoro/custom-slider/home.js')}}" type="text/javascript"></script>
  
  <!-- owl.carousel.min js
  ============================================ -->       
  <script src="{{asset('plugins/lavoro/js/owl.carousel.min.js')}}"></script>
  
  <!-- jquery scrollUp js 
  ============================================ -->
  <script src="{{asset('plugins/lavoro/js/jquery.scrollUp.min.js')}}"></script>
  
  <!-- price-slider js
  ============================================ --> 
  <script src="{{asset('plugins/lavoro/js/price-slider.js')}}"></script>
  
  <!-- elevateZoom js 
  ============================================ -->
  <script src="{{asset('plugins/lavoro/js/jquery.elevateZoom-3.0.8.min.js')}}"></script>
  
  <!-- jquery.bxslider.min.js
  ============================================ -->       
  <script src="{{asset('plugins/lavoro/js/jquery.bxslider.min.js')}}"></script>
  
  <!-- mobile menu js
  ============================================ -->  
  <script src="{{asset('plugins/lavoro/js/jquery.meanmenu.js')}}"></script> 
  
  <!-- wow js
  ============================================ -->       
  <script src="{{asset('plugins/lavoro/js/wow.js')}}"></script>
  
  <!-- plugins js
  ============================================ -->         
  <script src="{{asset('plugins/lavoro/js/plugins.js')}}"></script>

  <script src="{{asset('plugins/assets/plugins/toast-master/js/jquery.toast.js')}}"></script>
  
  <!-- main js
  ============================================ -->           
  <script src="{{asset('plugins/lavoro/js/main.js')}}"></script>

  <script src="{{asset('js/shop.js')}}"></script>

  @yield('scripts')

</body>
</html>