<!-- <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?> -->

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo"><span class="fw-bold">Tbrand_</span></a>

      <nav class="navbar">
      <div class="nav_va">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_messages.php">feedbacks</a>
         <!-- <a href="admin_prf.php">prf</a> -->
</div>
      </nav>

      <div class="icons">
      <a href="admin_prf.php">
      <div id="user-btn" class="fas"><span><?php echo $_SESSION['admin_email']; ?></span></div>
      </a>
         
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>



   </div>

</header>