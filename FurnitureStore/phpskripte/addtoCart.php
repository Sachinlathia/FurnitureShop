<?php 

session_start();

$id = $_POST['id'];
if(isset($id)){
    $output ='';
        $total = 0;
    if($_POST['action']=='add'){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        if(isset($_SESSION['cart'])){
            $alreadyExist=0;
            foreach($_SESSION['cart'] as $key => $value){
                
                if($_SESSION['cart'][$key]['p_id']== $id){
                    $alreadyExist++;
                    $_SESSION['cart'][$key]['p_qty'] = $_SESSION['cart'][$key]['p_qty'] + $qty;
                }
            }
            if($alreadyExist<1){
                $itemArray = array(
                    'p_id' => $id,
                    'p_name' => $name,
                    'p_price' =>$price,
                    'p_qty' =>$qty
                );
                $_SESSION['cart'][] = $itemArray;
            }
        }
        else{
            $itemArray = array(
                'p_id' => $id,
                'p_name' => $name,
                'p_price' =>$price,
                'p_qty' =>$qty
            );
            $_SESSION['cart'][] = $itemArray;
        }
        
            
    }
    if($_POST['action']=='delete'){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['p_id']==$id){
                if($value['p_qty']==1){
                    unset($_SESSION['cart'][$key]);
                }
                else{
                $_SESSION['cart'][$key]['p_qty'] = $_SESSION['cart'][$key]['p_qty'] - 1;
                }
            }
        }
    }
    

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
            echo json_encode($output);
     

}

?>