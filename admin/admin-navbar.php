	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span> 
	      </button>
	      <a class="navbar-brand" href="#">
				<img src="../web-images/hn-logo.png" style="height: 57px; width: auto; margin-top: -12px;" alt="">
	      </a>
	    </div>
	    <div style="padding: 8px; font-size: 16px;" class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="admin-dashboard.php"><i class="fa fa-home fa-fw"></i> Dashboard</a></li>
			<li><a href="admin-inventory.php"><i class="fa fa-table fa-fw"></i> Inventory</a></li>
			<li><a href="admin-orders.php"><i class="fa fa-calendar-plus fa-fw"></i> Orders</a></li>
	        <li><a href="admin-records.php"><i class="fa fa-list fa-fw"></i> Records</a></li>
			<li><a href="admin-accounts.php"><i class="fa fa-users fa-fw"></i> Accounts</a></li>
	        <li class="dropdown">
	        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi, <?=$admin_row['firstname'];?> <?=$admin_row['lastname'];?> <span class="caret"></span></a>
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