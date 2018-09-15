	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>
	      <a class="navbar-brand" href="#">
					<img src="../web-images/hn-logo.png" style="height: 42px; width: auto; margin-top: -12px;" alt="">
	      </a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="index.php" title="Home"><i class="fa fa-home fa-fw"></i></a></li>
	        <li><a href="cos-checkout.php" title="Checkouts"><i class="fa fa-shopping-bag fa-fw"></i></a></li>
	        <li><a href="cos-map.php" title="Map"><i class="fa fa-map fa-fw"></i></a></li>
	        <li><a href="cos-order.php" title="Orders"><i class="fa fa-calendar-plus fa-fw"></i></a></li>
	        <li><a href="cos-message.php" title="Messages"><i class="fa fa-envelope fa-fw"></i></a></li>
	        <li class="dropdown">
	        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi, <?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?> <span class="caret"></span></a>
	        	<ul class="dropdown-menu">
	        	  <li>
	        	  	<img src="<?=$cos_row['profile_photo'];?>" class="img-responsive img-rounded margin-top margin-bottom" style="height: 100px; width: auto; margin: auto;">
	        	  </li>	
	        	  <li class="divider"></li>
		          <li><a href="cos-profile.php"><i class="fa fa-user fa-fw"></i> Profile</a></li>
		          <li><a href="#" data-toggle="modal" data-target="#modal-accountsettings"><i class="fa fa-cog fa-fw"></i> Account Settings</a></li>
		          <li><a href="../functions/verify-logout.php"><i class="fa fa-sign-out-alt fa-fw"></i> Log Out</a></li>
		        </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<?php include "../modals/account-settings.php";?>