<?php require_once 'includes/header.php'; ?>
<?php 
	$userRs = mysqli_query($con, "SELECT uid FROM users 
	WHERE status = 1");
	$numUsers = mysqli_num_rows($userRs);

	$petRs = mysqli_query($con, "SELECT id FROM products 
	WHERE status = 1");
	$numPet = mysqli_num_rows($petRs);

	$orderRs = mysqli_query($con, "SELECT order_id FROM orders 
	WHERE order_status = 1");
	$numOrders = mysqli_num_rows($orderRs);

	$orderPenRs = mysqli_query($con, "SELECT order_id FROM orders 
	WHERE process_status = 1 AND order_status = 1");
	$numOrdersPen = mysqli_num_rows($orderPenRs);

	$pendingPercentage = ($numOrdersPen/$numOrders) * 100;

	$orderCompRs = mysqli_query($con, "SELECT order_id FROM orders 
	WHERE process_status = 2 AND order_status = 1");
	$numOrdersComp = mysqli_num_rows($orderCompRs);

	$completedPercentage = ($numOrdersComp/$numOrders) * 100;

	$orderCanRs = mysqli_query($con, "SELECT order_id FROM orders 
	WHERE process_status = 3 AND order_status = 1");
	$numOrdersCan = mysqli_num_rows($orderCanRs);

	$canceledPercentage = ($numOrdersCan/$numOrders) * 100;
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<span style="font-size: 3em" class="glyphicon glyphicon-shopping-cart"></span>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$numOrders ?></div>
							<div class="text-muted">Total Orders</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<span style="font-size: 3em" class="glyphicon glyphicon-leaf"></span>

						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$numPet ?></div>
							<div class="text-muted">Total Products</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=$numUsers ?></div>
							<div class="text-muted">Total Customers</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?=getSiteVisits($con) ?></div>
							<div class="text-muted">Site Views</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<br>
		
		<div class="row">
			<div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Pending Orders</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent"><?php echo number_format($pendingPercentage, 2); ?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Completed Orders</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent"><?php echo number_format($completedPercentage, 2); ?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Canceled Orders</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent"><?php echo number_format($canceledPercentage, 2); ?>%</span>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
								
	</div>	<!--/.main-->

	<?php require_once 'includes/import_scripts.php'; ?>
	<script>
		$(document).ready(function(){
			$('#navDashboard').addClass('active');
		});
	</script>
</body>

</html>
