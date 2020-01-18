
<?php require_once('includes/onlinestore_header.php') ?>
<?php

  if(isset($_SESSION['cartManager'])){
    $cartManager = $_SESSION['cartManager'];
  }else{
    // empty cart
  }
 ?>

<div id="body">

  <div id="content">
    <br><br>

    <div class="content">
      <div class="container">
      <div class="row">
      <div class="col-md-3">
        <br><br><br><br><br>
        <div>
          <a href="online-store.php?cat_id=0" class="list-group-item text-center" style="font-weight: 700; background: #A51D23; color: white"> All Categories
          </a>
        </div>
        <br>

      <?php
      $sqlCat = "SELECT id, category_name, label_color
              FROM product_categories
              WHERE status = 1 AND is_active = 1
              ORDER BY category_name";
              $resultCat=mysqli_query($con,$sqlCat);
              //start category while
              while ($cat = mysqli_fetch_assoc($resultCat)) {
                $numOfProds = getNumOfProdInCat($con, $cat['id']);
                ?>
                
                <div>
                    <a href="online-store.php?cat_id=<?=$cat['id']  ?>" class="list-group-item" style="margin: 2px; font-weight: 700;border-radius: 0px; color:#866"><?=ucfirst($cat['category_name'])  ?> <span class="label <?=qty_label_color($numOfProds) ?> pull-right" style="padding: 4px 14px"><?=$numOfProds ?></span>
                    </a>
                </div>
                <!-- /.div -->
                <?php }// end category while 
                ?>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
      <!-- page content -->
        <h1 class="text-center">Shopping Cart</h1>
        <br>
        <div id="cart-table-html">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>IMAGE</th>
              <th>PRODUCT NAME</th>
              <th>UNIT PRICE (BD)</th>
              <th>TOTAL (BD)</th>
              <th>QUANTITY</th>
              <th>REMOVE</th>
            </tr>
          </thead>
          <tbody id="cart-items-table">
          </tbody>
        </table>
        <br>
        <table class="table table-bordered pull-right" style="width: 300px">
          <tbody>
            <tr><th>Sub Total (BD)</th><td id="sub-total"></td></tr>
            <tr><th>Grand Total (BD)</th><td id="grand-total"></td></tr>
          </tbody>
        </table>

        <div class="clearfix"></div>
        <a href="customer_details.php" class="btn btn-success pull-right"><span class="fa fa-check"></span> CHECKOUT</a> 
        <a href="e-store.php" class="btn btn-default"><span class="fa fa-arrow-left"></span> CONTINUE SHOPPING</a>
        

        </div>
      </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <br><br><br>  
</div>
<div id="footer">  
  <?php require_once('includes/footer.php'); ?>
</div>

    <script src="js/vendor/jquery-1.11.2.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/vendor/jquery.jcarousel.js"></script>
    <script src="js/vendor/jquery.jcarousel-autoscroll.js"></script>
    <script src="js/vendor/main.js"></script>
  
  <script src="assets/js/owl.carousel.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>

<script>
  $(document).ready(function(){
    $('#navPetmart').addClass('active');

    fetchCartData();

  });

  function fetchCartData(){
            
          $.ajax({
          url : 'ajax_calls/fetch-cart.php',
          type: 'GET',
          dataType: 'json',
          success:function(response) {
            var cartHtml = "";
            if(response.data.length > 0){
              $.each(response.data, function(key, item){
                productId = item[0];
                var productImg = item[4];
                var productName = item[1];
                var productQty = item[2];
                var productPrice = parseFloat( item[3]).toFixed(3);
                var productTotal = parseFloat( item[3]*item[2]).toFixed(3);
                var deleteBtn = item[5];

                var qtyInput = '<input id="qtyInput" class="form-control text-center" style="width:50px;" id="qty_value" name="qty_value" value="'+productQty+'"><input type="hidden" id="productId" value="'+productId+'">'
              cartHtml +='<tr><td><img src="productImage/'+productImg+'" style="width:50px"/></td><td>'+productName+'</td><td>'+productPrice+'</td><td>'+productTotal+'</td><td>'+qtyInput+'</td><td>'+deleteBtn+'</td></tr>';
            });
            $("#cart-items-table").html(cartHtml);

            $("#sub-total").html(response.subTotal.toFixed(3));
            $("#grand-total").html(response.grandTotal.toFixed(3));

            // event binding for updateQty function
            $('#cart-items-table').on('keyup', '#qtyInput', function(){
                var pId = $(this).siblings("#productId").val();
                var qty = $(this).val();
                updateQty(pId, qty);
            });
          }else{
            cartHtml = '<div class="text-center"> <h4> Your Cart is Empty</h4></div>';
              $("#cart-table-html").html(cartHtml);
            }
            
            
            $("#cart_qty").html(response.totalCartQty);
          } // /success
        }); // /ajax

          }


          function updateQty(productId, qty){
            $.ajax({
          url : 'ajax_calls/updateProductQty.php',
          type: 'POST',
          data: {productId: productId, qty: qty },
          dataType: 'json',
          success:function(response) {
            fetchCartData();
          } // /success
        }); // /ajax
          }

          function removeProduct(productId){
          $.ajax({
          url : 'ajax_calls/delete-from-cart.php',
          type: 'GET',
          data: {productId: productId},
          dataType: 'json',
          success:function(response) {
            fetchCartData();
          } // /success
        }); // /ajax
          }
</script>
</body>
</html>
