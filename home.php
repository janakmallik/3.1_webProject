<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message = "already added to cart!";
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message = "product added to cart!";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- bootstrap 5 link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">



</head>
<body>
   
<?php include 'header.php'; ?>

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

<section class="my-5">
        <p class=" text-center fw-bold text-uppercase" style="font-size:5rem">HAVE ALL NEW T-shirt with<BR>
            AMAZING OFFERS ONLY AT <text class="text-secondary">T<span class="text-lowercase">brand<span class="blink">_</span>.com</span></text></p>
            <!-- <div class="d-grid gap-2 row-cols-md-2 col-2 mx-auto"> -->
            <p class="text-center" style="font-size:3rem"><a href="shop.php"><button class="sp_nw text-uppercase me-2" type="button">shop all now</button></a>
</p>
            <!-- </div> -->
</section>

<!-- <section class="home">

   <div class="content">
      <h3>Hand Picked Book to your door.</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quod? Reiciendis ut porro iste totam.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section> -->

<?php include 'slide.php'; ?>



<section class="products">

   <!-- <h1 class="title">latest products</h1> -->

   <div class="container mt-5 mb-4 d-flex justify-content-between" >
      <h1 class="text-black fw-bold" style="font-size:4rem">All latest products</h1>
      <a href="shop.php" class="load_btn" >more</a>
    </div>

      <div class="container overflow-auto  scrollbar scrollbar-black bordered-black square thin">
         <div class="row" style="width: 1800px">
            <div class="box-container">

               <?php  
               // WHERE name LIKE '%shoe%'
                  $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 7") or die('query failed');
                  if(mysqli_num_rows($select_products) > 0){
                     while($fetch_products = mysqli_fetch_assoc($select_products)){
               ?>
                  <form action="" method="post" class="box product">
                     <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                     <div class="name fw-bold"><?php echo $fetch_products['name']; ?></div>

                     <!-- <div class="name">৳ php for price /-</div> -->

                     <div class="container mt-1 mb-4 d-flex justify-content-between">
                        <text class="pr_am">
                        ৳ <?php echo $fetch_products['price']; ?>/-
                        </text>

                        <input type="number" min="1" name="product_quantity" value="1" class="qtyb">
                     </div>
                     <!-- <div class="price">$<?php echo $fetch_products['price']; ?>/-</div> -->
                     <!-- <input type="number" min="1" name="product_quantity" value="1" class="qty"> -->
                     <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                     <input type="submit" value="add to cart" name="add_to_cart" class="load_btn buy-btn">
                  </form>
                  <?php
                     }
                  }else{
                     echo '<p class="empty">no products added yet!</p>';
                  }
                  ?>
               </div>
            </div>
         </div>
</section>

<section class="products">

   <!-- <h1 class="title">latest products</h1> -->

   <div class="container mt-5 mb-4 d-flex justify-content-between" >
      <h1 class="text-black fw-bold" style="font-size:4rem">latest T-shirts</h1>
      <a href="tshirts.php" class="load_btn" >more</a>
    </div>

      <div class="container overflow-auto  scrollbar scrollbar-black bordered-black square thin">
         <div class="row" style="width: 1800px">
            <div class="box-container">

               <?php  
               // WHERE name LIKE '%shoe%'
                  $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%t-shirt%' LIMIT 7") or die('query failed');
                  if(mysqli_num_rows($select_products) > 0){
                     while($fetch_products = mysqli_fetch_assoc($select_products)){
               ?>
                  <form action="" method="post" class="box product">
                     <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                     <div class="name fw-bold"><?php echo $fetch_products['name']; ?></div>

                     <!-- <div class="name">৳ php for price /-</div> -->

                     <div class="container mt-1 mb-4 d-flex justify-content-between">
                        <text class="pr_am">
                        ৳ <?php echo $fetch_products['price']; ?>/-
                        </text>

                        <input type="number" min="1" name="product_quantity" value="1" class="qtyb">
                     </div>
                     <!-- <div class="price">$<?php echo $fetch_products['price']; ?>/-</div> -->
                     <!-- <input type="number" min="1" name="product_quantity" value="1" class="qty"> -->
                     <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                     <input type="submit" value="add to cart" name="add_to_cart" class="load_btn buy-btn">
                  </form>
                  <?php
                     }
                  }else{
                     echo '<p class="empty">no products added yet!</p>';
                  }
                  ?>
               </div>
            </div>
         </div>
</section>

<section class="products">

   <!-- <h1 class="title">latest products</h1> -->

   <div class="container mt-5 mb-4 d-flex justify-content-between" >
      <h1 class="text-black fw-bold" style="font-size:4rem">latest jeans</h1>
      <a href="jeans.php" class="load_btn" >more</a>
    </div>

      <div class="container overflow-auto  scrollbar scrollbar-black bordered-black square thin">
         <div class="row" style="width: 1800px">
            <div class="box-container">

               <?php  
               // WHERE name LIKE '%shoe%'
                  $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%jean%' LIMIT 7") or die('query failed');
                  if(mysqli_num_rows($select_products) > 0){
                     while($fetch_products = mysqli_fetch_assoc($select_products)){
               ?>
                  <form action="" method="post" class="box product">
                     <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                     <div class="name fw-bold"><?php echo $fetch_products['name']; ?></div>

                     <!-- <div class="name">৳ php for price /-</div> -->

                     <div class="container mt-1 mb-4 d-flex justify-content-between">
                        <text class="pr_am">
                        ৳ <?php echo $fetch_products['price']; ?>/-
                        </text>

                        <input type="number" min="1" name="product_quantity" value="1" class="qtyb">
                     </div>
                     <!-- <div class="price">$<?php echo $fetch_products['price']; ?>/-</div> -->
                     <!-- <input type="number" min="1" name="product_quantity" value="1" class="qty"> -->
                     <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                     <input type="submit" value="add to cart" name="add_to_cart" class="load_btn buy-btn">
                  </form>
                  <?php
                     }
                  }else{
                     echo '<p class="empty">no products added yet!</p>';
                  }
                  ?>
               </div>
            </div>
         </div>
</section>

<section class="products">

   <!-- <h1 class="title">latest products</h1> -->

   <div class="container mt-5 mb-4 d-flex justify-content-between" >
      <h1 class="text-black fw-bold" style="font-size:4rem">latest shoes</h1>
      <a href="shoes.php" class="load_btn" >more</a>
    </div>

      <div class="container overflow-auto  scrollbar scrollbar-black bordered-black square thin">
         <div class="row" style="width: 1800px">
            <div class="box-container">

               <?php  
               // WHERE name LIKE '%shoe%'
                  $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%shoe%' LIMIT 7") or die('query failed');
                  if(mysqli_num_rows($select_products) > 0){
                     while($fetch_products = mysqli_fetch_assoc($select_products)){
               ?>
                  <form action="" method="post" class="box product">
                     <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                     <div class="name fw-bold"><?php echo $fetch_products['name']; ?></div>

                     <!-- <div class="name">৳ php for price /-</div> -->

                     <div class="container mt-1 mb-4 d-flex justify-content-between">
                        <text class="pr_am">
                        ৳ <?php echo $fetch_products['price']; ?>/-
                        </text>

                        <input type="number" min="1" name="product_quantity" value="1" class="qtyb">
                     </div>
                     <!-- <div class="price">$<?php echo $fetch_products['price']; ?>/-</div> -->
                     <!-- <input type="number" min="1" name="product_quantity" value="1" class="qty"> -->
                     <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                     <input type="submit" value="add to cart" name="add_to_cart" class="load_btn buy-btn">
                  </form>
                  <?php
                     }
                  }else{
                     echo '<p class="empty">no products added yet!</p>';
                  }
                  ?>
               </div>
            </div>
         </div>
</section>

<?php include 'insta.php'; ?>
<script async src="//www.instagram.com/embed.js"></script>

<section class="full_pan">

   <div class="content">
      <h3 class="text-uppercase">give us a feedback</h3>
      <p>We are working on giving the best service at our clothing store. You can help us by providing your true and any suggestions.</p>
      <a href="feedback.php" class="white-btn text-uppercase">feedback</a>
   </div>

</section>





<?php include 'footer_b.php'; ?>


<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>