<?php
	include "config.php";

	if (isset($_POST)) {
		$unit_query = $conn->query("select count(cat_id) as cat_id from categories_tbl where category_name = '".$_POST['cat_name']."'");
		$unit_row = $unit_query->fetch();

		if ($unit_row['cat_id'] == 0) {
			$save_query = $conn->prepare("insert into categories_tbl (category_name)values(:cat_name)");
			$save_query->bindParam(":cat_name", $_POST['cat_name']);

			if ($save_query->execute()) {
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-check fa-fw"></i></strong> Category added.
			</div>
			<form id="form-unit">
	            <div class="input-group">
	              <input type="text" class="form-control input-lg" name="cat_name" placeholder="Enter new category of an item..." required="true">
	              <div class="input-group-btn">
	                <button class="btn btn-danger btn-lg" type="submit" onclick="form_process ('form-cat', '../functions/save-category.php', 'response-cat')">Add</button>
	              </div>
	            </div>
	        </form>
			<?php
			}
		}
		else {
		?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Unit already added. Please try again.
			</div>
			<form id="form-cat">
	            <div class="input-group">
	              <input type="text" class="form-control input-lg" name="cat_name" placeholder="Enter new category of an item..." required="true">
	              <div class="input-group-btn">
	                <button class="btn btn-danger btn-lg" type="submit" onclick="form_process ('form-cat', '../functions/save-category.php', 'response-cat')">Add</button>
	              </div>
	            </div>
	        </form>
		<?php
		}
	}
?>