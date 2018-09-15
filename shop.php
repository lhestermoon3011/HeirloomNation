<?php
	include "functions/config.php";
	$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl");
	$cnt_item_row = $cnt_item_query->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home &bull; HeirloomNation</title>
	<?php include "includes/libraries-out.php";?>
</head>
<body>
<?php include "navbar.php";?>	
<div class="body" data-spy="scroll" data-target="#myScrollspy" data-offset="0">
	<nav class="navbar navbar-default padding" style="margin-top: 65px; background: #fff;">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-sm-10">
					<div class="input-group search-extended">
						<span class="input-group-addon"><i class="fa fa-search"></i></span>
						<input type="text" class="form-control input-lg" name="search" placeholder="Search from over <?=$cnt_item_row['item_id'];?> items..." onkeyup="load_process ('search-response', 'functions/search-home.php?search-home='+this.value)" autocomplete="off">
					</div>
					<span id="search-response"></span>
				</div>
				<div class="col-lg-2 col-sm-2">
					<div class="dropdown">
					  <button class="btn btn-success btn-lg btn-block dropdown-toggle" type="button" data-toggle="dropdown">Sort by <span class="caret"></span></button>
					  <ul class="dropdown-menu">
					    <li><a href="#" onclick="load_process ('item-response', 'functions/sort-item-2.php?sort=high-to-low')">Price High to Low</a></li>
					    <li><a href="#" onclick="load_process ('item-response', 'functions/sort-item-2.php?sort=low-to-high')">Price Low to High</a></li>
					    <li><a href="#" onclick="load_process ('item-response', 'functions/sort-item-2.php?sort=a-to-z')">Name A to Z</a></li>
					    <li><a href="#" onclick="load_process ('item-response', 'functions/sort-item-2.php?sort=z-to-a')">Name Z to A</a></li>
					  </ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<div class="container" style="margin-bottom: 75px;">
		<div class="row">
			<div class="col-lg-3 col-sm-3" id="myScrollspy">
			  <div data-spy="affix" data-offset-top="70">	
				<h4 class="margin-bottom" style="margin-top: 0px;"><i class="fa fa-th fa-fw"></i> Categories</h4>
				<a href="index.php" style="height: 45px;" class="btn btn-success btn-lg btn-block"><span class="pull-left">View All</span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
				<?php
				$category_query = $conn->query("select * from categories_tbl");
				while ($category_row = $category_query->fetch()) {
				?>
				<a href="index.php?category=<?=$category_row['cat_id'];?>" style="height: 45px;" class="btn btn-warning btn-lg btn-block"><span class="pull-left"><?=$category_row['category_name'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
				<?php
				}
				?>
				<hr>
				<h4 class="margin-bottom"><i class="fa fa-user fa-fw"></i> Costumer Access</h4>
				<a href="gm-signup.php" class="btn btn-warning btn-lg btn-block">Create Account <i class="fa fa-edit fa-fw"></i></a>
				<a href="gm-login.php" class="btn btn-warning btn-lg btn-block">Log In <i class="fa fa-sign-in-alt fa-fw"></i></a>
			  </div> 	
			</div>
			<div class="col-lg-9 col-sm-9">
			  <span id="item-response">	
				<div class="row">
				<?php
					if (empty($_GET)) {
						$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id");
						while ($item_row = $item_query->fetch()) {
							if ($item_row['quantity'] != 0) {
							?>
								<span id="<?=$item_row['item_id'];?>">
								<div class="col-lg-4 col-sm-4">
								  <div class="panel panel-default panel-hover">
								  	<div class="preview border">
									  	<a href="gm-item.php?item_id=<?=$item_row['item_id'];?>">
									  		<img src="<?=substr($item_row['item_photo'], 3);?>" class="img-preview">
									  	</a>
								  	</div>
								  	<div class="panel-body">
										<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
										<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
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
									<div class="col-lg-4 col-sm-4">
									  <div class="panel panel-default panel-hover">
									  	<div class="preview border">
										  	<a href="gm-item.php?item_id=<?=$item_row['item_id'];?>">
										  		<img src="<?=substr($item_row['item_photo'], 3);?>" class="img-preview">
										  	</a>
									  	</div>
									  	<div class="panel-body">
											<h4 class="margin-top-sm text-center"><?=$item_row['name'];?> <span class="label label-danger">Sold Out</span></h4>
											<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
									  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
									  	</div>
									  </div>
									</div>  	
								</span>
							<?php
							}
						}
					}
					else if (!empty($_GET['acc_id'])) {
						$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$_GET['acc_id']."'");
						$seller_row = $seller_query->fetch();

						$cnt_seller_query2 = $conn->query("select count(item_id) as item_id from items_tbl where seller_id = '".$seller_row['acc_id']."'");
						$cnt_seller_row2 = $cnt_seller_query2->fetch();
						?>
						<div class="col-lg-12 col-sm-12">
							<p class="lead" style="margin-top: -5px; margin-bottom: 6px;"><strong>Results:</strong> <?=$cnt_seller_row2['item_id'];?> Items for seller <strong>'<?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?>'</strong></p>
						</div>
						<?php
						$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id where seller_id = '".$seller_row['acc_id']."'");
						while ($item_row = $item_query->fetch()) {
							if ($item_row['quantity'] != 0) {
							?>
								<span id="<?=$item_row['item_id'];?>">
								<div class="col-lg-4 col-sm-4">
								  <div class="panel panel-default panel-hover">
								  	<div class="preview border">
									  	<a href="gm-item.php?item_id=<?=$item_row['item_id'];?>">
									  		<img src="<?=substr($item_row['item_photo'], 3);?>" class="img-preview">
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
						}
					}
					else if (!empty($_GET['category'])) {
						$cat_query = $conn->query("select * from categories_tbl where cat_id = '".$_GET['category']."'");
						$cat_row = $cat_query->fetch();

						$cnt_cat_query2 = $conn->query("select count(item_id) as item_id from items_tbl where cat_id = '".$cat_row['cat_id']."'");
						$cnt_cat_row2 = $cnt_cat_query2->fetch();
						?>
						<div class="col-lg-12 col-sm-12">
							<p class="lead" style="margin-top: -5px; margin-bottom: 6px;"><strong>Results:</strong> <?=$cnt_cat_row2['item_id'];?> Items for Category <strong>'<?=$cat_row['category_name'];?>'</strong></p>
						</div>
						<?php
						$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id where cat_id = '".$cat_row['cat_id']."'");
						while ($item_row = $item_query->fetch()) {
							if ($item_row['quantity'] != 0) {
								?>
								<span id="<?=$item_row['item_id'];?>">
								<div class="col-lg-4 col-sm-4">
								  <div class="panel panel-default panel-hover">
								  	<div class="preview border">
									  	<a href="gm-item.php?item_id=<?=$item_row['item_id'];?>">
									  		<img src="<?=substr($item_row['item_photo'], 3);?>" class="img-preview">
									  	</a>
								  	</div>
								  	<div class="panel-body">
										<h4 class="margin-top-sm text-center"><?=$item_row['name'];?></h4>
										<p class="text-small text-muted text-center padding-bottom border-bottom">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
								  		<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
								  	</div>
								  </div>
								</div>  	
								</span>
							<?php
							}
						}
					}
				?>
				</div>
			  </span>	
			</div>	
		</div>		
	</div>
</div>
</body>
</html>