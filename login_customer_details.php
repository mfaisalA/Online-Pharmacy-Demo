<?php require_once('includes/onlinestore_header.php') ?>

<?php
  //if user not loggen in redirect to index page page
  $userInfo = array();
  if(isset($_SESSION['uid'])){
    $userId = $_SESSION['uid'];
    $sql = "SELECT uname, ucontact, address FROM users WHERE 
    uid = $userId AND status = 1";
    $result=mysqli_query($con,$sql);
    $userInfo = mysqli_fetch_assoc($result);
  }else{
    header("Location: petmart.php");
  }
  if(isset($_SESSION['cartManager'])){
    $cartManager = $_SESSION['cartManager'];
  }else{

     echo '
<script>
  window.location.replace("online-store.php");
</script>';
    //header("Location: petmart.php");
  }


  if(isset($_POST['next-btn'])){
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

      $_SESSION['customer_name'] = ucfirst(strtolower($userInfo['uname']));
      $_SESSION['customer_contact'] = $contact;
      $_SESSION['customer_shipAddress'] = $shipAddress; 


     echo '
<script>
  window.location.replace("order_summary.php");
</script>';
      //header("Location: order_summary.php");
    }else{
      $msg = $response['msg'];
      $responseLink = "?valid=".$valid."&msg".$msg."";

     echo '
<script>
  window.location.replace("'.$responseLink.'");
</script>';
      //header("Location: ?valid=".$valid."&msg".$msg."");
    }

  }
 ?>

  <div class="container">
  <br><br><br>

        <h1 class="text-center">Customer Details</h1>
        <br>

    <div class="panel panel-default">
      <div class="panel-heading">
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <br>
        <form class="form-horizontal" action="login_customer_details.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label col-sm-3" for="name">Customer Name</label>
            <div class="col-sm-9"  style="padding:0 14px; text-transform: capitalize;">
              <h4><?=$userInfo['uname'] ?></h4>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="contact">Contact</label>
            <div class="col-sm-9">
              <input id="contact" name="contact" type="tel" class="form-control" value="<?=$userInfo['ucontact'] ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="shipAddress">Shipping Address</label>
            <div class="col-sm-9">
              <textarea class="form-control col-sm-10" style="width: 100%" name="shipAddress" id="shipAddress" required><?=$userInfo['address'] ?></textarea>
            </div>
          </div>
          <!-- <div class="form-group">
            <label class="control-label col-sm-3" for="cpr_copy">CPR Copy</label>
            <div class="col-sm-9">
              <input id="cpr_copy" name="cpr_copy" type="file" class="form-control" required>
            </div>
          </div> -->

          <div class="form-group">
            <label class="control-label col-sm-3" for="prescription">Prescription</label>
            <div class="col-sm-9">
              <input id="prescription" name="prescription" type="file" class="form-control" required>
            </div>
          </div>

          <button id="next-btn" name="next-btn" class="btn btn-danger pull-right">Next <span class="fa fa-arrow-right"></span></button>
          
        </form>
    </div>

      </div>
    </div>
  </div>
  </div>
    <!-- ./container -->
<br><br><br>
<div id="footer">  
  <?php require_once('includes/footer.php'); ?>
</div>
        
</body>
</html>