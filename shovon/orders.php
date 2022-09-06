<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- bootstrap 5 link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="mt-5">
        <p class=" text-center fw-bold text-uppercase" style="font-size:5rem">your orders</p>
</section>

<section class="placed-orders">

   <div class="box-container">

   <div class="row">
      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box col-12 mb-5">
         
      
      <div class="row">
         <div class="col-sm">
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span>
      <br>name : <span><?php echo $fetch_orders['name']; ?></span>
      <br>number : <span><?php echo $fetch_orders['number']; ?></span>
      <br>email : <span><?php echo $fetch_orders['email']; ?></span>
      <br>address : <span><?php echo $fetch_orders['address']; ?></span></p>

         </div>

         <div class="col-sm">

      
      <p>your orders : <span><?php echo $fetch_orders['total_products']; ?></span>
      <br>your orders : <span><?php echo $fetch_orders['total_products']; ?></span>
      <br>total price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span>
      <br>payment method : <span><?php echo $fetch_orders['method']; ?></span>
      <br>payment : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span>
      </p>
            
         </div>

      </div>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>
   </div>

</section>








<?php include 'footer_b.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>