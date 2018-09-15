<?php
	include "config.php";

	if (isset($_POST)) {
		$file_loc = "../uploads/item-photos/";
		$file_name = $_FILES['item_photo']['name'];
		$item_photo = $file_loc . basename($_FILES['item_photo']['name']);	
		$file_type = pathinfo($item_photo, PATHINFO_EXTENSION);

		if (move_uploaded_file($_FILES['item_photo']['tmp_name'], $item_photo)) {
			$save_query = $conn->prepare("insert into items_tbl (seller_id, cat_id, name, description, unit, price, item_status, item_photo)values(:acc_id, :cat_id, :name, :description, :unit, :price, :item_status, :item_photo)");
			$save_query->bindParam(":acc_id", $_POST['acc_id']);
			$save_query->bindParam(":cat_id", $_POST['cat_id']);
			$save_query->bindParam(":name", $_POST['item_name']);
			$save_query->bindParam(":description", $_POST['item_desc']);
			$save_query->bindParam(":unit", $_POST['item_unit']);
			$save_query->bindParam(":price", $_POST['item_price']);
			$save_query->bindParam(":item_status", $item_status);
			$save_query->bindParam(":item_photo", $item_photo);
			$item_status = "New";

			if ($save_query->execute()) {
				$item_id = $conn->lastInsertId();
				$item_query = $conn->query("select * from items_tbl where item_id = '".$item_id."'");
				$item_row = $item_query->fetch();

				$save_query2 = $conn->prepare("insert into items_quantity_tbl (item_id, quantity)values(:item_id, :quantity)");
				$save_query2->bindParam(":item_id", $item_row['item_id']);
				$save_query2->bindParam(":quantity", $quantity);
				$quantity = "0";

				$save_query2->execute();
			?>
			<script type="text/javascript">
				window.location.assign("../seller/seller-inventory.php");
			</script>
			<?php
			}
		}
		else {
			?>
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Moving of image failed. Please try again.
				</div>
				<form id="additem-form" class="form-horizontal" onsubmit="loading ('btn-response')" method="POST">
		            <input type="hidden" name="acc_id" value="<?=$_POST['acc_id'];?>">
		             <div class="form-group">
		              <label class="control-label col-sm-2">Category:</label>
		              <div class="col-sm-10">
		                <select class="form-control input-lg" name="cat_id" required="true">
		                  <?php
		                    $cat_query = $conn->query("select * from categories_tbl");
		                    while ($cat_row = $cat_query->fetch()) {
		                    ?>
		                    <option value="<?=$cat_row['cat_id'];?>" <?php if(isset($cat_row['cat_id']) == $_POST['cat_id']){echo "selected='selected'";}?>><?=$cat_row['category_name'];?></option>
		                    <?php
		                    }
		                  ?>
		                  <option>Select category...</option>
		                </select>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Name:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['item_name'];?>" name="item_name" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Description (Maximum of 150 characters only):</label>
		              <div class="col-sm-10"> 
		                <textarea class="form-control input-lg" name="item_desc" maxlength="150" required="true"><?=$_POST['item_desc'];?></textarea>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Unit:</label>
		              <div class="col-sm-10">
		                <select class="form-control input-lg" name="item_unit" required="true">
		                  <?php
		                    $unit_query = $conn->query("select * from units_tbl");
		                    while ($unit_row = $unit_query->fetch()) {
		                    ?>
		                    <option value="<?=$unit_row['unit_name'];?>" <?php if(isset($unit_row['unit_name']) == $_POST['item_unit']){echo "selected='selected'";}?>><?=$unit_row['unit_name'];?></option>
		                    <?php
		                    }
		                  ?>
			              <option>Select unit...</option>
		                </select>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Price:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" <?=$_POST['item_price'];?> name="item_price" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Photo:</label>
		              <div class="col-sm-10">
		                <input type="file" class="form-control input-lg" name="item_photo" accept="image/*" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="col-sm-offset-2 col-sm-10">
		                <span id="btn-response"> 
		                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('additem-form', '../functions/save-item.php', 'additem-response')">Save</button>
		                </span>
		              </div>
		            </div>
		        </form>
			<?php
		}
	}
?>