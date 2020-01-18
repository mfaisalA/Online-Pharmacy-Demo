<?php require_once('../includes/config.php'); ?>
<?php require_once('../functions.php'); ?>
<?php 

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM orders  
	WHERE order_date >= '$start_date' AND order_date <= '$end_date' and order_status = 1";
	$query = $con->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Customer Name</th>
			<th>Total Quantity</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		$totalAmount = "";
		while ($result = $query->fetch_assoc()) {
			//Query for getting Total Item from Items Table
			$qty = getOrderItemQty($con, $result['order_id']);

			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.(($result['customer_id'] == -1) ? 'Guest' :getCustomerNameFromId($con, $result['customer_id'])).'</center></td>
				<td><center>'.$qty.'</center></td>
				<td><center>'.$result['grand_total'].'</center></td>
			</tr>';	
			$totalAmount += $result['grand_total'];
		}
		$table .= '
		</tr>

		<tr>
			<th colspan="3"><center>Total Amount</center></th>
			<th><center>'.$totalAmount.'</center></th>
		</tr>
	</table>
	';	

	echo $table;

}

?>