<?php require_once '../includes/config.php'; ?>
<?php require_once 'includes/session.php'; ?>
<?php require_once '../functions.php'; ?>
<?php require_once '../chatbox/connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - <?=constant("SYSTEM_NAME") ?></title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<style>
      body {
        font-family:"Tahoma",Arial Narrow;
        font-size: 12px;
      }
      .holder {
        padding:3px;
        margin-left:auto;
        margin-right:auto;
        margin-top:10%;
        display:table;
        border:solid 1px #cccccc;
        border-width: thin;
      }
      .style {
        bottom:0px;
        border:1px solid #666;
        background-color:#FFF;
        border-radius:3px;
        -webkit-border-radius:3px;
        -moz-border-radius:3px;
        box-shadow:0 0 5px #000;      
        -moz-box-shadow:0 0 5px #000;     
        -webkit-box-shadow:0 0 5px #000;      
      }
      .alpha {
        float:right;
        width:300px;
        padding:2px;
        border:1px solid #666;
        background-color:#FFF;
        border-radius: 3px;
        }
      .refresh {
        border: 1px solid #FFAD00;
        border-left: 4px solid #FFAD00;
        color: green;
        font-family: tahoma;
        font-size: 12px;
        height: 225px;
        overflow: auto;
        width: 270px;
        padding:10px;
        background-color:#FFFFFF;
      } 
      #post_button{
        border: 1px solid #3366FF;
        background-color:#3366FF;
        width: 50px;
        color:#FFFFFF;
        font-weight: bold;
        margin-left: -04px; padding-top: 4px; padding-bottom: 4px;
        cursor:pointer;
      }
      #textb{
        border: 1px solid #FFAD00;
        border-left: 4px solid #FFAD00;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 5px;
        width: 220px;
      }
      #texta{
        border: 1px solid #FFBD00;
        border-left: 4px solid #FFBD00;
        width: 210px;
        margin-bottom: 10px;
        padding:5px;
        color: #FFBD00;
      }
      #johnlei{
        margin-left:3px;
        color: #ffffff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        background-color: #FFBD00;
        *background-color: #FFBD00;
        background-image: -moz-linear-gradient(top, #FFAD00, #CCBD00);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));
        background-image: -webkit-linear-gradient(top, #FFAD00, #CCBD00);
        background-image: -o-linear-gradient(top, #FFAD00, #FFBD00);
        background-image: linear-gradient(to bottom, #FFAD00, #FFBD00);
        background-repeat: repeat-x;
        border-color: #2f96b4 #2f96b4 #1f6377;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff2f96b4', GradientType=0);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        float:right;
        cursor:pointer; 
        height: 53px;
        width:70px;
      }
      #johnlei:hover,
      #johnlei:active,
      #johnlei.active,
      #johnlei.disabled,
      #johnlei[disabled] {
        color: #ffffff;
        background-color: #51a351;
        *background-color: #499249;
      }
      #johnlei:active,
      #johnlei.active {
        background-color: #408140;
      }
      #johnlei:hover{
        background-color: #2f96b4;
      }
    </style>
    <script src="js/jquery.js"></script>
</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><span>ADMIN </span><?=constant("SYSTEM_NAME") ?></a>
        <ul class="user-menu">
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
              
    </div><!-- /.container-fluid -->
  </nav>
    
  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
      <li id="navDashboard"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
      <li id="navUsers" ><a href="users.php"><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>
      <li id="navCategories" ><a href="categories.php"><span class="glyphicon glyphicon-th"></span> Manage Pet Categories</a></li>
      <li id="navPets" ><a href="pets.php"><span class="glyphicon glyphicon-heart"></span> Manage Pets</a></li>
      <li id="navOrders" ><a href="orders.php"><span class="glyphicon glyphicon-shopping-cart"></span> Manage Orders</a></li>
      
      <li id="navReport" ><a href="report.php"><span class="glyphicon glyphicon-check"></span> Report</a></li>
      <li id="navChat" ><a href="chat.php"><span class="glyphicon glyphicon-envelope"></span> Chat</a></li>
  </div><!--/.sidebar-->

		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb top-bar-margin">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> </a></li>
				<li class="active">Chat</li>
			</ol>
		</div><!--/.row-->
		<br>
		<div class="panel panel-warning">
	  	<div class="panel-heading">
	  		<h3><span class="glyphicon glyphicon-envelope"></span> Chat</h3>
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
	  	<br>
            <div class="panel-body">
                <div class="holder">
    <label="welcomemsg">WELCOME: </label><label for="name"><?php echo 'Admin'; ?></label>
      <div class="style"> 
        <div class="alpha">
          <b align="center">You can view your chats here:</b>
          <input name="user" type="hidden" id="texta" value="<?php echo 'Admin' ?>"/>
          <div class="refresh">
          </div>
          <br/>
          <form name="newMessage" class="newMessage" action="" onsubmit="return false">
            <select name="recipient" id="recipient" style="width:270px;">
              <option>--Send Chat To--</option>
                <?php 
                  $sql = "SELECT * FROM users ORDER BY uname";
                  $qry = $con->prepare($sql);
                  $qry->execute();
                  $fetch = $qry->fetchAll();
                  foreach ($fetch as $fe):
                    $name = $fe['uname'];
                ?>
                  <option title="<?php echo $name; ?>"><?php echo $fe['uname']; ?> </option>
                <?php endforeach; ?>
            </select>
          <textarea name="textb" id="textb">Enter your message here</textarea>
          <input name="submit" type="submit" value="Send" id="johnlei" />
        </form>
      </div>
    </div>
  </div>  
            </div>
	  </div>	
								
	</div>	<!--/.main-->

	<?php require_once 'includes/import_scripts.php'; ?>
	<script>
       $(document).ready(function() {

	$('#navChat').addClass('active');
    // order date picker

});
    </script>
    
    <script src="../chatbox/js/sendchat.js" type="text/javascript"></script>
    <script src="../chatbox/js/refresh.js" type="text/javascript"></script>
</body>

</html>
