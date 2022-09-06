<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

if(isset($_GET['make_admin'])){
   $make_admin_id = $_GET['make_admin'];
   mysqli_query($conn, "UPDATE `users` SET user_type = 'admin' WHERE id = '$make_admin_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

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
   <!-- <link rel="stylesheet" href="css/style.css"> -->

   <style>
         .load_btn {
  display: inline-block;
  margin-top: 1rem;
  padding: 1rem 3rem;
  cursor: pointer;
  color: white;
  font-size: 1.8rem;
  border-radius: 0.5rem;
  text-transform: capitalize;
  background-color: green;
}

.load_btn:hover {
  color: white;
  background-color: black;
}
   </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<div class="container">
<h1 class="title mt-5"><span class="text-primary">admin </span>/ user accounts</h1>
</div>



<div class="container overflow-auto  scrollbar scrollbar-black bordered-black square thin">
<!-- <div class="container"> -->
<table class="table">
  <thead>
    <tr class="text-uppercase"style="font-size:3rem">
      <th scope="col" >id</th>
      <th scope="col" >images</th>
      <th scope="col" >price</th>
      <th scope="col">update</th>
      <th scope="col">delete</th>
      <th scope="col">make admin</th>
      <!-- <th scope="col">Handle</th> -->
    </tr>
  </thead>
  <tbody style="font-size:2rem">
  <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
    <tr>
      <th scope="row"><span><?php echo $fetch_users['id']; ?></span></th>
      <td><span><?php echo $fetch_users['name']; ?></span></td>
      <td><span><?php echo $fetch_users['email']; ?></span></td>
      <td><span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span></td>
      <td><a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a></td>
      <td><a href="admin_users.php?make_admin=<?php echo $fetch_users['id']; ?>" onclick="return confirm('make admin this user?');" class="load_btn">make admin</a></td>
    </tr>
    <?php
         };
      ?>
  </tbody>
</table>
</div>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>