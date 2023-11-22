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
    



    <?php 
    
        if(!isset($_SESSION['username'])){
          echo "<a href=./user_login.php>Login</a>";
        }else{
          echo "<a href=./user_logout.php>Logout</a>";
        }

    ?>

    <div class ="big-light">
        <h2 align= "center">Shopno Super Shop</h3>
        <p align ="center">The best you can get in your budget</p>

   
         <div class="row">
          <div class = "col-md-12">
          <div class="row">
         
          <?php 
          
             if(!isset($_SESSION['username'])){
                include('user_login.php');
             }else{
                include('payment.php');
             }
          
          ?>
  <!-- </ul>  -->


  <ul class="navbar-nav me-auto  text-center">
    <li class="nav-item bg-info">
      <a href="" class="nav-link text-light"><h4></h4></a>
    </li>
 
     

  

  </ul> 
</div>

         </div>
          


            

</body>


</html>