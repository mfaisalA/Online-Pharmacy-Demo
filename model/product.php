<?php 
	class Product {		
		private $id;
		private $name;
		private $qty;
		private $price;
		private $img;

		function __construct($new_id, $new_name, $new_qty, $new_price, $new_img ) {
			$this->id = $new_id;
			$this->name = $new_name;
			$this->qty = $new_qty;
			$this->price = $new_price;
			$this->img = $new_img;			
		}


		function set_id($new_id) { 
			$this->id = $new_id;  
 		}
 
   		function get_id() {
			return $this->id;
		}

		function set_name($new_name) { 
			$this->name = $new_name;  
 		}
 
   		function get_name() {
			return $this->name;
		}
		function set_qty($new_qty) { 
			$this->qty = $new_qty;  
 		}
 
   		function get_qty() {
			return $this->qty;
		}

		function set_price($new_price) { 
			$this->price = $new_price;  
 		}
 
   		function get_price() {
			return $this->price;
		}

		function set_img($new_img) { 
			$this->img = $new_img;  
 		}
 
   		function get_img() {
			return $this->img;
		}
	} 
?>