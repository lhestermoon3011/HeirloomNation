	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>
	      <a class="navbar-brand" href="#">
					<img src="../web-images/logo.png" style="height: 42px; width: auto; margin-top: -12px;" alt="">
	      </a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="seller-dashboard.php"><i class="fa fa-home fa-fw"></i> Dashboard</a></li>
			<li><a href="seller-inventory.php"><i class="fa fa-table fa-fw"></i> Inventory</a></li>
			<li><a href="seller-records.php"><i class="fa fa-list fa-fw"></i> Records</a></li>
		    <li><a href="seller-message.php"><i class="fa fa-envelope fa-fw"></i> Messages</a></li>
	        <li class="dropdown">
	        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi, <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="caret"></span></a>
	        	<ul class="dropdown-menu">	
		          <li><a href="" data-toggle="modal" data-target="#modal-adminsettings"><i class="fa fa-cog fa-fw"></i> Account Settings</a></li>
		          <li><a href="../functions/verify-logout.php"><i class="fa fa-sign-out-alt fa-fw"></i> Log Out</a></li>
		        </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
<?php include "../modals/admin-settings.php";?>
<script type="text/javascript">
	jQuery(function($) {
     var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
     $('.nav li a').each(function() {
      if (this.  === path) {
       $(this).addClass('active');
      }
     });
    });
</script>