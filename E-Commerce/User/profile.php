<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-Commerce Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <style>
    body{
        overflow-x:hidden;
    }

    .profile_img{
        width:200px;
        height:100px;
        margin:auto;
        display:block;
     
        object-fit:contain;
    }
</style>



  </head>




<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php
  $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
  session_start(); 
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid p-0">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">All Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php">My Cart</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./User/user_login.php">Login</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="search" aria-label="Search" name="search_data">
        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
        <input type = "submit" value ="search" class="btn btn-outline-dark" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

    



    
    <div class ="big-light">
        <h2 align= "center">Shopno Super Shop</h3>
        <p align ="center">The best you can get in your budget</p>
   

        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
       

        <?php  
         
       // error_reporting(0);
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>You are interacting as a guest</a>
          </li>";
         }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
          </li>";
         }
        
        
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='user_login.php'>Login</a>
          </li>";
     }else{
      echo "<li class='nav-item'>
          <a class='nav-link' href='user_logout.php'>Logout</a>
          </li>";
     } ?>
         </ul>
    </nav>

        
         
          
   
      
        
      <div class="row">
          <div class="col-md-2 ">
            <ul class="navbar-nav bg-danger text-center" style="height:50vh">
            <li class="nav-item bg-danger">
                <a class="nav-link text-light" href="#"><h2>My Profile</h2></a>
              </li>
                 
              <?php 
              
              
              $username=$_SESSION['username'];
              $user_image= "Select * from `user_table` where username='$username'";
              $result_image=mysqli_query($conn,$user_image);
              $row_image=mysqli_fetch_array($result_image);
              $user_image=$row_image['user_image'];
              
              echo  "<li class='nav-item bg-light'>
              <img src='./user_images/$user_image' class='profile_img' alt='user profile pic'>
            </li>";
      
              ?>
              
              
               
      
      
               <li class="nav-item bg-danger">
                <a class="nav-link text-light" href="profile.php"><h4>Pending Orders</h4></a>
              </li>
                 
              <li class="nav-item bg-danger">
                <a class="nav-link text-light" href="profile.php?my_orders"><h4>All orders</h4></a>
              </li>


              <li class="nav-item bg-danger">
                <a class="nav-link text-light" href="profile.php?my_payments"><h4>Payment History</h4></a>
              </li>
            
              <li class="nav-item bg-danger">
                <a class="nav-link text-light" href="profile.php?edit_account"><h4>Edit Account</h4></a>
              </li>
      
              <li class="nav-item bg-danger">
                <a class="nav-link text-light" href="profile.php?delete_account"><h4>Delete Account</h4></a>
              </li>
       
      
      
            </ul>
          </div>
          <div class="col-md-10">




          <?php 


                   global $conn;
                  
                  $username=$_SESSION['username'];
                 $get_details="Select * from `user_table` where username='$username'";
                 $result_query=mysqli_query($conn,$get_details);
           while($row_query=mysqli_fetch_assoc($result_query)){
              $user_id=$row_query['user_id'];
            if(!isset($_GET['edit_account'])){
               if(!isset($_GET['my_orders'])){
                   if(!isset($_GET['delete_account'])){
                    if(!isset($_GET['my_payments'])){
                    
                      $get_orders="Select * from `user_orders` where user_id = $user_id & order_status='pending'";
                              $result_orders_query=mysqli_query($conn,$get_orders);
                                   $row_count=mysqli_num_rows($result_orders_query);
      
                           if($row_count>0){
                          echo "<h3 class='text-center mt-5 mb-2'> You have <span class='text-danger'>$row_count</span> pending orders </h3>
                            <p class='text-center'> <a href='profile.php?my_orders'>Order Details</a></p>";
                              }else{
                       echo "<h3 class='text-center mt-5 mb-2'> You have 0 pending orders </h3>
                           <p class='text-center'> <a href='../index.php'>Explore Products</a></p>";

                    }
                       
          }
         
      }
    }
  }
}



if(isset($_GET['edit_account'])){
  include('edit_account.php');
}

if(isset($_GET['my_orders'])){
  include('user_orders.php');
}

if(isset($_GET['my_payments'])){
  include('payment_history.php');
}

if(isset($_GET['delete_account'])){
  include('delete_account.php');
}

?>
          </div>
      </div>

            

</body>


</html>