<?php require_once 'includes/header.php'; ?>
<?php 
	$edit = null;
	$edit_id = null;
	if($_GET['edit_id']){
		$edit_id = $_GET['edit_id'];
		$selSql = "SELECT * FROM users 
		WHERE uid = $edit_id";
		$rs = mysqli_query($con, $selSql);
		$edit = mysqli_fetch_assoc($rs);
	}else{
		header('location: users.php?success=false&msg=Requested record not found !');
	}

	$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
		$valid = false;
		$msg = "Something went wrong unable to process your request!";
		$sql = "UPDATE users 
		SET uemail = '$email',  uname = '$name', 
		 ucontact = '$contact',  address = '$address',
		  cpr = '$cpr', is_active = $is_active
		WHERE uid = $edit_id ";
		if(mysqli_query($con, $sql)){
			$valid = true;
			$msg = "Record edit successfully";
		}

		header('location: users.php?success='.$valid.'&msg='.$msg);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="users.php"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Manage Customers</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-user"></span> Edit Customer</h3>
	  		<div id="errorDiv" class="col-sm-8 col-sm-offset-2">
  	<?php
                if(isset($_GET['success'])){
                    if($_GET['success'] == 1){
                        echo '
                            <div class="alert alert-success text-center">'.$_GET['msg'].'
            </div>';
                    }else{
                        echo '
            <div class="alert alert-danger text-center">'.$_GET['msg'].'
            </div>';
                    } 
                }
                 ?>
      </div>
      <div class="clearfix"></div>
	  	</div>
	  	<div class="panel-body">
	  		<br>
	  		<div class="col-sm-8"  style="padding: 10px; border-right: 1px solid #ccc;border-bottom: 1px solid #ccc">
	  			<form action="" method="post">
	  				<div class="form-group row">
                        <div class="col-sm-4"><label>User ID</label>
                       </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="user_id" name="user_id" value="<?=$edit['uid'] ?>" disabled>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="email">Email/ Username</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" id="email" name="email" value="<?=$edit['uemail'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="name">Full Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="name" name="name" value="<?=$edit['uname'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="contact">Contact</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="tel" id="contact" name="contact" value="<?=$edit['ucontact'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->

	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="address" name="address" required><?=$edit['address'] ?></textarea>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->
	  				<div class="form-group row">
                        <div class="col-sm-4">
                            <label for="cpr">CPR #</label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="cpr" name="cpr" value="<?=$edit['cpr'] ?>" required>
                        </div>
                    </div>
                    <!-- FORM-GROUP ENDS -->



                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="is_active">Customer Status</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="is_active" id="" required>
                                <option value="">--select status--</option>
                                <option value="1" <?=$edit['is_active'] ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?=$edit['is_active'] ? '' : 'selected' ?>>Blocked</option>
                            </select>
                        </div>
                    </div>

                    <div class="pull-right">
                    <button class="btn btn-primary">Submit</button>
                	</div>
	  			</form>
	  			<br>
	  		</div>
	  	</div>
	  </div>	
								
	</div>	<!--/.main-->

	<?php require_once 'includes/import_scripts.php'; ?>
	<script>
		$(document).ready(function(){
			$('#navUsers').addClass('active');
		});
	</script>
</body>

</html>
