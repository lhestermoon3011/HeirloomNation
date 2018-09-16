<?php
	include "config.php";

	if (isset($_POST)) {
		if (!empty($_FILES['item_photo']['name'])) {
			$file_loc = "../uploads/item-photos/";
			$file_name = $_FILES['item_photo']['name'];
			$item_photo = $file_loc . basename($_FILES['item_photo']['name']);	
			$file_type = pathinfo($item_photo, PATHINFO_EXTENSION);

			if (move_uploaded_file($_FILES['item_photo']['tmp_name'], $item_photo)) {
				$get_item_query = $conn->query("select * from items_tbl where item_id = '".$_POST['item_id']."'");
				$get_item_row = $get_item_query->fetch();
				unlink($get_item_row['item_photo']);

				$update_query = $conn->prepare("update items_tbl set name = :name, description = :description, unit = :unit, price = :price, item_photo = :item_photo where item_id = :item_id");
				$update_query->bindParam(":name", $_POST['item_name']);
				$update_query->bindParam(":description", $_POST['item_desc']);
				$update_query->bindParam(":unit", $_POST['item_unit']);
				$update_query->bindParam(":price", $_POST['item_price']);
				$update_query->bindParam(":item_photo", $item_photo);
				$update_query->bindParam(":item_id", $_POST['item_id']);

				if ($update_query->execute()) {
				?>
				<script type="text/javascript">
					window.location.assign("<?php echo $_POST['url']."?item_id=".$_POST['item_id'];?>");
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
				<form id="edititem-form" class="form-horizontal" onsubmit="loading ('btn-response')" method="POST">
		            <input type="hidden" name="cat_id" value="<?=$_POST['cat_id'];?>">
		            <input type="hidden" name="item_id" value="<?=$_POST['item_id'];?>">
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
		                <input type="text" class="form-control input-lg" value="<?=$_POST['item_price'];?>" name="item_price" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Photo:</label>
		              <div class="col-sm-10">
		                <input type="file" class="form-control input-lg" name="item_photo" accept="image/*">
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="col-sm-offset-2 col-sm-10">
		                <span id="btn-response"> 
		                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('edititem-response', '../functions/update-item.php', 'edititem-response')">Update</button>
		                </span>
		              </div>
		            </div>
		        </form>
			<?php	
			}
		}
		else if (empty($_FILES['item_photo']['name'])) {
			$update_query = $conn->prepare("update items_tbl set name = :name, description = :description, unit = :unit, price = :price where item_id = :item_id");
			$update_query->bindParam(":name", $_POST['item_name']);
			$update_query->bindParam(":description", $_POST['item_desc']);
			$update_query->bindParam(":unit", $_POST['item_unit']);
			$update_query->bindParam(":price", $_POST['item_price']);
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
					<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Updating of category failed. Please try again.
				</div>
				<form id="edititem-form" class="form-horizontal" onsubmit="loading ('btn-response<?=$_POST['item_id'];?>')" method="POST">
		            <input type="hidden" name="cat_id" value="<?=$_POST['cat_id'];?>">
		            <input type="hidden" name="item_id" value="<?=$_POST['item_id'];?>">
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
		                </select>
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Price:</label>
		              <div class="col-sm-10">
		                <input type="text" class="form-control input-lg" value="<?=$_POST['item_price'];?>" name="item_price" required="true">
		              </div>
		            </div>
		            <div class="form-group">
		              <label class="control-label col-sm-2">Photo:</label>
		              <div class="col-sm-10">
		                <input type="file" class="form-control input-lg" name="item_photo" accept="image/*">
		              </div>
		            </div>
		            <div class="form-group">
		              <div class="col-sm-offset-2 col-sm-10">
		                <span id="btn-response"> 
		                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('edititem-response', '../functions/update-item.php', 'edititem-response')">Update</button>
		                </span>
		              </div>
		            </div>
		        </form>
			<?php	
			}
		}
	}
?>