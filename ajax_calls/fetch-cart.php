<?php include_once("../model/product.php"); ?>
<?php include_once("../model/manageCart.php"); ?>
<?php include_once("../includes/config.php"); ?>
<?php include_once("../includes/session.php"); ?>


<?php
$response['success'] = false;
	$response['data'] = array();

  if(isset($_SESSION['cartManager'])){
  	$cartManager = $_SESSION['cartManager'];



  	foreach ($cartManager->get_productList() as $key => $item) {
			$id = $item->get_id();
  			// DELETE BUTTON
		  	$delBtn = '<button type="button" id="delBtn" class="btn btn-danger" style="border-radius:2px;" onclick="removeProduct('.$id.')"> <span class="fa fa-trash"></span></button>';

		  	$response['data'][] = array(
		  		$item->get_id(), 		
		 		$item->get_name(),
		 		$item->get_qty(),
		 		$item->get_price(),
		 		$item->get_img(), 		
		 		$delBtn 		
		 		);
  	}


  	$response['totalCartQty'] = $cartManager->get_totalQty();
  	$response['subTotal'] = $cartManager->get_subTotal();
  	$response['grandTotal'] = $cartManager->get_grandTotal();
	$response['success'] = true;
 	$response['messages'] = "Cart Fetched Successfully";
  }

	echo json_encode($response);
 ?>