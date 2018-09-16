<div id="modal-sellersearch" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sellers</h4>
      </div>
      <div class="modal-body" style="height: 500px; overflow-y: auto;">
      	<div class="input-group search-extended">
			<span class="input-group-addon"><i class="fa fa-search"></i></span>
			<input type="text" class="form-control input-lg" name="search" placeholder="Search from over <?=$cnt_seller_row['acc_id'];?> sellers..." onkeyup="load_process ('seller-container', '../functions/search-module.php?search-seller='+this.value)" autocomplete="off">
		</div>
		<hr>
		<div class="panel-group" id="seller-container">
		<?php
			$seller_query = $conn->query("select * from sellers_tbl inner join accounts_tbl on sellers_tbl.acc_id=accounts_tbl.acc_id order by firstname asc");
			while ($seller_row = $seller_query->fetch()) {
			?>
			<div class="panel panel-default">
				<div class="panel-body">
					<a href="index.php?acc_id=<?=$seller_row['acc_id'];?>" class="btn btn-warning btn-lg pull-right">View Seller Items  <i class="fa fa-chevron-right"></i></a>
					<a href="cos-message.php?seller_id=<?=$seller_row['acc_id'];?>" class="btn btn-warning btn-lg pull-right">Message Seller <i class="fa fa-envelope"></i></a>
					<p class="lead margin-bottom-sm"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
					<p class="text-small text-muted" style="margin-top: -7px;"><?=$seller_row['email'];?> &bull; <?=$seller_row['mobile_number'];?> &bull; <?=$seller_row['address'];?></p>
				</div>
			</div>	
			<?php
			}
		?>
		</div>	
      </div>
    </div>
  </div>
</div>      	