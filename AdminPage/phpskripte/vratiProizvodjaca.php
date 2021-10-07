<?php 

$mysqli = new mysqli('localhost','root','','grujovic');
    if($mysqli->error){
        die("Greska". $mysqli->error);
    }
 $sqlgetData = $mysqli->query("SELECT * FROM proizvodjaci");
 $ord = 1;
 if(mysqli_num_rows($sqlgetData)>0){
    while($result = $sqlgetData->fetch_assoc())
    {
        echo '    <tr>
        <th scope="row">'.$ord++.'</th>
        <td>'.$result['naziv'].'</td>
        <td><a  href="javascript:void(0)" rel='.$result['ID'].' class="edit"><i class="fas fa-edit"></i></a></td>
        <td><a  href="javascript:void(0)" rel='.$result['ID'].' class="delete"><i class="fas fa-trash-alt"></i></a></td>
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


    jQuery(".edit").on('click',function(){
        var proizID = jQuery(this).attr('rel');
        
        jQuery("#updateProizvodjac").show();
        jQuery("#addProizvodjac").hide();

        /* EDIT PROIZVODJAC */
        jQuery.ajax({
            type:'POST',
            url:'phpskripte/editProizvodjac.php',
            data:{proizvodjacID:proizID},
            success:function(result){
                jQuery("#idIzmeni").html(result);
            }
            
        });
    });
    /* Delete button */
    jQuery(".delete").on('click',function(){
        var DeleteID = jQuery(this).attr('rel');
        
        
        jQuery.ajax({
            type:'POST',
            url:'phpskripte/deleteProizvodjac.php',
            data:{IDdel:DeleteID},
            success:function(result){
                
                if(result.status=='uspeh'){
                    setTimeout(function(){
                        Swal.fire("Error!","There was a mistake!","error");
						},100);
						
                }
                else{
                    setTimeout(function(){
                        Swal.fire("Succes!","You succesfully deleted maker!","success");
							
						},100);}
            }  
            
        });
    });



    /* CANCEL BUTTON */
    jQuery("#cancelUpdate").on('click',function(){
        jQuery("#updateProizvodjac").hide();
        jQuery("#addProizvodjac").show();
    });
})

    
</script>