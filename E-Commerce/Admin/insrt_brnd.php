<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Brand</title>
</head>
<body>
<?php include 'header.php';?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['brndsubmit'])){
  $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
  if(isset($_POST['Brand'])){
       $brand = $_POST['Brand'];

       $brandsearch = "select * from brands where brand_title = '$brand' ";
       $query = mysqli_query($conn,$brandsearch);
       $brand_count = mysqli_num_rows($query);

       if( $brand_count){
          echo 'brand exist';
       } else{

       $sql= "INSERT INTO  `brands` (`brand_title`) VALUES ('$brand') ";

       $query = mysqli_query($conn,$sql);
       if($query){
          echo 'Entry Sucessfull';
       }else{
          echo 'Error Occured';
       }
}
}
}
?>


<h2 style="text-align:center;">Insert Brand To System</h2>
<form action="" method="post">
  Brand: <input type = "text" name="Brand">

  
  <input type="submit" name="brndsubmit" value="Insert">
</form>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include 'footer.php';?>
</body>
</html>