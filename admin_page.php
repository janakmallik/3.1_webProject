<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- bootstrap 5 link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="container">

<h1 class="title"><span class="text-primary">admin </span>/ home</h1>

<div class="container overflow-auto  scrollbar scrollbar-black bordered-black square thin">
<!-- <div class="container"> -->
<table class="table">
  <thead>
    <tr class="text-uppercase"style="font-size:3rem">
      <th scope="col" >data field</th>
      <th scope="col" >amount</th>
      <!-- <th scope="col">Handle</th> -->
    </tr>
  </thead>
  <tbody style="font-size:2rem">
    <tr>
      <th scope="row">
         <span>total earnings</span>
      </th>
      <?php
               $total_completed = 0;
               $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
               if(mysqli_num_rows($select_completed) > 0){
                  while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                     $total_price = $fetch_completed['total_price'];
                     $total_completed += $total_price;
                  };
               };
            ?>
      <td>
         <span>৳<?php echo $total_completed; ?>/-</span>
      </td>
   </tr>

   <tr>
      <th scope="row">
         <span>unpaid</span>
      </th>
      <?php
               $total_pendings = 0;
               $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
               if(mysqli_num_rows($select_pending) > 0){
                  while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                     $total_price = $fetch_pendings['total_price'];
                     $total_pendings += $total_price;
                  };
               };
            ?>
      <td>
         <span>৳<?php echo $total_pendings; ?>/-</span>
      </td>
   </tr>

   <tr>
      <th scope="row">
         <span>total order</span>
      </th>
      <?php 
               $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
               $number_of_orders = mysqli_num_rows($select_orders);
            ?>
      <td>
         <span><?php echo $number_of_orders; ?></span>
      </td>
   </tr>

   <tr>
      <th scope="row">
         <span>total products</span>
      </th>
      <?php 
               $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
               $number_of_products = mysqli_num_rows($select_products);
            ?>
      <td>
         <span><?php echo $number_of_products; ?></span>
      </td>
   </tr>

   <tr>
      <th scope="row">
         <span>total customer</span>
      </th>
      <?php 
               $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
               $number_of_users = mysqli_num_rows($select_users);
            ?>
      <td>
         <span><?php echo $number_of_users; ?></span>
      </td>
   </tr>
  </tbody>
</table>
</div>
</section>










<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>