! function(document, window, $) {
  "use strict";

  window.addToCart = function(id, quantity) {
    $.ajax({
      url: "/addToCart",
      type: 'GET',
      data: {id: id, quantity: quantity},
      dataType: 'json',
      context: document.body,
      success: function(resp){
        $.toast({
          heading: 'Success',
          text: 'Good added to cart',
          showHideTransition: 'slide',
          icon: 'success'
        });
        window.getCartDetails();
      }
    });
    return 0;
  };

  window.getCartDetails = function() {
    $.ajax({
      url: "/getCartDetails",
      type: 'GET',
      dataType: 'json',
      context: document.body,
      success: function(resp){
        $('.circle-shopping').html(resp.cart_small);
      }
    });
  };

  window.updateCart = function(id, quantity) {
    $.ajax({
      url: "/updateCart",
      type: 'GET',
      data: {id: id, quantity: quantity},
      dataType: 'json',
      context: document.body,
      success: function(resp){
        window.getCartDetails();
      }
    });
  };

  window.updateCartAll = function() {
    let products = $('.cart-products');

    products.forEach(function(i) {
      console.log(i);
    });
  };

  window.sendOrder = function() {
    console.log('test');
  };

  $(document).ready(function($) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    window.getCartDetails();
  });

}(document, window, jQuery);

