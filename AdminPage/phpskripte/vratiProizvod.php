<?php 

$mysqli = new mysqli('localhost','root','','grujovic');
    if($mysqli->error){
        die("Greska". $mysqli->error);
    }

    $sqlgetData = $mysqli->query("SELECT * FROM product");
    
 $ord = 1;
 if(mysqli_num_rows($sqlgetData)>0){
    while($result = $sqlgetData->fetch_assoc())
    {
        

        echo '    <tr>
        <th scope="row">'.$ord++.'</th>
        
        <td>'.$result['naziv'].'</td>
        <td>'.$result['cena'].'</td>
        <td>'.$result['kolicina'].'</td>
        <td>'.$result['tip'].'</td>
        <td>'.$result['kategorija'].'</td>
        
        <td><a  href="javascript:void(0)" rel='.$result['productID'].' class="editProizvod"><i class="fas fa-edit"></i></i></a></td>
        <td><a  href="javascript:void(0)" rel='.$result['productID'].' class="deleteProizvod"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
       ';
    }
 }
 else{
     echo "no data found";
 }


?>
<script type="text/javascript">
jQuery(document).ready(function(){

    jQuery(".editProizvod").on('click',function(){
        var idProizvoda = jQuery(this).attr('rel');
        jQuery("#addProizvod").hide();
        jQuery.ajax({
            type:'POST',
            url:'phpskripte/editProizvod.php',
            data:{proizvodID:idProizvoda},
            success:function(result){
                jQuery("#editProizvod").html(result);

            }
        })
    })
    
    jQuery(".deleteProizvod").on('click',function(){
        var idProizvoda = jQuery(this).attr('rel');

        /* DELETE PROIZVOD */
        jQuery.ajax({
            type:'POST',
            url:'phpskripte/deleteProizvod.php',
            data:{proizvodID:idProizvoda},
            success:function(result){
                if(result.status!='uspeh'){
                    setTimeout(function(){
                        Swal.fire("Error!","There was a mistake!","error");
						},100);
						
                }
                else{
                    setTimeout(function(){
                        Swal.fire("Success!","You successfuly deleted product!","success");
							
						},100);}
            }
        })
    })


})


</script>