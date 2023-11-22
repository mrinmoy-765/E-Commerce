<?php

$conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());


include 'header.php';

//getting user's ip address

function getIPAddress() {  
//whether ip is from the share internet  
 if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
//whether ip is from the proxy  
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
 }  
//whether ip is from the remote address  
else{  
         $ip = $_SERVER['REMOTE_ADDR'];  
 }  
 return $ip;  

}

if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
}
//getting total items and total price of all items
$get_ip_address=getIpAddress();
$total_price=0;
$cart_query_price="select * from `cart_details` where ip_adddress='$get_ip_address'";
$result_cart_price=mysqli_query($conn,$cart_query_price);
$invoice_number=mt_rand();
$status='pending';
$count_products=mysqli_num_rows($result_cart_price);
while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['product_id'];
    $select_product="select * from `products` where product_id=$product_id";
    $run_price=mysqli_query($conn,$select_product);
    while($row_product_price=mysqli_fetch_array($run_price)){
        $product_price=array($row_product_price['product_price']);
        $product_values=array_sum($product_price);
        $total_price+=$product_values;

    }
}

//getting quantity from cart

$get_cart="select * from `cart_details`";
$run_cart=mysqli_query($conn,$get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_item_quantity['quantity'];
if($quantity==0){
    $quantity=1;
    $subtotal=$total_price;
}else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;
}
   $insert_orders="Insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values ($user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";
   $result_query=mysqli_query($conn,$insert_orders);
   if($result_query){
    echo "<script>alert('Order Submitted Successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

//orders pending
$insert_pending_orders="Insert into `orders_pending` (user_id,invoice_number,product_id, quantity,order_status) 
values ($user_id,$invoice_number,$product_id,$quantity,'$status')";
$result_pending_orders=mysqli_query($conn,$insert_pending_orders);


//delete items from cart
$empty_cart="Delete from `cart_details` where ip_adddress='$get_ip_address'";
$result_delete=mysqli_query($conn,$empty_cart);


?>