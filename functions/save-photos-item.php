<?php
	include "config.php";

	if (isset($_POST['item_photos']['name'])) {
		$photos_count = count($_POST['item_photos']['name']);
		$x = 0;

		while ($x < $photos_count) {
			$save_query = $conn->prepare("insert into item_photos_tbl(item_id, item_photo)values(:item_id, :item_photo)");
			$save_query->bindParam(":photo_id", $_POST['item_id'][$x]);
			$save_query->bindParam(":", $_POST['item_photos'][$x]);
			$x++;
		}
	}
?>