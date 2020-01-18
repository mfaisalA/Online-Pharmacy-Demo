<?php include_once("../model/product.php"); ?>
<?php include_once("../model/manageCart.php"); ?>
<?php include_once("../includes/config.php"); ?>
<?php include_once("../includes/session.php"); ?>


<?php
$response['success'] = array('success' => false, 'messages' => array(), 'totalCartQty' => '0');

  $product_id = null; 
  if(isset($_POST['product_id'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['name'];
    $product_qty = $_POST['qty_value'];
    $product_price = $_POST['price'];
    $product_image = $_POST['image'];
  }else{
  	//redirect to error page
  }

  if(!isset($_SESSION['cartManager'])){
  	//Initialize cart
  	$_SESSION['cartManager'] = new CartManager();
  }

  $cartManager = $_SESSION['cartManager'];


  $cartManager->addProduct(new Product($product_id,$product_name,$product_qty,$product_price,$product_image));

  $response['totalCartQty'] = $cartManager->get_totalQty();
	//$response['success'] = false;
 	$response['messages'] = "Product: ".$product_name . " added to the cart";

	echo json_encode($response);
 ?>