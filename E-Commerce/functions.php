<?php
  $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
?>


<?php


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

// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  







  //cart function

 

   function cart(){
   
    if(isset($_GET['add_to_cart'])){
        global $conn;
        $ip = getIPAddress();/* ip_address='$ip' and */
        $get_product_id = $_GET['add_to_cart'];
          $select_query="SELECT * FROM `cart_details` where  ip_adddress='$ip' and product_id=$get_product_id";
        $result_query = mysqli_query($conn,$select_query);
        $num_of_rows = mysqli_num_rows($result_query);
               if($num_of_rows>0){
               //  echo "<h2>This item already is in your cart </h2>";
                echo "<script>alert('This item already is in your cart')</script>";
                // echo "<script>window.open('index.php','_self')</script>";
               }else{
                $insert_query = "insert into `cart_details` (product_id, ip_adddress,quantity) values ($get_product_id,'$ip',0)";
                $result_query = mysqli_query($conn,$insert_query);
               //echo "<script>window.open('index.php','_self')</script>";
              //  echo "<h2> Item added in your cart </h2>";
               echo "<script>alert('Item  added in your cart')</script>";
    
               }
      }



    }
  
  
?>