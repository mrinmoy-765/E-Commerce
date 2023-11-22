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