<?php
	include "config.php";

	if (isset($_POST)) {
		$file_loc = "../profile-photos/";
		$file_name = $_FILES['profile_photo']['name'];
		$profile_photo = $file_loc . basename($_FILES['profile_photo']['name']);	
		$file_type = pathinfo($profile_photo, PATHINFO_EXTENSION);

		if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $profile_photo)) {
			$update_query = $conn->prepare("update costumers_tbl set firstname = :firstname, lastname = :lastname, birthdate = :birthdate, age = :age, gender = :gender, address = :address, profile_photo = :profile_photo where acc_id = :acc_id");
			$update_query->bindParam(":firstname", $_POST['firstname']);
			$update_query->bindParam(":lastname", $_POST['lastname']);
			$update_query->bindParam(":birthdate", $_POST['birthdate']);
			$update_query->bindParam(":age", $age);
			$update_query->bindParam(":gender", $_POST['gender']);
			$update_query->bindParam(":address", $_POST['address']);
			$update_query->bindParam(":profile_photo", $profile_photo);
			$update_query->bindParam(":acc_id", $_POST['acc_id']);
			$today = date("Y/m/d", strtotime("today"));
			$age = $today - $_POST['birthdate'];

			if ($update_query->execute()) {
			?>
			<script type="text/javascript">
				window.location.assign("../costumers/cos-profile.php");
			</script>
			<?php	
			}
		}
	}
?>
