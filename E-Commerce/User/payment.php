<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>

     <!-- php code to access user id -->
     <?php
$conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());


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


      $user_ip=getIPAddress();
      $get_user="select * from `user_table` where user_ip='$user_ip'";
      $result=mysqli_query($conn,$get_user);
      $run_query=mysqli_fetch_array($result);
      $user_id=$run_query['user_id'];
     ?>
    <div class="container">
    <h2><center>Payment Options</center></h2>
    <div class="row">
        <a href="https://www.bkash.com"><img src="../Image/bkash.png" alt="bkash image"></a><br><br><br>
        <a href="https://nagad.com.bd/"><img src="../Image/nogad.png" alt="nagad image"></a><br><br><br>
        <a href="https://www.dutchbanglabank.com/rocket/rocket.html"><img src="../Image/rocket .png" alt="rocket image"></a><br><br><br>
        <h2><a href="order.php?user_id=<?php echo $user_id ?>">Pay offline</a></h2
    
        
</div>
</div>
</body>
</html>