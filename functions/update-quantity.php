<?php
	include "config.php";

	if (isset($_POST)) {
		$get_item_query = $conn->query("select * from items_quantity_tbl where item_id = '".$_POST['item_id']."'");
		$get_item_row = $get_item_query->fetch();
		$total_quantity = $get_item_row['quantity'] + $_POST['quantity'];

		$update_query = $conn->prepare("update items_quantity_tbl set quantity = :quantity where item_id = :item_id");
		$update_query->bindParam(":quantity", $total_quantity);
		$update_query->bindParam(":item_id", $_POST['item_id']);

		if ($update_query->execute()) {
		?>
		<script type="text/javascript">
			window.location.assign("<?php echo $_POST['url']."?item_id=".$_POST['item_id'];?>");
		</script>
		<?php
		}
		else {
		?>
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Adding of quantity failed. Please try again.
				</div>
				<form id="updateqty-form" autocomplete="off" method="POST">
				  <input type="text" name="url" value="<?=$_SERVER['PHP_SELF'];?>">
		      	  <input type="hidden" name="item_id" value="<?=$_POST['item_id'];?>">
		      	  <div class="form-group">
		            <label>Quantity to Add:</label>
		            <input type="number" class="form-control input-lg" name="quantity" ng-model="val_quantity" value="{{<?=$_POST['quantity']?>}}" required="true">
		          </div>  
		            <span id="btn-response">
			          <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('updateqty-form', '../functions/update-quantity.php', 'updateqty-response')">Update</button>
			        </span>
		      	</form>
		<?php	
		}
	}
?>