<div class="shopping-carts text-right">
  <div class="cart-toggler">
    <a href="#"><i class="icon-bag"></i></a>
    @if($productsInBag)
    <span class="cart-quantity">{{count($productsInBag)}}</span>
    @endif
  </div>
  <div class="restrain small-cart-content">
    @if($productsInBag)
    <ul class="cart-list">
      @foreach($productsInBag as $product)
      <li>
        <a class="sm-cart-product" href="{{route('Shop.Good')}}?p={{$product->id}}">
          <img src="{{asset(preg_replace('/public/', 'storage', $product->getPrimaryImage()))}}" alt="">
        </a>
        <div class="small-cart-detail">
          <a class="remove" onclick="window.updateCart({{$product->id}}, 0)"><i class="fa fa-times-circle"></i></a>
          <a class="small-cart-name" href="{{route('Shop.Good')}}?p={{$product->id}}">{{$product->title}}</a>
          <span class="quantitys"><strong>{{$product->qty}}</strong>x<span>{{$product->price}} {{$product->valut->sign}}</span></span>
        </div>
      </li>
      @endforeach
    </ul>
    <p class="total">Subtotal: <span class="amount">{{$subtotal ? $subtotal : 0}} USD</span></p>
    <p class="buttons">
      <a href="{{route('Shop.Checkout')}}" class="button">Checkout</a>
    </p>
    @else
    Empty
    @endif
  </div>
</div>