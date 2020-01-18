<?php require_once('includes/onlinestore_header.php') ?>
<?php
//if user loggen in redirect to login_customer_details page
  if(isset($_SESSION['uid'])){
    echo '
<script>
  window.location.replace("login_customer_details.php");
</script>';
    //header("Location: login_customer_details.php");
  }
  if(isset($_SESSION['cartManager'])){
    $cartManager = $_SESSION['cartManager'];
  }else{
    // empty cart 
  }

  if(isset($_POST['login-btn'])){
    $response = array();
    $user_email=mysqli_escape_string($con, $_POST['user_email']);
  $user_pwd=mysqli_escape_string($con, $_POST['user_pswd']);
  $sql = "SELECT * FROM users WHERE uemail = '".$user_email. "' AND status = 1 AND is_active = 1";
  $result=mysqli_query($con,$sql);
  $num=mysqli_num_rows($result);
  if($num == 0)
  {
    $response['msg'] = "User Blocked By Admin";
  }
  else
  { 
    
    $row=mysqli_fetch_array($result);
    if(!password_verify($user_pwd, $row['upassword'])){
      $response['msg']='Invalid username or password';
    }else{
    $response['msg']='';
    $_SESSION['uemail'] = $row['uemail'];
    $_SESSION['uid'] = $row['uid'];
    $_SESSION['username'] = $row['uname'];
    
     echo '
<script>
  window.location.replace("login_customer_details.php");
</script>';
    //header("Location: login_customer_details.php");
    }
    
  }
  }
  if(isset($_POST['next-btn'])){
    $customerId = -1; // 0 is for guest customer
    $_SESSION['customer_name'] = "GUEST";
    $contact = mysqli_escape_string($con, $_POST['contact']);
    $shipAddress = mysqli_escape_string($con, $_POST['shipAddress']);


     //uploading image to server
    $valid = 0;
    $maxId = getMaxOrderId($con);
    $directory = 'uploads/';
    //$response = uploadImage($_FILES['cpr_copy'], $maxId+1, $directory);

    $response2 = uploadImage($_FILES['prescription'], $maxId+1, $directory);
    if($response2['success'] == true){
      //$_SESSION['cpr_copy'] = $response['path'];
      $_SESSION['prescription'] = $response2['path'];

      $_SESSION['customer_contact'] = $contact;
      $_SESSION['customer_shipAddress'] = $shipAddress; 

      echo '
<script>
  window.location.replace("order_summary.php");
</script>';

      //header("Location: order_summary.php");
    }else{
      $msg = $response2['msg'];
      $responseBack = '?valid='.$valid.'&msg='.$msg;  
       echo '
<script>
  window.location.replace("'.$responseBack.'");
</script>';
      //header("Location: ?valid=".$valid."&msg".$msg."");
    }

  }
 ?>
<div id="body">

  <div id="content">
    <br>

    <div class="content">
      <div class="container">
  <br>

        <?php 
          if(isset($_GET['msg'])){
            echo '<div class="alert alert-danger">'.$_GET['msg'].'</div>';
          }
         ?>

        <h1 class="text-center">Customer Details</h1>
        <br>

        <div class="row">
          <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
    <div>
      <h2>Member</h2>
      <br>
        <form action="customer_details.php" method="post" >
          <div class="form-group">
            <label for="user_email">Email</label>
            <input id="user_email" name="user_email" type="email" class="form-control"  required style="background: white">
          </div>
          <div class="form-group">
            <label for="user_pswd">Password</label>
            <input id="user_pswd" name="user_pswd" type="password" class="form-control" required style="background: white">
          </div>
          <button id="login-btn" name="login-btn" class="btn btn-default">Login</button>  
          <label style="padding-top: 12px;" class="pull-right" for=""> If not member yet <a style="color:#24b; " href="register.php"> <strong>REGISTER NOW!</strong></a></label>
        </form>
        <br>

        <?php
          if(isset($response['msg'])){
            echo '
            <div class="alert-danger text-center" style="padding:10px;">'.$response['msg'].'</div>
            ';
          } 
         ?>
    </div>

    </div>
  </div>
</div>


<div class="col-md-6">

  <div class="panel panel-default">
      <div class="panel-heading">
    <div>
      <h2>Guest</h2>
      <br>
        <form action="customer_details.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="contact">Contact</label>
            <input id="contact" name="contact" type="number" class="form-control" required style="background: white" >
          </div>
          <div class="form-group">
            <label for="shipAddress">Shipping Address</label>
            <textarea style="width: 100%;background: white" name="shipAddress" id="shipAddress" required></textarea>
          </div>
          <!-- <div class="form-group">
            <label for="cpr_copy">CPR Copy</label>
            <input id="cpr_copy" name="cpr_copy" type="file" class="form-control" required>
          </div> -->
          <div class="form-group">
            <label for="prescription">Doctor's Prescription</label>
            <input id="prescription" name="prescription" type="file" class="form-control" required>
          </div>

          <button id="next-btn" name="next-btn" class="btn btn-danger pull-right">Next <span class="fa fa-arrow-right"></span></button>
          <div class="clearfix"></div>
          
        </form>
    </div>

    </div>
  </div>
</div>
</div>
  </div>
    <!-- ./container -->
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
  <script src="assets/js/owl.carousel.min.js"></script>s

<script>
  $(document).ready(function(){

    $("#all_products").on("submit", 'form', function() {
            var form = $(this);
            $.ajax({
          url : form.attr('action'),
          type: form.attr('method'),
          data: form.serialize(),
          dataType: 'json',
          success:function(response) {
            $("#cart_qty").html(response.totalCartQty);
              
              $('#add-to-cart-messages').html('<div class="alert alert-success">'+
              '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
              '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
              '</div>');

              $(".alert-success").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                  $(this).remove();
                });
              }); // /.alert

          } // /success
        }); // /ajax  
      return false;
          });
  });
</script>
</body>
</html>
