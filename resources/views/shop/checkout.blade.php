@extends('layouts.shop', ['page_title'=> 'Checkout'])

@section('styles')
<style>
  label{
    font-weight: 400;
  }
  .divider-left{
    border-left: 1px solid #dadada;
  }
  .divider-right{
    border-right: 1px solid #dadada;
  }
  #shippingMethod{
    background-color: #fff7ea;
  }
  .loginFrom input, .loginFrom textarea{
    width: 100%;
  }
  .shipping{
    width: 100%!important;
    min-height: 200px;
  }
</style>
@endsection

@section('content')
<br>
<!-- breadcrumbs area start -->
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="container-inner">
          <ul>
            <li class="home">
              <a href="index.html">Home</a>
              <span><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="category3"><span>Checkout</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- breadcrumbs area end -->
<!-- START MAIN CONTAINER -->
<div class="main-container">
  <div class="product-cart">
    <div class="container">   
      <div class="row">
        <div class="checkout-content">  
          <div class="row">
            <div class="col-md-9 check-out-blok">
              <div class="panel-group" id="" role="tablist" aria-multiselectable="true">
                <div class="panel checkout-accordion">
                  <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                      <a class="" data-toggle="collapse" data-parent="#accordion" href="#billingInformation" aria-expanded="true" aria-controls="billingInformation">
                        <span>1</span> Client Information
                      </a>
                    </h4>
                  </div>
                  <div id="billingInformation" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="content-info">
                      <div class="col-md-12">
                          <div class="loginFrom">
                            <div class="row">
                              <div class="col-md-6">
                                <label class="plxLoginP">Phone</label>
                                <input name="phone" type="text"><br>
                              </div>
                              <div class="col-md-6">
                                <label class="plxLoginP">Address</label>
                                <input name="address" type="text"><br>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <label class="plxLoginP">Name</label>
                                <input name="phone" type="text" placeholder="As in ID card"><br>
                              </div>
                              <div class="col-md-6">
                                <label class="plxLoginP">Email</label>
                                <input name="email" type="text"><br>
                              </div>
                            </div>
                            <label class="plxLoginP">Comment</label><br>
                            <textarea name="comment" rows="4"></textarea>
                            {{-- <p class="plxrequired"><span>*</span> Required Field</p> --}}
                          </div>
                          <br>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel checkout-accordion">
                  <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                      <a class="" data-toggle="collapse" data-parent="#accordion" href="#shippingMethod" aria-expanded="true" aria-controls="shippingMethod">
                        <span>2</span> Billing Information
                      </a>
                    </h4>
                  </div>
                  <div id="shippingMethod" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                    <div class="content-info">
                      <div class="divider-right col-md-7">
                        <h3 style="text-transform:none;">{{$products && count($products) ? count($products) : 0}} in cart. Total price {{$subtotal ? $subtotal : 0}} USD</h3>
                        <div>
                          <p><b>Payment method</b></p>
                          <input type="radio" name="paymentType" id="paymentType_1"> <label for="paymentType_1">Payment upon receipt</label><br>
                          <input type="radio" name="paymentType" id="paymentType_2"> <label for="paymentType_2">Online card payment</label>
                        </div>
                      </div>
                      <div class="col-md-5">
                        @if($products)
                        @foreach($products as $product)
                        <p>{{$product->title}} - <b>{{$product->qty}} x {{$product->price}} {{$product->valut->sign}}</b></p>
                        @endforeach
                        @endif
                      </div>
                    </div>
                    <a class="checkPageBtn" onclick="window.sendOrder()">
                      Send
                    </a>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <!-- Shopping Code -->
              {{-- <div class="shipping">
                <div class=""><h5>Discount Codes</h5></div>
                <p>Enter your coupon code if you have one.</p>
                <form>
                  <input type="text" class="coupon-input">
                  <button class="pull-left" type="submit">APPLY COUPON</button>
                </form>
              </div> --}}
              <!-- Shopping Code -->
            </div>
          </div>
          <!-- Shopping Cart Table -->
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="cart-table">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Product name</th>
                      <th>Unit Price</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="actions-crt" colspan="6">
                        <div class="">
                          <div class="col-md-4 col-sm-4 col-xs-4 align-left"><a class="cbtn" href="/">CONTINUE SHOPPING</a></div>
                          <div class="col-md-4 col-sm-4 col-xs-4 align-center"><a href="{{route('Shop.Checkout')}}" class="cbtn">UPDATE SHOPPING CART</a></div>
                          <div onclick="window.updateCart('clear', 0)" class="col-md-4 col-sm-4 col-xs-4 align-right"><a class="cbtn" href="#">CLEAR SHOPPING CART</a></div>
                        </div>
                      </td>
                    </tr>
                    @if($products)
                    @foreach($products as $product)
                    <tr class="cart-products">
                      <td>
                        <a href="#"><img src="{{asset(preg_replace('/public/', 'storage', $product->getPrimaryImage()))}}" class="img-responsive" alt=""/></a>
                      </td>
                      <td>
                        <h6>{{$product->title}}</h6>
                      </td>
                      <td>
                        <div class="cart-price">{{$product->price}}</div>
                      </td>
                      <td>
                        <input type="text" onkeyup="window.updateCart({{$product->id}}, (this.value-{{$product->qty}}))" value="{{$product->qty}}">
                      </td>
                      <td>
                        <div class="cart-subtotal">{{($product->price)*($product->qty)}}</div>
                      </td>
                      <td><a onclick="window.updateCart({{$product->id}}, 0)"><i class="fa fa-times"></i></a></td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          <!-- Shopping Cart Table -->
        </div>
        {{-- <div class="col-md-3 category-checkout">
          <h5>YOUR CHECKOUT PROGRESS</h5>
          <ul>
            <li><a href="#" class="link-hover">Billing address</a></li>
            <li><a href="#" class="link-hover">Shipping address</a></li>
            <li><a href="#" class="link-hover">shipping method</a></li>
            <li><a href="#" class="link-hover">payment methor</a></li>
          </ul>
        </div> --}}
      </div>
      <!-- div.info-section --> 
    </div>
    <!-- Checkout Container -->
    <div class="clearfix"></div>
  </div><!-- product-cart -->
</div>
<!-- END MAIN CONTAINER -->
<div class="clearfix"></div>
@endsection