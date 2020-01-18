<?php require_once('includes/onlinestore_header.php') ?>
  <div class="container">
  <br>

    <div class="panel panel-success" style="border:#aaa; margin: 10px 50px; margin:10% 10px; ">
      <div class="panel-heading" style="background:#eee; padding: 20px;" >
        <div class="text-center">
          <h3>Your Order Has Been Taken Successfully.</h3>
          <h3>Order ID: <?=str_pad($_GET['order_id'],6,"0",STR_PAD_LEFT)?></h3>
        </div>
    </div>
  </div>
  </div>
    <!-- ./container -->

<br><br><br><br><br>
<div id="footer">  
  <?php require_once('includes/footer.php'); ?>
</div>
        
</body>
</html>