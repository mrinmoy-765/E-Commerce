<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Category</title>
</head>
<body>
<?php include 'header.php';?>

<?php


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit_category'])){
    $conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
    if(isset($_POST['category_name'])){
         $category = $_POST['category_name'];
  
         $categorysearch = "select * from categories where category_title = '$category' ";
         $query = mysqli_query($conn,$categorysearch);
         $category_count = mysqli_num_rows($query);
  
         if( $category_count){
            echo 'category exist';
         } else{
  
         $sql= "INSERT INTO  `categories` (`category_title`) VALUES ('$category') ";
  
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

      <h2 style="text-align:center;">Insert Category To System</h2>
      <form method="post" action="">
        Category: <input type = "text" name="category_name">
        <input type="submit" name="submit_category" value="Insert">
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php include 'footer.php';?>
</body>
</html>