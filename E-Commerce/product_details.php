
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-Commerce Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        <li class="nav-item">
          <a class="nav-link" href="cart.php">My Cart</a>
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
            <li><a class="dropdown-item" href="../User/user_login.php">Login</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" action="" method="get">
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
         session_start(); 
         error_reporting(0);
         
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
   
         <div class="row">
          <div class = "col-md-10">
          <div class="row">
         
        
          <!-- <div class = "col-md-4"> -->
             <!-- Card -->
             <!-- <div class='card' style='width: 18rem;'> -->
  <!-- <img src='' class='card-img-top' alt='$product_title'> -->
  <!-- <div class='card-body'> -->
    <!-- <h5 class='card-title'> $product_title</h5> -->
    <!-- <p class='card-text'> $product_description</p> -->
    <!-- <p class='card-text'> Price: $product_price</p> -->
    <!-- <a href='#' class='btn btn-primary'>Add to cart</a> -->
    <!-- <a href='product_details.php?product_id=$product_id' class='btn btn-primary1'>View more</a> -->
  <!-- </div> -->
<!-- </div> -->
         <!-- </div> -->


            <!-- <div class = "col-md-8"> -->
                   <!-- Related images -->
                   <!-- <div class = "row"> -->
                      <!-- <div class =  "col-md-12"> -->
                        <!-- <h4 class="text-center text-info mb-5">Related Products</h4> -->
                        <!-- <div  class = "col-md-6"> -->
                        <!-- <img src='' class='card-img-top' alt='$product_title'> -->
                        <!-- </div> -->
                        <!-- <div  class = "col-md-6"> -->
                        <!-- <img src='' class='card-img-top' alt='$product_title'>    -->
                        <!-- </div> -->
                      <!-- </div> -->
                   <!-- </div> -->
            <!-- </div> -->

    


          <?php
               
          //showing view more products

          if(isset($_GET['product_id'])){
            if(!isset($_GET['category'])){
             if(!isset($_GET['brand'])){
             
             $product_id = $_GET['product_id'];
             $select_query = "select * from `products`  where product_id = $product_id";
             $result_query = mysqli_query($conn,$select_query);
             while($row = mysqli_fetch_assoc($result_query)){
               $product_id = $row['product_id'];
               $product_title = $row['product_title'];
               $product_description = $row['product_description'];
               $product_image1 = $row['product_image1'];
               $product_image2 = $row['product_image2'];
               $product_image3 = $row['product_image3'];
               $product_price = $row['product_price'];
               $category_id = $row['category_id'];
               $brand_id = $row['brand_id'];
                     
               echo "    <div class ='col-md-3 mb-2'>
               <div class='card' style='width: 18rem;'>
     <img src='./Admin/product_images/$product_image1' class='card-img-top alt='$product_title'>
     <div class='card-body'>
       <h5 class='card-title'> $product_title</h5>
       <p class='card-text'> $product_description</p>
       <p class='card-text'> Price: $product_price</p>
       <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
       <a href='product_details.php?product_id= $product_id' class='btn btn-primary1'>View more</a>
     </div>
   </div>
               </div>
               
               
               <div class = 'col-md-8'>
               
               <div class = 'row'>
                  <div class =  'col-md-12'>
                    <h4 class='text-center text-info mb-5'>Related Products</h4>
                    <div  class = 'col-md-6'>
                    <img src='./Admin/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                    </div>
                    <div  class = 'col-md-6'>
                    <img src='./Admin/product_images/$product_image3' class='card-img-top' alt='$product_title'>   
                    </div>
                  </div>
               </div>
        </div>       
               
   ";
               
             }
           }}}

         

        //showing selected category products

        
        if(isset($_GET['category'])){
          
         $category_id = $_GET['category']; 

          $select_query = "select * from `products` where category_id = $category_id";
          $result_query = mysqli_query($conn,$select_query);
          $num_of_rows = mysqli_num_rows($result_query);
          if($num_of_rows == 0){
            echo "<h2> No Products available under this category</h2>";
          }
          while($row = mysqli_fetch_assoc($result_query)){
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
                  
            echo "    <div class ='col-md-3 mb-2'>
            <div class='card' style='width: 18rem;'>
  <img src='./Admin/product_images/$product_image1' class='card-img-top alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'> $product_title</h5>
    <p class='card-text'> $product_description</p>
    <p class='card-text'> Price: $product_price</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
    <a href='#' class='btn btn-primary1'>View more</a>
  </div>
</div>
            </div>";
            
          }
        }



          //showing selected brand products


      

        
        if(isset($_GET['brand'])){
          
          $brand_id = $_GET['brand']; 
 
           $select_query = "select * from `products` where brand_id = $brand_id";
           $result_query = mysqli_query($conn,$select_query);
           $num_of_rows = mysqli_num_rows($result_query);
           if($num_of_rows == 0){
             echo "<h2> No Products available under this brand</h2>";
           }
           while($row = mysqli_fetch_assoc($result_query)){
             $product_id = $row['product_id'];
             $product_title = $row['product_title'];
             $product_description = $row['product_description'];
             $product_image1 = $row['product_image1'];
             $product_price = $row['product_price'];
             $category_id = $row['category_id'];
             $brand_id = $row['brand_id'];
                   
             echo "    <div class ='col-md-3 mb-2'>
             <div class='card' style='width: 18rem;'>
   <img src='./Admin/product_images/$product_image1' class='card-img-top alt='$product_title'>
   <div class='card-body'>
     <h5 class='card-title'> $product_title</h5>
     <p class='card-text'> $product_description</p>
     <p class='card-text'> Price: $product_price</p>
     <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
     <a href='#' class='btn btn-primary1'>View more</a>
   </div>
 </div>
             </div>";
             
           }
         }

        



          ?>
          </div>
          </div>


<div class="col-md-2 bg-secondary p-0">
  <ul class="navbar-nav me-auto  text-center">
    <li class="nav-item bg-info">
      <a href="" class="nav-link text-light"><h4>Brands</h4></a>
    </li>



  <?php
     $selectbrands = "select * from `brands` ";
     $resultbrands = mysqli_query($conn,$selectbrands);
    
    // echo $row_data['brand_title'];
     while( $row_data = mysqli_fetch_assoc($resultbrands)){
         $brandtitle=$row_data['brand_title'];
         $brand_id=$row_data['brand_id'];
         echo "<li class='nav-item'>
         <a href='index.php?brand=$brand_id'class='nav-link text-light'><h5> $brandtitle</h5></a>
       </li>";
     }
  ?>
  </ul> 


  <ul class="navbar-nav me-auto  text-center">
    <li class="nav-item bg-info">
      <a href="" class="nav-link text-light"><h4>Category</h4></a>
    </li>
    
  <?php
     $selectcategories = "select * from `categories` ";
     $resultcategories = mysqli_query($conn,$selectcategories);
    
    // echo $row_data['brand_title'];
     while( $row_data = mysqli_fetch_assoc($resultcategories)){
         $categorytitle=$row_data['category_title'];
         $category_id=$row_data['category_id'];
         echo "<li class='nav-item'>
         <a href='index.php?category=$category_id'class='nav-link text-light'><h5> $categorytitle</h5></a>
       </li>";
     }
  ?>

  </ul> 
</div>

         </div>
          


            

</body>


</html>