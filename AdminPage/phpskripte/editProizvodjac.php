<?php 
    $mysqli = new mysqli('localhost','root','','grujovic');
    if($mysqli->error){
    die("Greska". $mysqli->error);
    
    }
    $proiID = $_POST['proizvodjacID'];
    $rezultat = $mysqli->query("SELECT * FROM proizvodjaci WHERE ID LIKE '$proiID'");
    $data = $rezultat->fetch_assoc();
    if($data){
        

        
            echo ' <hr>
            <form id="frmUpdate">
                <div class="form-group">
                <label>Edit Maker</label>
                <input type="text" name="tbupdateProizvodjac" id="tbupdateProizvodjac" value='.$data['naziv'].' class="form-control" placeholder="">
                <span id="input1Error"></span>
                <input type="text" name="tbupdateProizvodjacID" id="tbupdateProizvodjacID" value='.$data['ID'].' class="form-control" placeholder="" readonly>
                </div>
            </form>
            <button type="button" class="btn purpl" id="btnUpdate">Edit</button>
             <button type="button" class="btn btn-secondary" id="cancelUpdate">Cancel</button>
            ';
         
    } 

?>
<script type="text/javascript">
jQuery(document).ready(function(){
    /* UPDATE PROIZVODJAC */
    jQuery("#btnUpdate").on('click',function(){
       

        jQuery.ajax({


            type:'POST',
            url:'phpskripte/updateProizvodjac.php',
            data:jQuery("#frmUpdate").serialize(),
            success:function(result){
                
                if(result.status=='success'){
                    setTimeout(function(){
							Swal.fire("Success!","You successfuly edited Maker!","success");
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