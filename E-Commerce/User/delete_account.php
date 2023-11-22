<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
<h1 class="text-center text-danger mb-4">Delete Account</h1>
<form action="" method="post" class="text-center mt-5">

<div class="form-outline mb-4">

    <input type="submit" class="form control w-50 m-auto" name="delete" value="Delete Account">

</div>

</form>

<?php 
   $username_session=$_SESSION['username'];
   if(isset($_POST['delete'])){
    $delete_query="Delete from `user_table` where username='$username_session'";
    $result=mysqli_query($conn,$delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('Account Deleted')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
   }

?>

</body>
</html>