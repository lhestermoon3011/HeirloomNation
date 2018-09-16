<?php
	include "config.php";

	if (isset($_POST)) {
		$unit_query = $conn->query("select count(unit_id) as unit_id from units_tbl where unit_name = '".$_POST['unit_name']."'");
		$unit_row = $unit_query->fetch();

		if ($unit_row['unit_id'] == 0) {
			$save_query = $conn->prepare("insert into units_tbl (unit_name)values(:unit_name)");
			$save_query->bindParam(":unit_name", $_POST['unit_name']);

			if ($save_query->execute()) {
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><i class="fa fa-check fa-fw"></i></strong> Unit added.
			</div>
			<form id="form-unit">
			  <div class="input-group">
			    <input type="text" class="form-control input-lg" name="unit_name" placeholder="Enter new unit of an item..." required="true">
			    <div class="input-group-btn">
			      <button class="btn btn-danger btn-lg" type="submit" onclick="form_process ('form-unit', '../functions/save-unit.php', 'response-unit')">Add</button>
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
			<form id="form-unit">
			  <div class="input-group">
			    <input type="text" class="form-control input-lg" name="unit_name" placeholder="Enter new unit of an item..." required="true">
			    <div class="input-group-btn">
			      <button class="btn btn-danger btn-lg" type="submit" onclick="form_process ('form-unit', '../functions/save-unit.php', 'response-unit')">Add</button>
			    </div>
			  </div>
			</form>
		<?php	
		}
	}
?>