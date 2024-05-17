// Add new product.
$(document).on('submit', '#new-product-data', function (e) {
  e.preventDefault();
  $.ajax({
    url: '/add-product',
    type: 'POST',
    data: $(this).serialize(),
    success: function (data) {
      if (data == '1') {
        alert('Successfully added new product.');
        $('#new-product-data')[0].reset();
      }
      else {
        alert(data);
      }
    }
  })
})
