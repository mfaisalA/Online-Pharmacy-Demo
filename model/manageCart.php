<?php 
	class CartManager {		
		private $productList;
		private $discount;
		private $totalQty;	
		private $subTotal;	
		private $grandTotal;

		function __construct() {
			$this->productList = array();
			$this->discount = 0;
			$this->totalQty = 0;
			$this->subTotal = 0;
			$this->grandTotal = 0;			
		}

		function set_productList($new_list) { 
			$this->productList = $new_list;  
 		}
   		function get_productList() {
			return $this->productList;
		}

		function set_discount($new_discount) { 
			$this->discount = $new_discount;  
 		}
 
   		function get_discount() {
			return $this->discount;
		}

		function set_totalQty($new_totalQty) { 
			$this->totalQty = $new_totalQty;  
 		}
   		function get_totalQty() {
   			$this->totalQty = 0;
   			// calculate total qty
   			foreach ($this->productList as $key => $item) {
		 		$this->totalQty +=  $item->get_qty();
			}
			return $this->totalQty;
		}

		function set_subTotal($new_subTotal) { 
			$this->subTotal = $new_subTotal;  
 		}
   		function get_subTotal() {
   			$this->subTotal = 0;
   			// calculate subtotal
   			foreach ($this->productList as $key => $item) {
		 		$this->subTotal +=  $item->get_qty()*$item->get_price();
			}
			return $this->subTotal;
		}

		function set_grandTotal($new_grandTotal) { 
			$this->grandTotal = $new_grandTotal;  
 		}
   		function get_grandTotal() {
   			if($this->discount != 0){
				return ($this->discount / 100.0) * $this->subTotal;
   			}else{
   				return $this->subTotal;
   			}
		}

		function updateQty($id, $new_qty){
			$this->productList[$id]->set_qty($new_qty);
		}

		function addQty($id, $qty){
			$product = $this->productList[$id];
			$oldQty = $product->get_qty();
			$new_qty = $oldQty + $qty;
			$this->productList[$id]->set_qty($new_qty);
		}

		function subQty($id, $qty){
			$product = $this->productList[$id];
			$oldQty = $product->get_qty();
			$new_qty = $oldQty - $qty;
			$this->productList[$id]->set_qty($new_qty);
		}


		function addProduct($new_product){
			$id = $new_product->get_id();
			if(!array_key_exists($id, $this->productList)){
				$this->productList[$id] = $new_product;
			}else{
				$oldQty = $this->productList[$id]->get_qty();
				$qty = $new_product->get_qty();
				$this->updateQty($id, $oldQty+$qty);
			}
		}

		function deleteProduct($id){
			$product = $this->productList[$id];
			unset($this->productList[$id]);			
		}

		function postOrder($con, $customerId, $orderType, $paymentType, $contact, $shipAddress, $prescription){
			$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');

			$subTotal = $this->get_subTotal();
			$discount = $this->get_discount();
			$totalQty = $this->get_totalQty();

			if($orderType == 1){//delivery add delivery charges
				$grandTotal = $this->get_grandTotal()+0.5;
			}else{
				$grandTotal = $this->get_grandTotal();
			}

			$sql = "INSERT INTO orders (order_date, customer_id, sub_total, discount,  grand_total, total_qty, payment_type, order_type, process_status, customer_contact, customer_ship_address,  prescription, order_status) VALUES (now(), $customerId, '$subTotal', '$discount', '$grandTotal', $totalQty, $paymentType, $orderType, 1, '$contact', '$shipAddress', '$prescription',  1)";

				$order_id;
				$orderPosted = false;
				if(mysqli_query($con, $sql) === true) {
					$order_id = $con->insert_id;
					$valid['order_id'] = $order_id;	

					$orderPosted = true;
				}

				if($orderPosted == true){
					foreach ($this->get_productList
					() as $key => $item) {			
				$updateProductQuantitySql = "SELECT products.qty FROM products WHERE products.id = ".$item->get_id()."";
				$updateProductQuantityData = $con->query($updateProductQuantitySql);
		
		
				while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {

					$updatedQuantity = $updateProductQuantityResult[0] - $item->get_qty();							
						// update product table
						$updateProductTable = "UPDATE products SET qty = '".$updatedQuantity."' WHERE id = ".$item->get_id()."";
						$con->query($updateProductTable);

						// add into order_item
						$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
						VALUES ('$order_id', '".$item->get_id()."', '".$item->get_qty()."', '".$item->get_price()."', '".($item->get_qty()*$item->get_price())."', 1)";

						$con->query($orderItemSql);		
		
				} // while	
			} // /foreach
			$valid['success'] = true;
			$valid['messages'] = "Your order has been taken successfully";
		}// if
		else{
			$valid['success'] = false;
			$valid['messages'] = "Some error occurred while taking your order";
		}

		//$con->close();
		return $valid;
		}

	}
?>