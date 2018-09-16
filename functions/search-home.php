<?php
	include "config.php";

	if (isset($_GET['search-home'])) {
		if (!empty($_GET['search-home'])) {
		?>
		<div class="panel panel-default" style="position: absolute; width: 97%; z-index: 1; height: 300px; overflow-y: auto;">
			<div class="panel-body">
			<?php
				$cnt_item_query = $conn->query("select count(item_id) as item_id from items_tbl where name like '%".$_GET['search-home']."%'");
				$cnt_item_row = $cnt_item_query->fetch();

				if ($cnt_item_row['item_id'] != 0) {
				?>
				<p><strong>Results:</strong> <?=$cnt_item_row['item_id'];?> results for <strong>'<?=$_GET['search-home'];?>'</strong></p>
				<div class="panel-group">
				<?php	
					$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id where name like '%".$_GET['search-home']."%' order by rand() asc");
					while ($item_row = $item_query->fetch()) {
						if ($item_row['quantity'] != 0) {
						?>
						<div class="panel panel-default">
							<div class="panel-body">
								<h4 class="margin-bottom-sm pull-left"><?=$item_row['name'];?></h4>
								<p class="pull-left" style="margin-top: 11px; margin-left: 7px;">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
								<div class="clearfix"></div>
								<p class="pull-left" style="margin-top: -7px;"><strong>Price:</strong> Php <?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
								<a href="gm-item.php?item_id=<?=$item_row['item_id'];?>" class="btn btn-info btn-lg pull-right" style="margin-top: -32px;">Item Details <i class="fa fa-chevron-right fa-fw"></i></a>
							</div>
						</div>		
						<?php
						}
					}
				?>
				</div>
				<?php	
				}
				else {
				?>
				<p><strong>Results:</strong> No results for <strong>'<?=$_GET['search-home'];?>'</strong></p>
				<?php	
				}
			?>
			</div>
		</div>
		<?php	
		}
	}
?>