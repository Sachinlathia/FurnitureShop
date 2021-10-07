
jQuery.noConflict();
jQuery(document).ready(function()
{

   setInterval(function(){
      get_data();
      
   },500);

   jQuery("#updateProizvodjac").hide();



   jQuery("#btnDodaj").on('click',function(){
    var proizvodjactb = jQuery("#tbProizvodjac").val();

    if(proizvodjactb == ""){
         jQuery("#inputError").html('Polje mora biti popunjeno');
            jQuery("#inputError").css('color','red');
            return false;
            
    }
    else{
       jQuery("#inputError").html('');
      
       jQuery.ajax({
         type:'POST',
         url:'phpskripte/dodajProizvodjaca.php',
         data:jQuery('#FrmUbaci').serialize(),
         success:function(result)
         {
            if(result.status=='success'){
               setTimeout(function(){
                  Swal.fire({
                     icon: 'success',
                     title: 'Success',
                     text: 'New Maker sucessfuly addeded!'
                     
                   })
                  },100);
                  /* jQuery('#frmUbaci')[0].reset(); */
            }
            else if(result.status=='fail'){
               setTimeout(function(){
                  Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: 'This maker already exists!'
                     
                   })
                  },100);
            }
         }

       });
    }
   });

   function get_data(){
      
   
   /* GET DATA THROUGH AJAX */
   jQuery.ajax({
      type:'POST',
      url:'phpskripte/vratiProizvodjaca.php',
      success:function(result){
         jQuery("#tabela").html(result);
      }
   })
   
   
   }
   

})
