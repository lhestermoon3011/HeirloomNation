<?php
	include "config.php";

	if (isset($_GET)) {
		if ($_GET['sort'] == "high-to-low") {
		?>
				<div class="row">
					<?php
						$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id order by items_tbl.price asc");
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
					?>
				</div>
		<?php
		}
		else if ($_GET['sort'] == "low-to-high") {
		?>
				<div class="row">
					<?php
						$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id order by items_tbl.price desc");
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
					?>
				</div>
		<?php
		}
		else if ($_GET['sort'] == "a-to-z") {
		?>
				<div class="row">
					<?php
						$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id order by items_tbl.name asc");
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
					?>
				</div>
		<?php
		}
		else if ($_GET['sort'] == "z-to-a") {
		?>
				<div class="row">
					<?php
						$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id order by items_tbl.name desc");
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
					?>
				</div>
		<?php
		}
	}
?>