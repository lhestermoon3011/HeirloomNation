<?php
	include "config.php";

	if (isset($_GET['mes_id']) && isset($_GET['seller_id'])) {
		$th_status = "Read";
		$update_query = $conn->prepare("update threads_tbl set th_status = :th_status where sender = :sender and mes_id = :mes_id");
		$update_query->bindParam(":th_status", $th_status);
		$update_query->bindParam(":mes_id", $_GET['mes_id']);
		$update_query->bindParam(":sender", $_GET['seller_id']);

		if ($update_query->execute()) {
		?>
		<script type="text/javascript">
			window.location.assign("../costumers/cos-message.php?seller_id=<?=$_GET['seller_id'];?>");
		</script>
		<?php
		}
	}

	if (isset($_GET['mes_id']) && isset($_GET['cos_id'])) {
		$th_status = "Read";
		$update_query = $conn->prepare("update threads_tbl set th_status = :th_status where sender = :sender and mes_id = :mes_id");
		$update_query->bindParam(":th_status", $th_status);
		$update_query->bindParam(":mes_id", $_GET['mes_id']);
		$update_query->bindParam(":sender", $_GET['cos_id']);

		if ($update_query->execute()) {
		?>
		<script type="text/javascript">
			window.location.assign("../seller/seller-message.php?cos_id=<?=$_GET['cos_id'];?>");
		</script>
		<?php
		}
	}
?>