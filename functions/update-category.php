<?php
	include "config.php";

	if (isset($_POST)) {
		if (!empty($_FILES['cat_photo']['name'])) {
			$file_loc = "../uploads/category-photos/";
			$file_name = $_FILES['cat_photo']['name'];
			$cat_photo = $file_loc . basename($_FILES['cat_photo']['name']);	
			$file_type = pathinfo($cat_photo, PATHINFO_EXTENSION);

			if (move_uploaded_file($_FILES['cat_photo']['tmp_name'], $cat_photo)) {
				$get_cat_query = $conn->query("select * from categories_tbl where cat_id = '".$_POST['cat_id']."'");
				$get_cat_row = $get_cat_query->fetch();
				unlink($get_cat_row['category_photo']);

				$update_query = $conn->prepare("update categories_tbl set category_name = :cat_name, category_photo = :cat_photo where cat_id = :cat_id");
				$update_query->bindParam(":cat_id", $_POST['cat_id']);
				$update_query->bindParam(":cat_name", $_POST['cat_name']);
				$update_query->bindParam(":cat_photo", $cat_photo);

				if ($update_query->execute()) {
				?>
				<script type="text/javascript">
					window.location.assign("../admin/admin-inventory.php");
				</script>
				<?php
				}
				else {
				?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Updating of category failed. Please try again.
					</div>
					<form id="editcat-form<?=$_POST['cat_id'];?>" class="form-horizontal" onsubmit="loading ('btn-response<?=$_POST['cat_id'];?>')" method="POST">
			            <div class="form-group">
			              <label class="control-label col-sm-2">Name:</label>
			              <div class="col-sm-10">
			                <input type="text" class="form-control input-lg" value="<?=$_POST['cat_name'];?>" name="cat_name" required="true">
			              </div>
			            </div>
			            <div class="form-group">
			              <label class="control-label col-sm-2">Photo:</label>
			              <div class="col-sm-10">
			                <input type="file" class="form-control input-lg" name="cat_photo">
			              </div>
			            </div>
			            <div class="form-group">
			              <div class="col-sm-offset-2 col-sm-10">
			                <span id="btn-response<?=$_POST['cat_id'];?>"> 
			                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('editcat-form<?=$_POST['cat_id'];?>', '../functions/update-category.php', 'editcat-response<?=$_POST['cat_id'];?>')">Update</button>
			                </span>
			              </div>
			            </div>
			        </form>
				<?php
				}
			}
			else {
			?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Moving of image failed. Please try again.
					</div>
					<form id="editcat-form<?=$_POST['cat_id'];?>" class="form-horizontal" onsubmit="loading ('btn-response<?=$_POST['cat_id'];?>')" method="POST">
			            <div class="form-group">
			              <label class="control-label col-sm-2">Name:</label>
			              <div class="col-sm-10">
			                <input type="text" class="form-control input-lg" value="<?=$_POST['cat_name'];?>" name="cat_name" required="true">
			              </div>
			            </div>
			            <div class="form-group">
			              <label class="control-label col-sm-2">Photo:</label>
			              <div class="col-sm-10">
			                <input type="file" class="form-control input-lg" name="cat_photo">
			              </div>
			            </div>
			            <div class="form-group">
			              <div class="col-sm-offset-2 col-sm-10">
			                <span id="btn-response<?=$_POST['cat_id'];?>"> 
			                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('editcat-form<?=$_POST['cat_id'];?>', '../functions/update-category.php', 'editcat-response<?=$_POST['cat_id'];?>')">Update</button>
			                </span>
			              </div>
			            </div>
			        </form>
			<?php
			}
		}
		else if (empty($_FILES['cat_photo']['name'])) {
			$update_query = $conn->prepare("update categories_tbl set category_name = :cat_name where cat_id = :cat_id");
			$update_query->bindParam(":cat_id", $_POST['cat_id']);
			$update_query->bindParam(":cat_name", $_POST['cat_name']);

			if ($update_query->execute()) {
			?>
				<script type="text/javascript">
					window.location.assign("../admin/admin-inventory.php");
				</script>
			<?php
			}
			else {
			?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Updating of category failed. Please try again.
					</div>
					<form id="editcat-form<?=$_POST['cat_id'];?>" class="form-horizontal" onsubmit="loading ('btn-response<?=$_POST['cat_id'];?>')" method="POST">
			            <div class="form-group">
			              <label class="control-label col-sm-2">Name:</label>
			              <div class="col-sm-10">
			                <input type="text" class="form-control input-lg" value="<?=$_POST['cat_name'];?>" name="cat_name" required="true">
			              </div>
			            </div>
			            <div class="form-group">
			              <label class="control-label col-sm-2">Photo:</label>
			              <div class="col-sm-10">
			                <input type="file" class="form-control input-lg" name="cat_photo">
			              </div>
			            </div>
			            <div class="form-group">
			              <div class="col-sm-offset-2 col-sm-10">
			                <span id="btn-response<?=$_POST['cat_id'];?>"> 
			                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('editcat-form<?=$_POST['cat_id'];?>', '../functions/update-category.php', 'editcat-response<?=$_POST['cat_id'];?>')">Update</button>
			                </span>
			              </div>
			            </div>
			        </form>
			<?php
			}
		}
	}
?>