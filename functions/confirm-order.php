<?php
	include "config.php";

	if (isset($_GET['order_id'])) {
		$update_query = $conn->prepare("update orders_tbl set order_status = :order_status where order_id = :order_id");
		$update_query->bindParam(":order_status", $order_status);
		$update_query->bindParam(":order_id", $_GET['order_id']);
		$order_status = "Finished";
		
		if ($update_query->execute()) {
			header("location: ../admin/admin-orders.php");
		}
	}
?>