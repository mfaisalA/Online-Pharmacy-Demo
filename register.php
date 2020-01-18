<?php require_once('includes/onlinestore_header.php') ?>

<?php

  $valid = 0;
  $message = "";

  if(isset($_POST['btn-register'])){
    if(isset($_POST['password'])
     && isset($_POST['fullname']) && isset($_POST['email'])){
      $password = mysqli_escape_string($con, $_POST['password']);
      $fullname = mysqli_escape_string($con, $_POST['fullname']);
      $email = mysqli_escape_string($con, $_POST['email']);
      $contact = mysqli_escape_string($con, $_POST['contact']);
      $address = mysqli_escape_string($con, $_POST['address']);
      //$cpr = mysqli_escape_string($con, $_POST['cpr']);

      $pswd_hash = password_hash($password, PASSWORD_DEFAULT);


        $sql = "INSERT INTO users ( uemail, upassword, uname,  ucontact, address, created_date) 
      VALUES ('{$email}', '{$pswd_hash}','{$fullname}','{$contact}','{$address}', NOW())";
      
      if($result = $con->query($sql)) {
        //success
        $valid = 1;
        $message = 'You have registered successfully 
        <a href="customer_details.php"> click here</a> to login';

      }else{
        //error
        $valid = 2;
        $message = "database connection failed unable to register you at the momment.";
      }

    }
  }
?>

<div class="container">
  <br><br>
  <div class="row">
    <br><br>
    <div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class="login-img"><img  src="img/logo_w_text.png" alt="" class="img-responsive logo"></div>
    <br>
    <div class="panel panel-warning">
    <div class="panel-heading">
      <form id="form-register" action="register.php" method="POST">
        <?php
          if($valid == 1){
            echo '<div class="alert alert-success text-center" style="margin:4px 0;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'.$message.'</div>';
          }
          if($valid == 2){
            echo '<div class="alert alert-danger text-center" style="margin:4px 0;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'.$message.'</div>';
          }
        ?>

        <h2 class="text-center">Registeration Form</h2>
        <div class="form-group">
        <label for="email" >Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
        <label for="password" >Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="form-group">
        </div>
        <label for="fullname">Name</label>
        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Name" required>
        </div>
        <div class="form-group">
        <label for="contact" >Contact</label>
        <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact" required>
        </div>

        <div class="form-group">
        <label for="address" class="">Address</label>
        <textarea id="address" name="address" class="form-control" required></textarea>
        </div>

        <!-- <div class="form-group">
        <label for="cpr">C.P.R #</label>
        <input type="text" id="cpr" name="cpr" class="form-control" placeholder="C.P.R #" required>
        </div> -->
        <button id="btn-register" name="btn-register" class="btn btn-lg btn-warning btn-register btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Submit</button>
      </form>
      </div>
      </div>
    </div> 
  </div>

</div> <!-- /container -->
</section>


<div id="footer">  
  <?php require_once('includes/footer.php'); ?>
</div>
 
</body>
</html>