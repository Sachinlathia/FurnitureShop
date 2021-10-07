
/* jQuery.noConflict();*/
jQuery(document).ready(function()
{
    loadProduct();
    function loadProduct(){

        jQuery.ajax({

            type:'POST',
            url:'phpskripte/fetch_cart.php',
            success:function(data){
                jQuery("#modalProizvod").html(data);
            }
        });
    }
    

    
    jQuery(document).on('click', '.btnKupi',function(){
            
        var id= jQuery(this).data('id');
        var product_name = jQuery('#name').val();
        var product_price = jQuery('#price').val();
        var product_quantity = jQuery('#quantity').val();
        var dostupnaKol = jQuery('#dostupnaKol').val();

        if(dostupnaKol<product_quantity){
            setTimeout(function(){
                Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'Chosen ammount currently is not avaliable at our store.'
                   
                 })
                },100);
        }else{
            if(product_quantity<1){
                setTimeout(function(){
                    Swal.fire({
                       icon: 'error',
                       title: 'Error',
                       text: 'Please enter quantity!'
                       
                     })
                    },100);
            }
            else{
                jQuery.ajax ({
                    type:'POST',
                    url:'phpskripte/addtoCart.php',
                    dataType:'json',
                    data:{name:product_name,price:product_price,qty:product_quantity,id:id,action:'add'},
                    success:function(data){
                        jQuery("#modalProizvod").html(data);
                        jQuery("#quantity").val('');
                        
                    }
                    
                });
            }
        }
        
            
            
            
    });
    
    jQuery(document).on('click','.deleteItem',function(){
        var idDelete = jQuery(this).val();

        jQuery.ajax({
            type:'POST',
            url:'phpskripte/addtoCart.php',
            dataType:'json',
            data:{id:idDelete,action:'delete'},
            success:function(data){
                
                jQuery("#modalProizvod").html(data);
            }
        });
    });
    
    jQuery(document).on('click','.checkout',function(){
        jQuery.ajax({
            type:'POST',
            url:'phpskripte/checkout.php',
            dataType:'json',
            success:function(data){
                if(data.status == 'prazno'){
                    setTimeout(function(){
                        Swal.fire({
                           icon: 'error',
                           title: 'Error',
                           text: 'Korpa je prazna!'
                           
                         })
                        },100);
                }
                else if(data.status =='moze'){
                    setTimeout(function(){
                        Swal.fire({
                           icon: 'success',
                           title: 'Success',
                           text: 'Congratilations.You succesfuly ordered our products.'
                           
                         })
                        },100);
                        loadProduct();
                }
                else if(data.status =='ne'){
                    setTimeout(function(){
                        Swal.fire({
                           icon: 'error',
                           title: 'Error',
                           text: 'We dont have chosen ammount of products:'+data.output
                           
                         })
                        },100);
                }
                else if(data.status =='greska'){
                    setTimeout(function(){
                        Swal.fire({
                           icon: 'error',
                           title: 'Error',
                           text: 'There was a mistake'
                           
                         })
                        },100);
                }
            }
        })
    });
   
    jQuery("#search_bar").on('keyup',function(){
        var shearch_key = jQuery("#search_bar").val();
        jQuery.ajax({
            type:'POST',
            url:'phpskripte/shearch.php',
            data:{mainKey:shearch_key},
            success:function(data){
                if(jQuery("#search_bar").val().length>0){
                    jQuery("#baseProducts").hide();
                    jQuery("#shearchVisible").show();
                    jQuery("#shearchResult").html(data);
                }
                else{
                    jQuery("#baseProducts").show();
                    jQuery("#shearchVisible").hide();
                }
                
            }
        });
    });
jQuery("#primeniBtn").on('click',function(){
    var proizvodjac = jQuery("#sbProizvodjac").val();
    var kategorija = jQuery("#sbKategorija").val();
    jQuery.ajax({
        type:'POST',
        url:'phpskripte/filter.php',
        data:{proizvodjaci:proizvodjac,kat:kategorija},
        success:function(data){
            jQuery("#baseProducts").hide();
            jQuery("#shearchVisible").hide();
            jQuery("#filterVisible").show();
            jQuery("#filterResults").html(data);
            
        
        }
        
    });
    
    
});
jQuery("#resetFilter").on('click',function(){
    jQuery("#sbKategorija").val("0");
    jQuery("#sbProizvodjac").val("0");
    jQuery("#filterVisible").hide();
    jQuery("#baseProducts").show();
    });



})
