<?php
	include "config.php";

	if (isset($_POST)) {
		$save_query = $conn->prepare("insert into item_features_tbl (item_id, feature)values(:item_id, :feature)");
		$save_query->bindParam(":item_id", $_POST['item_id']);
		$save_query->bindParam(":feature", $_POST['feature']);

		if ($save_query->execute()) {
		?>
		<script type="text/javascript">
			window.location.assign("<?php echo $_POST['url']."?item_id=".$_POST['item_id'];?>");
		</script>
		<?php
		}
		else {
		?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong><i class="fa fa-exclamation-circle fa-fw"></i></strong> Adding of feature failed. Please try again.
				</div>
				<form id="addfeature-form" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
		          <input type="hidden" name="item_id" value="<?=$_POST['item_id'];?>">
		          <div class="form-group">
		            <label>Content (Maximum of 100 characters only):</label>
		            <textarea class="form-control input-lg" name="feature" maxlength="100" required="true"><?=$_POST['feature'];?></textarea>
		          </div>
		          <span id="btn-response">
		          <button type="submit" class="btn btn-danger btn-lg margin-bottom-lg" onclick="form_process ('addfeature-form', '../functions/save-features.php', 'addfeature-response')">Save</button>
		          </span>
		        </form>
		<?php	
		}
	}
?>