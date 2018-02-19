$( document ).ready(function() {
    function update_prices () {
      $('.order-table tr').each(function(i, row){
          var $obj_row = $(row);
          var $obj_quantity = $obj_row.find('input[name^="quantity"]')

          // get quantity and convert
          var $quantity = parseInt($obj_quantity.val(), 10);
          if(isNaN($quantity)){
              $quantity = 0;
              $obj_quantity.val("");
          } else {
              $obj_quantity.val($quantity);
          }

          // get price
          var $row_price = parseFloat(
              $obj_row.find('td[class="price"]').html().replace(',', '.')
          );

          var $newsum = $row_price * $quantity;
          if(isNaN($newsum)) {
              $newsum = 0;
          }
          $obj_row.find('td[class="row_sum"]').html(
              $newsum.toFixed(2).replace('.', ',')
          );
        });
    }

    update_prices();

    $( ".quantity" ).change(function() {
      update_prices();
    });

});
