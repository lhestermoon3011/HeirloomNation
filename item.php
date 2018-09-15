<?php 
	include "functions/config.php";

	if (isset($_GET['item_id'])) {
		$item_query = $conn->query("select * from items_tbl where item_id = '".$_GET['item_id']."'");
		$item_row = $item_query->fetch();

		$quantity_query = $conn->query("select * from items_quantity_tbl where item_id = '".$_GET['item_id']."'");
		$quantity_row = $quantity_query->fetch();

		$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$item_row['seller_id']."'");
		$seller_row = $seller_query->fetch();
	}
	else {
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$item_row['name'];?> &bull; HeirloomNation</title>
	<?php include "includes/libraries-out.php";?>
</head>
<body>
<?php include "navbar.php";?>
	<div class="container" style="margin-top: 75px; margin-bottom: 75px;">
		<div class="row">
			<div class="col-lg-4 col-sm-4">
				<a href="index.php" class="btn btn-info btn-lg margin-bottom-lg"><i class="fa fa-arrow-left fa-fw"></i> Return</a>	
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-3 col-sm-3">
					  	<div class="border" style="height: 360px; overflow: hidden;">
					  		<img src="<?=substr($item_row['item_photo'], 3);?>" style="height: 100%; width: auto;">
					  	</div>	
					</div>
					<div class="col-lg-9 col-sm-9">
					  	<h4 class="margin-top-sm"><?=$item_row['name'];?>
					  	<?php
					  		if ($quantity_row['quantity'] == 0) {
					  		?>
					  		<span class="label label-danger">Sold Out</span>
					  		<?php
					  		}
					  	?>	
					  	</h4>
						<p class="text-small text-muted padding-bottom border-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> &bull; <i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($item_row['item_added']));?></p>
					  	<p class="text-left"><strong>Item Description:</strong> <?=$item_row['description'];?></p>
					  	<p class="text-left"><strong>Quantity:</strong> <?=$quantity_row['quantity'];?> Items</p>
					  	<p class="text-left"><strong>Unit:</strong> <?=$item_row['unit'];?></p>
					  	<p class="text-left"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
					  	<p class="text-left"><strong>Item Features:</strong></p>
					  	<?php
					  		$feat_query = $conn->query("select * from item_features_tbl where item_id = '".$item_row['item_id']."'");
					  	
					  		while ($feat_row = $feat_query->fetch()) {
					  		?>
					  			<p>- <?=$feat_row['feature'];?></p>
					  		<?php
					  	}
					  	?>
					</div>
				</div>	
			</div>
		</div>
		<?php
		$cnt_items_query = $conn->query("select count(item_id) as item_id from items_tbl where cat_id = '".$item_row['cat_id']."' and seller_id = '".$seller_row['acc_id']."' and item_id not in ('".$_GET['item_id']."')");
		$cnt_items_row = $cnt_items_query->fetch();

		if ($cnt_items_row['item_id'] != 0) {
		?>	
		<h3 class="margin-top-sm">More Items</h3>
		<div class="row">				
		<?php
			$option_query = $conn->query("select * from items_tbl where item_id not in ('".$_GET['item_id']."') order by rand() limit 4");
			while ($option_row = $option_query->fetch()) {
		?>
		<div class="col-lg-3">
			<div class="panel panel-default panel-hover">
				<div class="preview border">
				  	<a href="cos-item.php?item_id=<?=$option_row['item_id'];?>">
				  		<img src="<?=substr($option_row['item_photo'], 3);?>" class="img-preview">
				  	</a>	
				</div>
				<div class="panel-body">
					<a href="cos-item.php?item_id=<?=$option_row['item_id'];?>" class="btn btn-default pull-right"><i class="fa fa-external-link-alt fa-fw"></i></a>
					<h4 class="margin-top-sm"><?=$option_row['name'];?></h4>
				</div>
			</div>
		</div>	
		<?php
			}
		?>
		</div>
		<?php
		}	
		?>
	</div>		
<?php include "costumers/cos-footer.php";?>
</body>
</html>