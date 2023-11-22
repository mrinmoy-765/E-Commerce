<?php 
$conn = mysqli_connect('localhost', 'root', '', 'ecom') or die ("Connection Failed:" .mysqli_connect_error());
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    $select_data="select * from `user_orders` where order_id=$order_id";
    $result=mysqli_query($conn,$select_data);
    $row_fetch=mysqli_fetch_array($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];
   
}

if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];

    $insert_query="insert into `user_payments` (order_id,invoice_number,amount,payment_mode) values ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result=mysqli_query($conn,$insert_query);
    if($result){
        echo "<script>alert('Payment Successful')</script>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }    
    $update_orders="update `user_orders` set order_status='Complete' where order_id='$order_id'";
    $result_orders=mysqli_query($conn,$update_orders);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <h1 style="text-align: center">Confirm Payment</h1>
    <form action="" method="post" class="text-center">
    Invoice Number 
      <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>"><br><br>
       Amount
       <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>"><br><br>
       Payment Method
       <select name="payment_mode" id="" class="form-select w-50 m-auto" >
        <option>Bkash</option>
        <option>Nagad</option>
        <option>Rocket</option>
        <option>Cash on Delivery</option>
        <option>Pay Offline</option>
       </select><br>
       <input type="submit" class="py-2 px-3 border-0" value="Confirm" name="confirm_payment">
    </form>
</body>
</html>