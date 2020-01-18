<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header>
        <div class="topbar">
          <div class="container"> 
            <div class="row">
              <div class="aside-wrapper col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="slogan-aside">
                  <p>More than 50 Years of Outstanding healthcare</p>
                </div>
              </div>
              <div class="aside-wrapper col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="contact-aside">
                  <ul>
                    <li class="icon-call"><a>+973 17 233544</a></li>
                    <li class="icon-mail"><a>info@gulfpharmacy.com</a></li>
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
</ul></div>				</nav>-->
                <nav class="main-nav collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li><a href="index.php"  class="<?php if($currentPage == 'index.php'){echo 'active';}else{echo '';}?>">Home</a></li>
                    <li> <a href="aboutus.php" class="<?php if($currentPage == 'aboutus.php'){echo 'active';}else{echo '';}?>">aboutus</a> </li>
                    <li><a href="pharmaceuticals.php" class="<?php if($currentPage == 'pharmaceuticals.php'){echo 'active';}else{echo '';}?>" >Pharmaceuticals</a></li>
                    <li><a href="quality-policy.php" class="<?php if($currentPage == 'quality-policy.php'){echo 'active';}else{echo '';}?>">Quality Policy</a></li>
                    <li><a href="useful-info.php" class="<?php if($currentPage == 'useful-info.php'){echo 'active';}else{echo '';}?>">usefulinfo</a></li>
                    <li><a href="contactus.php" class="<?php if($currentPage == 'contactus.php'){echo 'active';}else{echo '';}?>">contact</a></li>
                    <li><a href="online-store.php" class="<?php if($currentPage == 'online-store.php'){echo 'active';}else{echo '';}?>">Online Store</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </header>