
<?php if(isset($message)) { ?>
<script>
$( document ).ready(function() {
    $('#exampleModal').modal('show')  
});
</script>
<?php } ?>





<header class="header sticky-top">



   <div class="header-2 sticky-top">
      <div class="flex sticky-top">
         <a href="home.php" class="logo"><span class="fw-bold text-black">Tbrand_</span></a>

         <nav class="navbar sticky-top">
            <div class="nav_va sticky-top">
            <a href="home.php">home</a>
            
            <a href="shop.php">shop all</a>
            <a href="tshirts.php">t-shirts</a>
            <a href="jeans.php">jeans</a>
            <a href="shoes.php">shoes</a>
            <a href="feedback.php">feedback us</a>
            <a href="orders.php">orders</a>  
            
            </div>
            
         </nav>

         <div class="icons">
            
            <a href="search_page.php" class="fas fa-search"></a>
            <a href="user_prf.php"><div id="user-btn" class="fas"><span><?php echo $_SESSION['user_name']; ?></span></div></a>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"><span class="position-absolute top-5 start-110 translate-middle badge rounded-pill bg-warning text-dark" style="font-size:50%"><?php if ($cart_rows_number > "0") { echo $cart_rows_number;} ?></span></i> </a>
            <div id="menu-btn" class="fas fa-bars"></div>
         </div>
         


      </div>
   </div>

</header>