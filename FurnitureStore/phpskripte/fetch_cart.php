<?php 

session_start();

$output='';
$total =0;
$output .='<table class="table table-bordered">
        <thead><tr><td>Name</td><td>Price</td><td>Quantity</td><td>Action</td></tr></thead>
    ';
if(!empty($_SESSION['cart'])){
    
    foreach($_SESSION['cart'] as $key=> $value){
        $output .='
            <tr>
                <td>'.$value['p_name'].'</td><td>'.($value['p_price'] * $value['p_qty']).'.00 $</td><td>'.$value['p_qty'].'</td><td><button value="'.$value['p_id'].'" class="btn btn-danger deleteItem">Delete</button></td>
            </tr>
        ';
        $total = $total + ($value['p_price'] * $value['p_qty']);
    }
    $output .='</table>';
    $output .='<div class="text-center"><b>Total: '.$total.'.00 $</b></div>';
}
else{
    $output .='<tr>
       <td colspan="5" align="center">Cart is empty!</td>
    </tr>';
   }
   $output .='</table></div>';
   
echo $output;


?>