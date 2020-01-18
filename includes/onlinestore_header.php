<?php include_once("model/product.php"); ?>
<?php include_once("model/manageCart.php"); ?>
<?php include_once("includes/session.php"); ?>
<?php require_once('includes/config.php'); ?>
<?php include_once("functions.php"); ?>

<?php incrementSiteVisit($con); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="UTF-8">
    <title>GULF MEDICAL CORPORATION | Pharmaceuticals | Medical Equipment Companies | Kingdom of Bahrain</title>
  <meta name="keywords" content="Al Jishi Corporation, Pharmaceutical, medical equipment, imperial Leather, Canderal, Nair, Seba med, scholl, Touch, Bahrain, ethicon, Alcon, tyco, Seca" />
  <meta name="copyright" content="GULF MEDICAL CORPORATION" />
  <meta name="robots" content="index, follow" />
  <meta name="author" content="NEW AGE IT BAHRAIN" />
  <meta name="description" content=" Gulf medical Corporation is the agent of a diverse range of multinational pharmaceuticals and medical equipment companies, offering specialized products and services to the health care industry in Bahrain">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/woocommerce-smallscreen.css">
    <link rel="stylesheet" href="css/woocommerce-layout.css">
    <link rel="stylesheet" href="css/woocommerce.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="stylesheet" href="css/6s-main.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
<!--[if IE 6]><link href="css/ie6.css" rel="stylesheet" type="text/css"><![endif]-->
<!--[if IE 7]><link href="css/ie7.css" rel="stylesheet" type="text/css"><![endif]-->

</head>
<body>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header>
        <div class="topbar">
          <div class="container-fluid"> 
            <div class="row">
              <div class="aside-wrapper col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="slogan-aside">
                  <p style="margin-left: 85px; ">More than 50 Years of Outstanding healthcare</p>
                </div>
              </div>
              <div class="aside-wrapper col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="contact-aside">
                  <ul>
                    <li class="icon-call"><a>+973 17 233544</a></li>
                    <li class="icon-mail"><a>info@gulfmedical.com</a></li>
                  </ul>
                </div>
                <nav class="social">
                  <ul>
                     <li><a href="https://www.facebook.com/gulfmedical" target="_blank" class="icon-facebook"></a></li>
                    <li><a href="https://twitter.com/gulfmedical" target="_blank" class="icon-twitter"></a></li>
                    <li><a href="#" class="icon-linkedin"></a></li>
                  </ul>
                </nav>
              </div>
              <div class="aside-wrapper col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
                  <a class="btn btn-cart" href="cart.php" style="margin-top: 4px;margin-bottom: 4px" ><span class="fa fa-shopping-cart"></span>  View Cart <span id="cart_qty" class="badge"><?php 
            echo (isset($_SESSION['cartManager']) ? $_SESSION['cartManager']->get_totalQty() : 0);
              ?> </span>  
    </a>
              </div>
            </div>
          </div>
        </div><span class="clearfix"></span>
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
              <div class="header-top"><a href="index.php" class="page-logo"><img src="images/logo.jpg" alt="Gulf Medical Logo" class="img-responsive"></a></div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">           
              <div class="navbar navbar-default">
                <div class="navbar-header">
                  <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar">  </span></button>
                </div>
                <!--<nav class="main-nav collapse navbar-collapse">
                <div class="menu-main-menu-container">
                    <ul id="menu-main-menu" class="nav navbar-nav">
                        <li id="menu-item-146" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-4 current_page_item menu-item-146"><a href="index.php">Home</a></li>
                        <li id="menu-item-147" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-147"><a href="aboutus.php">About Us</a></li>
                        <li id="menu-item-153" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-153"><a href="pharmaceuticals.php">Pharmaceuticals</a></li>
                        <li id="menu-item-158" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-158"><a href="quality-policy.php">Quality Policy</a></li>
                        <li id="menu-item-152" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-152"><a href="useful-info.php">Useful Info</a></li>
<li id="menu-item-148" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-148"><a href="contactus.php">Contact Us</a></li>
</ul></div>             </nav>-->
                <nav class="main-nav collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li><a href="index.php"  class="<?php if($currentPage == 'index.php'){echo 'active';}else{echo '';}?>">Home</a></li>
                    <li> <a href="aboutus.php" class="<?php if($currentPage == 'aboutus.php'){echo 'active';}else{echo '';}?>">aboutus</a> </li>
                    <li><a href="pharmaceuticals.php" class="<?php if($currentPage == 'pharmaceuticals.php'){echo 'active';}else{echo '';}?>" >Pharmaceuticals</a></li>
                    <li><a href="quality-policy.php" class="<?php if($currentPage == 'quality-policy.php'){echo 'active';}else{echo '';}?>">Quality Policy</a></li>
                    <li><a href="useful-info.php" class="<?php if($currentPage == 'useful-info.php'){echo 'active';}else{echo '';}?>">usefulinfo</a></li>
                    <li><a href="contactus.php" class="<?php if($currentPage == 'contactus.php'){echo 'active';}else{echo '';}?>">contact</a></li>
                    <li><a href="online-store.php" class="<?php if($currentPage == 'online-store.php' ||
                    $currentPage == 'single_item.php' || 
                    $currentPage == 'cart.php' ||
                    $currentPage == 'customer_details.php' ||
                    $currentPage == 'login_customer_details.php' ||
                    $currentPage == 'order_summary.php' ||
                    $currentPage == 'order_success.php'||
                    $currentPage == 'register.php'){echo 'active';}else{echo '';}?>">Online Store</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </header>

