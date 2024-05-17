$(document).ready(function(){
  $(".category-1").click(function(e){
    e.preventDefault();

    // Ajax call to fetch category 1 products.
    $.ajax({
      type: "GET",
      url: "cat1Data.php",
      success: function(response) {
        $('.category-product-1').html("");
        $.each(response, function(key, value){
          $('.category-product-1').append('<tr>'+
          '<td class="name">'+value['name']+'</td><td class="price">'+value['price']+'</td><td class="choose"><label for="select"> Select item</label><input type="checkbox" name="select[]" value="'+value['id']+'"><label for="quantity">Select Quantity</label><input type="number" name="quantity[]" min="0" max="5"></td></tr>');
        });
      },
      error: function(xhr, status, error) {
      console.error("AJAX Error:", status, error);
      }
    });
  });

    $(".category-2").click(function(e){
      e.preventDefault();
  
      // Ajax call to fetch category 2 products.
      $.ajax({
        type: "GET",
        url: "cat2Data.php",
        success: function(response) {
          $('.category-product-2').html("");
          $.each(response, function(key, value){
            $('.category-product-2').append('<tr>'+
                '<td class="name">'+value['name']+'</td><td class="price">'+value['price']+'</td><td class="choose"><label for="select"> Select item</label><input type="checkbox" name="select[]" value="'+value['id']+'"><label for="quantity">Select Quantity</label><input type="number" name="quantity[]" min="0" max="5"></td></tr>');
          });
        },
        error: function(xhr, status, error) {
        console.error("AJAX Error:", status, error);
        }
      });
    });

      $(".select-products").submit(function(){
          $("input").each(function(index, obj){
              if($(obj).val() == "") {
                  $(obj).remove();
              }
          });
      });
});