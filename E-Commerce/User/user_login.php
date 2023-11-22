



<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php
  $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());


  include 'header.php';

//getting user's ip address

function getIPAddress() {  
 // whether ip is from the share internet  
  if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
             $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  // whether ip is from the proxy  
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
  return $ip;  

  }

?>

<?php 

 if(isset($_POST['user_login'])){
  $user_username=$_POST['user_username'];
  $user_password=$_POST['user_pass'];

  $errors = array();
 
  if(empty($user_username)){
    $errors['u1']="Username required";
  }
  if(empty( $user_password)){
    $errors['p1']="Password required";
   }
   if(count($errors)==0){



    $select_query="Select * from `user_table` where username='$user_username'";
    $result=mysqli_query($conn,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc( $result);
    $user_ip=getIPAddress();
  
    //cart item
       $select_query_cart="select * from `cart_details` where ip_adddress='$user_ip'";
       $select_cart=mysqli_query($conn,$select_query_cart);
        $row_count_cart=mysqli_num_rows( $select_cart);
      
    if($row_count>0){
     
     if($user_password='abcd1234'){
       
       
        if($row_count==1 & $row_count_cart==0){
          $_SESSION['username']=$user_username;
          echo "<script>alert('Login Successfull!!')</script>";
          echo "<script>window.open('profile.php','_self')</script>";
        } else {
          $_SESSION['username']=$user_username;
          echo "<script>alert('Login Successfull!!')</script>";
          echo "<script>window.open('payment.php','_self')</script>";
        }
      }else{
        echo "<script>alert('Invalid username or password')</script>";
      }
    }else{
        echo "<script>alert('Invalid username/password')</script>";
      }
    }
  
  

   }

 




?>
      


 

             <center><h1 style="background-color:tomato;"><i><u>Login your account</u></i></h1></center>
              
               <br><br><br>
             
             <form style="background-color:MediumSeaGreen;" align="center" action="" method="post">


              Username:<input type="text" name="user_username" placeholder="Enter your username" autocomplete="off"><br><br>
              <p class="text-danger"><?php if(isset($errors['u1'])) echo $errors['u1'];?></p>
             
              Password:<input type="password" name="user_pass" placeholder="Enter your password" autocomplete="off"><br><br>
              <p class="text-danger"><?php if(isset($errors['p1'])) echo $errors['p1'];?></p>
              <input type="submit" value="Login" name="user_login">

              <p>Don't have an account??  <a href="user_registration.php">Register Now</a></p>

              <a href="forget_pass.php">Forget Password</a>


             </form>
</body>
</html>






