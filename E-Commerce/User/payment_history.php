<?php 

$query="select * from user_payments";
$result=mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment_History</title>
</head>
<body>
    <table class="table table-bordered mt-5">
        <tr>
            <td>Payment id </td>
            <td>Order id</td>
            <td>Invoice_number</td>
            <td>Amount</td>
            <td>Payment mode</td>
            <td>Date</td>
        </tr>
        <tr>
            <?php 
            
        while($row = mysqli_fetch_assoc($result)){

            ?>
            <td><?php echo $row['payment_id'] ?></td>
            <td><?php echo $row['order_id'] ?></td>
            <td><?php echo $row['invoice_number'] ?></td>
            <td><?php echo $row['amount'] ?></td>
            <td><?php echo $row['payment_mode'] ?></td>
            <td><?php echo $row['date'] ?></td>

       </tr>
      <?php 
        }
          
        
            ?>
        
    </table>
</body>
</html>


           
           