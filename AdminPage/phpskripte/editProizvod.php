<?php 

$mysqli = new mysqli('localhost','root','','grujovic');
    if($mysqli->error){
    die("Greska". $mysqli->error);
    }

    $id=$_POST['proizvodID'];
    $rezultat = $mysqli->query("SELECT * FROM product WHERE productID LIKE '$id'");
    $getProizvodjaci = $mysqli->query("SELECT * FROM proizvodjaci");
    $output='';
                while($total = $getProizvodjaci->fetch_assoc()) {
                    $output .= '<option value="'.$total['ID'].'" >'.$total['naziv'].'</option>';
                }
    $data = $rezultat->fetch_assoc();
    if($data){
        

        
        echo ' <form id="izmeniFrm">
        <input type="hidden" id="updateID" value="'.$id.'">
        <label for="">Product name:</label>
                <input type="text" class="form-control" name="updateNaziv" id="updateNaziv" value="'.$data['naziv'].'">
                <label for="">Quantity:</label>
                <input type="text" class="form-control" name="updateKolicina" id="updateKolicina" value="'.$data['kolicina'].'">
                <label for="">Price:</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" name="updateCena" id="updateCena" class="form-control" value="'.$data['cena'].'" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00 $</span>
                </div>
        <label for="">Chose Maker:</label>
        <select class="form-select" name="updateProiz" id="updateProiz"aria-label="Default select example">
            <option selected value="'.$data['prod_proizID'].'">---Select Maker-----</option>
            '.$output.'
           
        </select>
        <label for="" >Description:</label>
        
        <textarea class="form-control" name="updateOpis" id="updateOpis" rows="3">'.$data['opis'].'</textarea>
        
        <label for="">Chose offer type:</label>
        <select class="form-select" name="updateTip" id="updateTip" aria-label="Default select example">
            <option selected value="'.$data['tip'].'">'.$data['tip'].'</option>
            <option value="Popular">Popular</option>
            <option value="New">New</option>
            <option value="Regular">Regular</option>
        </select>
        <label for="">Chose category</label>
        <select class="form-select" name="updateKategorija" id="updateKategorija" aria-label="Default select example">
            <option selected value="'.$data['kategorija'].'">'.$data['kategorija'].'</option>
            <option value="Kreveti">Kreveti</option>
            <option value="Garniture">Garniture</option>
            <option value="Stolice">Stolice</option>
        </select>
                <div class="form-group">
                    <button type="button" id="updateProizvod" name="updateProizvod"class="btn btn-block purpl">Edit Product</button>
                </div></form>';
     
} 
    
    
    ?>
    <script type="text/javascript">
jQuery(document).ready(function(){

    
    jQuery("#updateProizvod").on('click',function(){
       
        var id = jQuery('#updateID').val();
    var naziv = jQuery('#updateNaziv').val();
   var cena = jQuery('#updateCena').val();
   var kolicina = jQuery('#updateKolicina').val();
   var proizvodjac = jQuery('#updateProiz').val();
   var opis = jQuery('#updateOpis').val();
   var tip = jQuery('#updateTip').val();
   var kategorija = jQuery('#updateKategorija').val(); 
        jQuery.ajax({
            type:'POST',
            url:'phpskripte/updateProizvod.php',
            data:{id:id,naziv:naziv,cena:cena,kolicina:kolicina,proizvodjac:proizvodjac,opis:opis,tip:tip,kategorija:kategorija},
            success:function(result){
                
                 if(result.status ='success'){
                     jQuery('#addProizvod').show();
                     jQuery('#editProizvod').hide();
                    setTimeout(function(){
							Swal.fire("Success!","You successfuly updated product!","success");
						},100);
						
                }
                else{
                    setTimeout(function(){
							Swal.fire("Error!","There was a mistake!","error");
						},100);
                }  
               
            } 
        });
    })
})
</script>