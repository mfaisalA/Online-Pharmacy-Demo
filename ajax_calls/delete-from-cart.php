<?php include_once("../model/product.php"); ?>
<?php include_once("../model/manageCart.php"); ?>
<?php include_once("../includes/config.php"); ?>
<?php include_once("../includes/session.php"); ?>


<?php
$response['success'] = array('success' => false, 'messages' => array(),);

  $product_id = null; 
  if(isset($_GET['productId'])){
    $product_id = $_GET['productId'];

  }else{
  	//redirect to error page
  }

  $cartManager = $_SESSION['cartManager'];


  $cartManager->deleteProduct($product_id);

	//$response['success'] = false;
 	// $response['messages'] = "Product: ".$product_name . " added to the cart";

	echo json_encode($response);
 ?>