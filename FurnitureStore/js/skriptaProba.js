jQuery(document).ready(function()
{
  load_cart_data(); 

function load_cart_data(){
    jQuery.ajax({
        url:"phpskripte/addtoCart.php",
        method:"POST",
        dataType:"json",
        success:function(output){
            jQuery('#modalProizvod').html(output);
            /* jQuery('.total_price').text(data.total_price);
            jQuery('.badge').text(data.total_items); */
        }
    });
};

jQuery(document).on('click', '.btnKupi',function(){
    /*  var product_id = jQuery(this).attr("id");
     var product_name = jQuery('#name'+product_id+'').val();
     var product_price = jQuery('#price'+product_id+'').val(); */
      var product_quantity = jQuery('#quantity').val();
     /* var action = "add"; */
    /* var proizID = jQuery(this).attr('rel'); */
     if(product_quantity>0){
        jQuery.ajax ({
            url:"phpskripte/addtoCart.php",
            method:"POST",
            data:jQuery("#proizvodFrm").serialize(),
            success:function(result){
                load_cart_data();
                jQuery('.NumOrd').html(result);
                alert("Product Addeded to cart");
            }
        });
     }
     else{
         alert("lease Enter Number of Quantity");
     }
    });
})