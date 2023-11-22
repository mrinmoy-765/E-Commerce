<?php session_start(); ?>
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
  .cart_img {
    width: 80px;
    height: 100px;
    object-fit:contain;
  }
</style>

</head>




<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php
  $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">All Products</a>
        </li>

        <?php 
            if(isset($_SESSION['username'])){
              echo " <li><a class='dropdown-item' href='./User/profile.php'>My Profile</a></li>";
            }else{
              echo " <li><a class='dropdown-item' href='./User/user_registration.php'>Registration</a></li>";
            }
            
            ?>

       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
    





    <div class ="big-light">
        <h2 align= "center">Shopno Super Shop</h3>
        <p align ="center">The best you can get in your budget</p>
         <hr><hr>

       
         <div class="row">
          <div class = "col-md-10">
          <div class="row">

      
          <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
       

        <?php  
          
        
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
          <a class='nav-link' href='./User/user_login.php'>Login</a>
          </li>";
     }else{
      echo "<li class='nav-item'>
          <a class='nav-link' href='./User/user_logout.php'>Logout</a>
          </li>";
     } ?>
         </ul>
    </nav>
         
          <?php

         $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());

         include 'functions.php';


         //adding products into cart from function.php
          cart();
        
?>

     <div class ="container">
        <div class="row">
          <form action="" method="post">
            <table class="table table-bordered text-center">
              
                <!-- php code to display dynamic data -->
                <?php
                   $total_price=0;
                   $ip_address=  getIPAddress();
                   $cart_query="Select * from `cart_details` where ip_adddress='$ip_address'";
                   $result=mysqli_query($conn,$cart_query)or die( mysqli_error($conn));
                   $result_count=mysqli_num_rows($result);
                   if($result_count>0){


                   echo "<thead>
                   <tr>
                       <th>Product title</th>
                       <th>Product image</th>
                       <th>Quantity</th>
                       <th>Total price</th>
                       <th>Remove</th>
                       <th colspan='2'>Operations</th>
                   </tr>
                 </thead> 
                 <tbody>";


                   while($row=mysqli_fetch_array($result)){
                    $product_id=$row['product_id'];
                    $select_products="select * from `products` where product_id='$product_id'";
                    $result_products=mysqli_query($conn,$select_products);
                    while($row_product_price=mysqli_fetch_array($result_products)){
                          $product_price=array($row_product_price['product_price']);
                          $price_table=$row_product_price['product_price'];
                          $product_title=$row_product_price['product_title'];
                          $product_image1=$row_product_price['product_image1'];
                          $product_values=array_sum($product_price);
                          $total_price+=$product_values;
                   
                   
                ?>
                <tr>
                    <td><?php echo  $product_title ?></td>
                    <td><img src="./Admin/product_images/<?php echo  $product_image1 ?>" alt="image" class="cart_img"></td>
                    <td><input type  = "number" name="qty"  class="form-input w-50"></td>
                    <?php
                        $ip_address = getIPAddress();
                      if(isset($_POST['update_cart'])){
                       $quantities=$_POST['qty'];
                        $update_cart="update `cart_details` set quantity= $quantities where  ip_adddress= '$ip_address'";
                        $result_products_quantity=mysqli_query($conn, $update_cart);
                        $quantities2 = (int)$quantities;
                       // echo gettype( $quantities2);
                       $total_price=$total_price*$quantities2;  
                      }
                      
                    ?>
                    <td><?php echo $price_table ?></td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                    <td>
                        <!-- <button class="bg-info px-3 py-2 border-0 text-dark">Update</buttom> -->
                        <input type="submit" value= "Update Cart"class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">

                        <!-- <button class="bg-danger px-3 py-2 border-0 text-dark">Remove</buttom> -->
                        <input type="submit" value= "Remove Cart"class="bg-danger px-3 py-2 border-0 mx-3" name="remove_cart">
                    </td>
                </tr>

                <?php  }}} 
                
                else{
                  echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                }
                
                ?>
              </tbody> 
            </table>
            <!-- total -->
            <div class="d-flex mb-5">
              <?php
              
              
              $ip_address=  getIPAddress();
              $cart_query="Select * from `cart_details` where ip_adddress='$ip_address'";
              $result=mysqli_query($conn,$cart_query)or die( mysqli_error($conn));
              $result_count=mysqli_num_rows($result);
              if($result_count>0){
                echo "<h4 class='px-3'> Total:<strong class='text-danger'> $total_price  </strong> </h4>
                <input type='submit' value= 'continue shopping'class='bg-info px-3 py-2 border-0 mx-3' name='continue shopping'>
                <button class='bg-secondary p-3 py-2 border-0'><a href='./User/checkout.php' class='text-light text-decoration-none'>checkout</a></button>";
              }else{
                echo " <input type='submit' value= 'continue shopping'class='bg-info px-3 py-2 border-0 mx-3' name='continue shopping'>";
               
              }
              if(isset($_POST['continue_shopping'])){
                echo "<script>window.open('index.php','_self')</script>";
              }
              
              ?>
               
            </div>
        </div>
     </div>

      </form>


   <!-- function to remove cart -->

   <?php

      if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
          echo $remove_id;

          $delete_query="Delete from `cart_details` where product_id=$remove_id";
          $run_delete=mysqli_query($conn,$delete_query);
          if($run_delete){
              echo "<script>window.open('cart.php','_self')</script>";
          }

        }
      }

?>



  </ul> 
</div>

         </div>
          


            

</body>


</html>