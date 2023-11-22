
<?php
 
 if(isset($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    $select_query="Select * from `user_table` where username = '$user_session_name'";
    $result_query=mysqli_query($conn,$select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $username=$row_fetch['username'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_contact'];
    $user_password=$row_fetch['password'];
  
    
 }
  if(isset($_POST['user_update'])){
  $update_id=$user_id;
  $username=$_POST['user_username'];
  $user_email=$_POST['user_email'];
  $user_address=$_POST['user_address'];
  $user_mobile=$_POST['user_mobile'];
  $user_password=$_POST['user_password'];
  $user_image=$_FILES['user_image']['name'];
  $user_image_tmp=$_FILES['user_image']['tmp_name'];
  move_uploaded_file($user_image_tmp,"./user_images/$user_image");

$errors=array();












$u="select  username FROM `user_table` where username ='$username'";
  $uu=mysqli_query($conn,$u);

  $e="select user_email from `user_table` where user_email ='$user_email'";
  $ee=mysqli_query($conn,$e);

  $c="select user_contact from `user_table` where user_contact ='$user_mobile'";
  $cc=mysqli_query($conn,$c);


 if(mysqli_num_rows($uu)>0){
    $errors['u'] = "Username not available";

   }



    if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)){
    $errors['e'] = "Invalid email";
   }
   else if(mysqli_num_rows($ee)>0){
    $errors['e'] = "Email already used";

   }






    if(strlen($user_mobile)>11 || strlen($user_mobile)<11){
    $errors['c'] = "Invalid phone number";
   }else if(!preg_match("/^([0-9]{11})$/",$user_mobile)){
    $errors['c'] = "Invalid phone number";
   }
   else if(mysqli_num_rows($cc)>0){
    $errors['c'] = "Phone no already used";

   }

  if(strlen($user_password)<8){
    $errors['p'] = "Your password must contain at least 8 characters";
   }
  

   if(count($errors)==0){



 //update query
$update_data="Update `user_table` set username = '$username',user_email = '$user_email', user_image= '$user_image',user_address=' $user_address', user_contact='$user_mobile',password='$user_password'
where user_id = $update_id";
$result_query_update=mysqli_query($conn,$update_data);
if($result_query_update){
   echo "<script>alert('Changes Saved')</script>";
   echo "<script>window.open('user_logout.php','_self')</script";
}







   }

















 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h1 class="text-center text-danger mb-4">Edit Account</h1>


<form action="" method="post" enctype="multipart/form-data" class="text-center">
    <div class="form-outline mb-4">
     USERNAME   <input type="text" class="form-control w-50 m-auto" value="<?php echo  $username ?> " name="user_username" autocomplete="off">
     <p class='text-danger'><?php if(isset($errors['u'])) echo $errors['u'];?></p>
    </div>
  

    <div class="form-outline mb-4">
         <img src="./user_images/<?php echo $user_image  ?>" alt="" class="profile_img">
        <input type="file" class="form-control w-50 m-auto" name="user_image">
       
    </div>                                                                              

    <div class="form-outline mb-4">
       EMAIL <input type="text" class="form-control w-50 m-auto" value=" <?php echo   $user_email ?>" name="user_email" autocomplete="off">
       <p class="text-danger"><?php if(isset($errors['e'])) echo $errors['e'];?></p>
    </div>

    <div class="form-outline mb-4">
      PHONE NO  <input type="text" class="form-control w-50 m-auto"  value="<?php echo  $user_mobile ?>" name="user_mobile" autocomplete="off">
      <p class="text-danger"><?php if(isset($errors['c'])) echo $errors['c'];?> </p>
    </div>

    <div class="form-outline mb-4">
      ADDRESS  <input type="text" class="form-control w-50 m-auto"  value="<?php echo  $user_address ?>" name="user_address"autocomplete="off">
    </div>

    <div class="form-outline mb-4">
      CHANGE PASSWORD  <input type="text" class="form-control w-50 m-auto" value=" <?php echo  $user_password ?>" name="user_password"autocomplete="off">
      <p class="text-danger"><?php if(isset($errors['p'])) echo $errors['p'];?></p>
    </div>
  
    <input type="submit" value="Update" class="bg-success py-2 px-3 border-0" name="user_update">


</form>


</body>
</html>