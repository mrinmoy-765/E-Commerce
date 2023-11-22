<?php
  $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
  session_start(); 
  error_reporting(0);

  if(isset($_POST['submit'])){
    $email = $_POST['email'];

    $sql = "SELECT * FROM `user_table` WHERE user_email='$email'";
    $query = mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($query);


    $email_to = $row['user_email'];
    $password = $row['password'];
    $body="Password recovery";
    $msg = "Your password is  '$password' ";
    $header = "From:mrinmoydas953@gmail.com";
   if(mail($email_to,$body,$msg, $header)){
    echo "<script>alert('Email Sent')</script>";
   }else{
    "<script>alert('Email not Sent')</script>";
   }


  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<center><h1 style="background-color:tomato;">Forget Password???</h1></center>

    <br><br>

<form action="" method="post"  class="text-center">
    <div class="form-outline mb-4">

    <span style="font-size:1vw">Enter Email<span>
      <input type="email" class="form-control w-50 m-auto"  value=" " name="email">
    </div>


  
    <input type="submit" value="SUBMIT" class="bg-success py-2 px-3 border-0" name="submit">


</form>


</body>
</html>