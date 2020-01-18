<?php include_once("../model/product.php"); ?>
<?php include_once("../model/manageCart.php"); ?>
<?php include_once("../includes/config.php"); ?>
<?php include_once("../includes/session.php"); ?>


<?php
$response['success'] = array('success' => false, 'messages' => array(),);

  $product_id = null; 
  if(isset($_POST['productId'])){
    $product_id = $_POST['productId'];
    $qty = $_POST['qty'];

  }else{
  	//redirect to error page
  }

  $cartManager = $_SESSION['cartManager'];


  $cartManager->updateQty($product_id, $qty);

	$response['success'] = true;
 	// $response['messages'] = "Product: ".$product_name . " added to the cart";

	echo json_encode($response);
 ?>