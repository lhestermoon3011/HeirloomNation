<?php
	include 'config.php';

	session_start();
	$save_query = $conn->prepare("insert into account_logs (acc_id, log_type)values(:acc_id, :log_type)");
	$save_query->bindParam(":acc_id", $_SESSION['acc_id']);
	$save_query->bindParam(":log_type", $log_type);
	$log_type = "Log Out";
	
	$save_query->execute();
	if ($_SESSION['acc_type'] == "Costumer") {
		session_unset();
		session_destroy();
		header("location:../login.php");
	}
	else if ($_SESSION['acc_type'] == "Seller") {
		session_unset();
		session_destroy();
		header("location: ../private-login.php");
	}
	else if ($_SESSION['acc_type'] == "Admin") {
		session_unset();
		session_destroy();
		header("location: ../private-login.php");
	}
?>