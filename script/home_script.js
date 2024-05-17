let healthyTable = $('#healthy-table');
let unhealthyTable = $('#unhealthy-table');

let healthyBtn = $('#healthy-btn');
let unhealthyBtn = $('#unhealthy-btn');

let totalAmount = 0;
let showCustomerTable = false;

// Default.
unhealthyTable.hide();
$('.customer').hide();

// On click healthy btn.
$(document).on('click', '#healthy-btn', function() {
  healthyTable.show();
  unhealthyTable.hide();
})

// On click unhealthy btn.
$(document).on('click', '#unhealthy-btn', function () {
  unhealthyTable.show();
  healthyTable.hide();
})

// Add to cart.
$(document).on('click', '#add-to-cart-btn', function() {
  if (showCustomerTable == false) {
    let $selectedItems = $("input:checkbox:checked");
    $selectedItems.each(function() {
      let id = $(this).data('id');
      let quantity = $(this).parent().parent().find('.quantity-input').val();
      let price = $(this).parent().parent().find('.price').text();
      totalAmount += price * quantity;

      if(totalAmount > 0) {
        $('#total-amount').val(totalAmount);
        $('.customer').show();
        $('#add-to-cart-btn').text('Cancel from cart');
        showCustomerTable = true;
      }
    })
  }
  else {
    $('.customer').hide();
    $('#add-to-cart-btn').text('Add to Cart');
    showCustomerTable = false;
  }
  totalAmount = 0;
})

// Conform buy.
$(document).on('submit', '#cart-data', function(e) {
  e.preventDefault();
  $.post('/buy-products', $(this).serialize(), function(data) {
    if(data == '1') {
      $('.customer').hide();
      $('#add-to-cart-btn').text('Add to Cart');
      showCustomerTable = false;
      alert('Product details have been sent.');
    }
    else {
      alert(data);
    }
  })
})
