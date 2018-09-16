<?php
	include "config.php";

	session_start();
	$acc_id = $_SESSION['acc_id'];
	$email = $_SESSION['email'];
	$acc_type = $_SESSION['acc_type'];

	if (empty($acc_id) && empty($email) && empty($acc_type)) {
		header("location: ../admin/index.php");
	}
	else {
		$acc_query = $conn->query("select * from accounts_tbl where acc_id = '".$acc_id."' and email = '".$email."' and acc_type = '".$acc_type."'");
		$acc_row = $acc_query->fetch();
		$admin_query = $conn->query("select * from admins_tbl where acc_id = '".$acc_row['acc_id']."'");
		$admin_row = $admin_query->fetch();
	}
?>