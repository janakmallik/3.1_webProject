<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = "user";

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $message = "Invalid email format"; }
   elseif(mysqli_num_rows($select_users) > 0){
      $message="user already exist!";
   }else{
      if($pass != $cpass){
         $message="confirm password not matched!";
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message="registered successfully!";
         header('location:login.php');
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
   <title>register</title>

   <!-- bootstrap 5 link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>



<?php if(isset($message)) { ?>
<script>
$( document ).ready(function() {
    $('#exampleModal').modal('show')  
});
</script>
<?php } ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body my-5">
      <h1>
        <?php echo "<span>" . $message . "</span>"; ?>
      </h1>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<div class="container log_pg pb-5 mb-5" style="margin-top:100px;">
<div class="row">
    <div class="col-sm">
    <section class="container mt-5 pt-5">
        <!-- <h1 class="text-center">Brand.</h1> -->
        <h1 class="display-1 text-center text-black fw-bolder mt-5 pt-5" style="font-size:800%;">
         Tbrand<span class="blink">_</span>
        </h1>
        <!-- <p style="font-size:200%">Brand. is one of the unique online shopping sites in Bangladesh where fashion is accessible to all. You can get your hands on the trendiest style every season and also avail the best of ethnic fashion during all bengali festive occasions in unbelievably affordable range.</p> -->

      </section>
    </div>
    <div class="col-sm">
    <div class="form-container">

<form action="" method="post">
   <h3>register now</h3>
   <input type="text" name="name" placeholder="enter your name" required class="box">
   <input  name="email" placeholder="enter your email" required class="box">
   <input type="password" name="password" placeholder="enter your password" required class="box">
   <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
   <!-- <select name="user_type" class="box">
      <option value="user">user</option>
      <option value="admin">admin</option>
   </select> -->
   <input type="submit" name="submit" value="register now" class="load_btn">
   <p>already have an account? <a href="login.php">login now</a></p>
</form>

</div>
    </div>
  </div>
</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>