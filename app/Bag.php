<?php

namespace App;

use Session;

class Bag
{
  public function __construct()
  {
    if(!(Session::has('cart'))) 
    {
      
      Session::put('cart', []);
      Session::put('subtotal', 0);
    }
  }

  public static function get()
  {
    return Session::get('cart.products');
  }

  public static function addToBag($product)
  {
    $products = Session::get('cart');
    if(array_key_exists($product->id, $products))
    {
      $product->qty = $products[$product->id]->qty + $product->qty;
      $product->sum += $products[$product->id]->sum + $product->sum;
    }

    Session::put("cart.".$product->id, $product);

    $subtotal = self::getSubTotal() + $product->sum;
    Session::put('subtotal', $subtotal);
    // Session::flash('success','barang berhasil ditambah ke keranjang!');

    dd(Session::all());

    return true;
  }

  public static function getSubTotal()
  {
    return Session::get('cart.subtotal');
  }
}
