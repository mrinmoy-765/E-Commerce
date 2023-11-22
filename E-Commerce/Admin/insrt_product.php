



<?php
$conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
</head>












<?php
if(isset($_POST['insert_product'])){

    $product_title =$_POST['product_title'];
    $product_description =$_POST['product_description'];
    $product_keyword =$_POST['product_keyword'];
    $product_category =$_POST['product_categories'];
    $product_brand =$_POST['product_brands'];
    $product_price =$_POST['product_price'];
    $product_status = 'true';

    //Image Access


    $product_image1 =$_FILES['product_image1']['name'];
    $product_image2 =$_FILES['product_image2']['name'];
    $product_image3 =$_FILES['product_image3']['name'];


    //Accessing Image Temp Name
    $temp_image1 =$_FILES['product_image1']['tmp_name'];
    $temp_image2 =$_FILES['product_image2']['tmp_name'];
    $temp_image3 =$_FILES['product_image3']['tmp_name'];


    // checking empty condition
    if( $product_title == '' or $product_description =='' or $product_keyword == '' or
    $product_category == '' or  $product_brand == '' or $product_price =='' or
    $product_image1 == '' or $product_image2 == '' or $product_image3 == '' ){

        echo "Please Fillup all the fields";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");


        //insert query

        $insert_products = "insert into `products` (product_title,product_description,product_keywords,
        category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) values ('$product_title' , 
        '$product_description' , '$product_keyword' , ' $product_category' , '$product_brand' ,
         '$product_image1' , '$product_image2' , '$product_image3' , '$product_price' , NOW() , '$product_status')";

         $result_query=mysqli_query($conn,$insert_products);
         if($result_query){
            echo "Successfully inserted";
         }
    }

 


}
?>










<body>
    <?php include 'header.php';?> 
    <h2 style="text-align:center;"> Insert Product into System </h2><br><br><br>
    <form action="" method="post" enctype="multipart/form-data">

    Product title: <input type="text" name="product_title" id="Product_title" placeholder="Enter product title"  required="Required"><br><br><br>
    Product description: <input type="text" name="product_description" id="Product_description" placeholder="Enter product description"  required="Required"><br><br><br>
    Product keyword: <input type="text" name="product_keyword" id="Product_keyword" placeholder="Enter product keyword" required="Required" ><br><br><br>
    <select name="product_categories" id="product_categories" class="product_category"><br><br><br>
        <option value="">Select a Category</option>
        <?php
        $selectquery="select * from `categories`";
        $resultquery=mysqli_query($conn,$selectquery);
        while($row=mysqli_fetch_assoc( $resultquery)){
            $categoey_title=$row['category_title'];
            $category_id=$row['category_id'];
            echo " <option value=' $category_id'> $categoey_title</option>";
        }
        ?>
       
        
    </select>

    <br><br><br>
   
    <select name="product_brands" id="product_brands" class="product_brand"><br><br><br>
        <option value="">Select a Brand</option>

        <?php
        $selectquery="select * from `brands`";
        $resultquery=mysqli_query($conn,$selectquery);
        while($row=mysqli_fetch_assoc( $resultquery)){
            $brand_title=$row['brand_title'];
            $brand_id=$row['brand_id'];
            echo " <option value='$brand_id'> $brand_title</option>";
        }
    ?>
    </select>

    <br><br><br>

    Product Image(1):<input type="file" name="product_image1" id="product_image=1" required="required"><br><br>
    Product Image(2):<input type="file" name="product_image2" id="product_image=2" required="required"><br><br>
    Product Image(3):<input type="file" name="product_image3" id="product_image=3" required="required"><br><br><br>

    Product price: <input type="text" name="product_price" id="Product_price" placeholder="Enter product price"  required="Required"><br><br>

    <input type="submit" name="insert_product" value="Insert Product">
    </form>



   
















</body>
</html>