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
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
   <!-- custom admin css file link  -->
   <!-- <link rel="stylesheet" href="css/admin_style.css"> -->
   <link rel="stylesheet" href="css/style.css">

   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style>
    .messages .box-container {
  /* display: grid; */
  grid-template-columns: repeat(auto-fit, 35rem);
  justify-content: center;
  gap: 1.5rem;
  /* max-width: 1200px; */
  margin: 0 auto;
  align-items: flex-start;
}

.messages .box-container .box {
  background-color: var(--white);
  padding: 2rem;
  /* border: var(--border); */
  box-shadow: var(--box-shadow);
  border-radius: 0.5rem;
}

.messages .box-container .box p {
  padding-bottom: 1.5rem;
  font-size: 2rem;
  color: var(--light-color);
  line-height: 1.5;
}

.messages .box-container .box p span {
  color: black;
}

.messages .box-container .box .delete-btn {
  margin-top: 0;
}

.dlt-btn{
   background-color: red;
   display: inline-block;
   margin-top: 1rem;
   padding: 0.8rem 3rem;
   cursor: pointer;
   color: white;
   font-size: 1.8rem;
   border-radius: 0.5rem;
   text-transform: capitalize;
}

.dlt-btn:hover {
   background-color: black;
   color: white;
 }
</style>

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="container messages">

   <!-- <h1 class="title"> messages </h1> -->
   <h1 class="title">Your Profile</h1>

   <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>

   <div class="box-container">
   <div class="box" style="width:50%">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span>
            <br>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="dlt-btn">logout</a>
   </div>
   
   </div>
   <div class="temp_view ms-auto mt-5" style="text-align: center">
         <p class="fs-2 text-center" style="text-align: center;"> for another account <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>

</section>


<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>
</body>
</html>



