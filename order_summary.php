<?php require_once('includes/onlinestore_header.php') ?>

<?php
  if(isset($_SESSION['cartManager'])){
    $cartManager = $_SESSION['cartManager'];
  }else{
     echo '
<script>
  window.location.replace("online-store.php");
</script>';
    //header("Location: petmart.php");
  }

  $message = "";

  if(isset($_POST['confirm-order-btn'])){
    $respond = array();
    $orderType = mysqli_escape_string($con, $_POST['order_type']);
    $paymentType = mysqli_escape_string($con, $_POST['payment_type']);

    if(isset($_SESSION['customer_name']) && isset($_SESSION['customer_contact']) && isset($_SESSION['customer_shipAddress']) ){

      if(isset($_SESSION['uid'])){
        $customerId = $_SESSION['uid'];
      }else{
        $customerId = -1; // -1 is for guest customer
      }

      //$customerName = $_SESSION['customer_name'];
      $contact = $_SESSION['customer_contact'];
      $shipAddress = $_SESSION['customer_shipAddress'];

      //$cpr_copy = $_SESSION['cpr_copy'];
      $prescription = $_SESSION['prescription'];

      // PaymentType Cash
        if($paymentType == 1){
          $respond = $cartManager->postOrder($con, $customerId, $orderType, $paymentType,  $contact, $shipAddress, $prescription);
          if($respond['success'] == true){

          }
        } 

      // PaymentType CreditCard
      if($paymentType == 2){
          
          $totalAmount = $cartManager->get_grandTotal();

          $respond = $cartManager->postOrder($con, $customerId, $orderType, $paymentType,  $contact, $shipAddress, $prescription);
          if($respond['success'] == true){

          }
      }

      if($respond['success'] == true){
        $responseLink = 'order_success.php?order_id='.$respond['order_id'];
         echo '
<script>
  window.location.replace("'.$responseLink.'");
</script>';
        //header("Location: order_success.php?order_id=".$respond['order_id']);
      }else{
         echo '
<script>
  window.location.replace("order_error.php");
</script>';
        //header("Location: order_error.php");
      }

      $_SESSION['cartManager'] = NULL;
      $_SESSION['customer_name'] = NULL;
      $_SESSION['customer_contact'] = NULL;
      $_SESSION['customer_shipAddress'] = NULL;
      //$_SESSION['cpr_copy'] = NULL;
      $_SESSION['prescription'] = NULL;

    }else{
      $message = "SESSION EXPIRED";
    }
  }
 ?>

  <div class="container">
  <br><br><br>

        <h1 class="text-center">Order Summary</h1>

      <br>  
      <div class="col-sm-6 col-sm-offset-3" id="error_msg"></div>
      <br>
      <div class="clearfix"></div>

    <div class="panel panel-warning" style="border:#aaa; margin: 10px 50px;">
      <div class="panel-heading" style="background:#eee; padding: 20px;" >
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>PRODUCT NAME</th>
              <th>UNIT PRICE (BD)</th>
              <th>QUANTITY</th>
              <th>TOTAL (BD)</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach ($cartManager->get_productList() as $key => $item) {
              echo '
              <tr>
                <td>'. $item->get_name().'</td>
                <td>'. number_format($item->get_price(), 3).'</td>
                <td>'. $item->get_qty().'</td>
                <td>'. number_format(($item->get_price()*$item->get_qty()), 3).'</td>
              </tr>
              ';
            } 
           ?>
                <tr><th colspan="3">SUB TOTAL (BD)</th><th><?=number_format($cartManager->get_subTotal(), 3) ?></th></tr>
                <tr id="deliveryChargesRow"><th colspan="3">Delivery Charges (BD)</th><th id="delivery_charges"><?=number_format(0.5, 3) ?></th>
                </tr>
                <tr><th colspan="3">GRAND TOTAL (BD)</th><th id="grandTotal"></th></tr>
                <input type="hidden" id="subTotalHidden" value="<?php echo $cartManager->get_subTotal(); ?>">
              </tbody>
            </table>

          <div class="row">
          <div class="col-md-8">
            <table class="table table-bordered  table-striped">
              <tbody>
                <tr>
                  <th>Customer Name</th><td style="text-transform: capitalize;"><?=$_SESSION['customer_name'] ?></td>
                </tr>
                <tr>
                  <th>Contact #</th><td><?=$_SESSION['customer_contact'] ?></td>
                </tr>
                <tr>
                  <th>Shipping Address</th><td><?=$_SESSION['customer_shipAddress'] ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-4">
            <div>
            <form action="order_summary.php" method="post">
            <div class="form-group"  >
            <label for="order_type" class="col-2 col-form-label">Order Type</label>
            <div class="col-10">
              <select class="form-control" name="order_type" id="order_type">
                <option value="2"> Pickup</option>
                <option value="1"> Delivery</option>
              </select>
            </div>
            </div>
            <div class="form-group" >
            <label for="payment_type" class="col-2 col-form-label">Payment Type</label>
            <div class="col-10">
              <select class="form-control" name="payment_type" id="payment_type" required>
                <option value="1"> Cash on delivery</option>
                <!-- <option value="2"> Credit Card</option>      -->           
              </select>

                
            </div>
            </div>
            <div>
            <button id="confirm-order-btn" name="confirm-order-btn" class="btn btn-danger btn-block" ><span class="fa fa-check"></span> CONFIRM ORDER</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
    <!-- ./container -->
<br><br>
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
      <script type="text/javascript">
        $('#order_type').on('change', function(){
          if($(this).val() == 1){
          $('#deliveryChargesRow').show();
             var deliveryCharges = 0.5;
            var subTotal = $('#subTotalHidden').val();
            subTotal = parseFloat(subTotal);
            var grandTotal = subTotal + deliveryCharges;
            $('#grandTotal').html(grandTotal.toFixed(3));
          }else{

          $('#deliveryChargesRow').hide();
            var subTotal = $('#subTotalHidden').val();
            subTotal = parseFloat(subTotal);
            var grandTotal = subTotal;
            $('#grandTotal').html(grandTotal.toFixed(3));
          }
         

          });
        $(document).ready(function() {
          $('#deliveryChargesRow').hide();
            var subTotal = $('#subTotalHidden').val();
            subTotal = parseFloat(subTotal);
            var grandTotal = subTotal;
            $('#grandTotal').html(grandTotal.toFixed(3));
          
          $('form').on('submit', function(){
            var pType = $('#payment_type').val();
            //validate balance only if payment type 3 = Website Balance
            if(pType == 3){
              var cur_bal = $('#available_balance').val();
              var order_amt = $('#order_amt').val();

              cur_bal = parseFloat(cur_bal);
              order_amt = parseFloat(order_amt);
              if(order_amt > cur_bal){
                var responseHtml = '<div class="alert alert-danger text-center"><strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> Insufficient funds to place this order</div>';
              $('#error_msg').html(responseHtml);
              $(".alert").delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                      $(this).remove();
                    });
                  }); // /.alert
                return false;
              }
            }
            
          });
                    
          });

      </script>
</body>
</html>