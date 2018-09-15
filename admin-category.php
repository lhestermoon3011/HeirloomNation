<?php include "../functions/admin-account-session.php";?>
<?php 
	if (isset($_GET['cat_id'])) {
		$cat_query = $conn->query("select * from categories_tbl where cat_id = '".$_GET['cat_id']."'");
		$cat_row = $cat_query->fetch();
	}
	else {
		header("location: admin-inventory.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$cat_row['category_name'];?> &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "admin-navbar.php";?>
    <div class="container" style="margin-top: 50px; margin-bottom: 75px;">
		<div class="row margin-top" style="margin-bottom: -12px;">
    		<div class="col-lg-6 col-sm-6">
    			<h3 class="pull-left"><i class="fa fa-table fa-fw"></i> Inventory</h3>
    			<a data-toggle="modal" data-target="#addcat" class="btn btn-warning margin-left pull-left" style="margin-top: 13px;"><i class="fa fa-plus fa-fw"></i> Add Category</a>
    			<a data-toggle="modal" data-target="#modal-unitsettings" class="btn btn-warning margin-left-sm pull-left" style="margin-top: 13px;"><i class="fa fa-archive fa-fw"></i> Unit Settings</a>
    		</div>	
    	</div>
        <div class="clearfix"></div>
		<hr>
		<?php 
			include "../modals/add-category.php";
			include "../modals/unit-settings.php";
		?>
		<ul class="nav nav-pills nav-justified">
			<?php
				$cnt_cat_query = $conn->query("select count(item_id) as item_id from items_tbl");
				$cnt_cat_row = $cnt_cat_query->fetch();
			?>
		  	<li><a href="admin-inventory.php">All Items</a></li>
		  <?php
		  	$category_query = $conn->query("select * from categories_tbl");
			while ($category_row = $category_query->fetch()) {
				$cnt_cat_query = $conn->query("select count(item_id) as item_id from items_tbl where cat_id = '".$category_row['cat_id']."'");
				$cnt_cat_row = $cnt_cat_query->fetch();

				if ($_GET['cat_id'] == $category_row['cat_id']) {
				?>
				 <li class="active"><a href="admin-category.php?cat_id=<?=$category_row['cat_id'];?>"><?=$category_row['category_name'];?></a></li>
				<?php	
				}
				else {
				?>
				 <li><a href="admin-category.php?cat_id=<?=$category_row['cat_id'];?>"	><?=$category_row['category_name'];?></a></li>
				<?php
				}
			}
		  ?> 
		</ul>
		<script type="text/javascript">
			document.getElementById('demo').innerHTML = "My URL is "+window.location.href;
		</script>
		<p id="demo"></p>
		<div class="margin-top margin-bottom-lg row">
    		<div class="col-lg-6 col-sm-6">
    		</div>
    		<div class="col-lg-6 col-sm-6">	
				<div class="btn-group pull-right margin-top">
					<div class="input-group search-unextended pull-left">
					    <span class="input-group-addon"><i class="fa fa-search"></i></span>
					    <input type="text" class="form-control" name="search" placeholder="Search <?=$cat_row['category_name'];?>..." onkeyup="load_process ('item-container', '../functions/search-module.php?cat_id=<?=$cat_row['cat_id'];?>&search-item-3='+this.value)" autocomplete="off">
					</div>
				</div>	
			</div>	
    	</div>
    	<div id="item-container">
    		<?php
				$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where cat_id = '".$cat_row['cat_id']."'");
				$cnt_item_row = $cnt_item_query->fetch();

				if ($cnt_item_row['item_id'] != 0) {
				?>
				<div class="row">
				<?php
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id = items_quantity_tbl.item_id where cat_id = '".$cat_row['cat_id']."'");
					while ($item_row = $item_query->fetch()) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
						$seller_row = $seller_query->fetch();
						
						if ($item_row['quantity'] != 0) {
						?>
						<span id="<?=$item_row['item_id'];?>">
							<div class="col-lg-3 col-sm-3">
							  <div class="panel panel-default panel-hover">
							  	<div class="preview border">
								  	<a href="admin-item.php?item_id=<?=$item_row['item_id'];?>">
								  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
								  	</a>
							  	</div>
							  	<div class="panel-body">
									<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
									<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
							  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
							  	</div>
							  </div>
							</div>  	
						</span>
						<?php
						}
						else {
						?>
						<span id="<?=$item_row['item_id'];?>">
							<div class="col-lg-3 col-sm-3">
							  <div class="panel panel-default panel-hover">
							  	<div class="preview border">
								  	<a href="admin-item.php?item_id=<?=$item_row['item_id'];?>">
								  		<img src="<?=$item_row['item_photo'];?>" class="img-preview">
								  	</a>
							  	</div>
							  	<div class="panel-body">
									<h4 class="margin-top-sm text-center"><?=$item_row['name'];?> <span class="label label-danger">Sold Out</span></h4>
									<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
							  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
							  	</div>
							  </div>
							</div>  	
						</span>
						<?php
						}
					}
				?>
				</div>
				<?php			
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
						<p class="lead margin-bottom-lg">No items added yet.</p>
					</div>
				</div>
				<?php
				}
			?>
    	</div>	
	</div>
<?php include "admin-footer.php";?>
</body>
</html>		