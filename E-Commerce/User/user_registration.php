<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<?php
  $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
?>
<?php 
include 'header.php';

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



if(isset($_POST['user_register'])){
  $user_username=$_POST['user_username'];
  $user_email=$_POST['user_email'];
  $user_password=$_POST['user_password'];
 //$hash_password=password_hash($user_password, PASSWORD_DEFAULT);
 
  $conf_user_password=$_POST['conf_user_password'];

  $user_address=$_POST['user_address'];
  $user_contact=$_POST['user_contact'];
  $user_dob=$_POST['user_dob'];
  $user_image=$_FILES['user_image']['name'];
  $user_image_tmp=$_FILES['user_image']['tmp_name'];
  $user_ip=getIpAddress();

   $errors = array();

  $u="select  username FROM `user_table` where username ='$user_username'";
  $uu=mysqli_query($conn,$u);

  $e="select user_email from `user_table` where user_email ='$user_email'";
  $ee=mysqli_query($conn,$e);

  $c="select user_contact from `user_table` where user_contact ='$user_contact'";
  $cc=mysqli_query($conn,$c);

   if(empty($user_username)){
    $errors['u']="Username required";
   }else if(mysqli_num_rows($uu)>0){
    $errors['u'] = "Username not available";

   }



   if(empty($user_email)){
    $errors['e']="Email required";
   }else if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)){
    $errors['e'] = "Invalid email";
   }
   else if(mysqli_num_rows($ee)>0){
    $errors['e'] = "Email already used";

   }


   if(empty( $user_image)){
    $errors['i']="Image required";
   }


   if(empty( $user_address)){
    $errors['a']="Address required";
   }



   if(empty($user_contact)){
    $errors['c']="Phone no required";
   }else if(strlen($user_contact)>11 || strlen($user_contact)<11){
    $errors['c'] = "Invalid phone number";
   }else if(!preg_match("/^([0-9]{11})$/",$user_contact)){
    $errors['c'] = "Invalid phone number";
   }
   else if(mysqli_num_rows($cc)>0){
    $errors['c'] = "Phone no already used";

   }

   if(empty( $user_dob)){
    $errors['dob']="Date of birth required";
   }

   if(empty($user_password)){
    $errors['p']="Password required";
   }else if(strlen($user_password)<8){
    $errors['p'] = "Your password must contain at least 8 characters";
   }
   if($user_password!=$conf_user_password){
    $errors['p2']="Password didn't match";
   }

   if(count($errors)==0){
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");
    $insert_query="insert into  `user_table` (username,user_email	,user_image,user_address,	user_contact,	dob,password ,	user_ip	) 
    values ('$user_username','$user_email','$user_image','$user_address','$user_contact','$user_dob',' $user_password','$user_ip')";
     $sql_execute=mysqli_query($conn,$insert_query);
     if($sql_execute){
      echo "<script>alert('Registration successfull')</script>";
     }else{
           die(mysqli_error($conn));
     }
   }
/*
              //selecting cart items

              $select_cart_items="select * from `cart_details` where  ip_adddress='$user_ip'";
              $result_cart=mysqli_query($conn,$select_cart_items);
              $rows_count=mysqli_num_rows($result_cart);
              if($rows_count>0){
                $_SESSION['username']=$user_username;

                echo "<script>alert('You have new items in cart.Check Now!!!')</script>";
                echo "<script>window.open('checkout.php','_self')</script>";
              }else{
                echo "<script>window.open('../index.php','_self')</script>";
              }

     */    
}

  

     ?>















             <center><h1 style="background-color:tomato;">New User Registration Form</h1></center>
              
               <br><br><br>
             
             <form style="background-color:MediumSeaGreen;" align="center" action="" novalidate="" method="post" enctype="multipart/form-data" >


              Username:<input type="text" name="user_username" placeholder="Enter your name" autocomplete="off" >
              <p class='text-danger'><?php if(isset($errors['u'])) echo $errors['u'];?></p>
              Email:<input type="email" name="user_email" placeholder="Enter your email" autocomplete="off" >
              <p class="text-danger"><?php if(isset($errors['e'])) echo $errors['e'];?></p>
              Image:<input type="file" name="user_image"  >
              <p class="text-danger"><?php if(isset($errors['i'])) echo $errors['i'];?></p>
              Address:<input type="text" name="user_address" placeholder="Enter your address" autocomplete="off">
              <p class="text-danger"><?php if(isset($errors['a'])) echo $errors['a'];?></p>
              Contact:<input type="text" name="user_contact" placeholder="Enter your phone no" autocomplete="off">
              <p class="text-danger"><?php if(isset($errors['c'])) echo $errors['c'];?> </p>

              Date of Birth:<input type="text" name="user_dob" placeholder="Enter Date of Birth" autocomplete="off">
              <p class="text-danger"><?php if(isset($errors['dob'])) echo $errors['dob'];?> </p>


              Password:<input type="password" name="user_password" placeholder="Enter your password" autocomplete="off" >
              <p class="text-danger"><?php if(isset($errors['p'])) echo $errors['p'];?></p>
               Confirm password:<input type="password" name="conf_user_password" placeholder="Confirm your password" autocomplete="off"> 
              <p class="text-danger"><?php if(isset($errors['p2'])) echo $errors['p2'];?></p>
              <input type="submit" value="Register" name="user_register">
              <p>Already have an account??  <a href="user_login.php">Login</a></p>
              


             </form>
      






</body>
</html>