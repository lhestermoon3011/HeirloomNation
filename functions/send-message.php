<?php
	include "config.php";

	if(isset($_POST)) {
		$cnt_mes_query = $conn->query("select count(mes_id) as mes_id from messages_tbl where costumer = '".$_POST['costumer']."' and seller = '".$_POST['seller']."'");
		$cnt_mes_row = $cnt_mes_query->fetch();

		if ($cnt_mes_row['mes_id'] == 0) {
			$save_query = $conn->prepare("insert into messages_tbl (costumer, seller)values(:costumer, :seller)");
			$save_query->bindParam(":costumer", $_POST['costumer']);
			$save_query->bindParam(":seller", $_POST['seller']);

			if ($save_query->execute()) {
				$mes_id = $conn->lastInsertId();
				$update_query = $conn->prepare("update threads_tbl set th_status = :th_status where receiver = :receiver and mes_id = :mes_id");
				$update_query->bindParam(":th_status", $th_status);
				$update_query->bindParam(":receiver", $_POST['sender']);
				$update_query->bindParam(":mes_id", $mes_id);
				$th_status = "Read";
				$update_query->execute();
		
				if ($_POST['sender'] == $_POST['costumer']) {
					$save_query2 = $conn->prepare("insert into threads_tbl (mes_id, sender, receiver, message, th_status)values(:mes_id, :sender, :receiver, :message, :th_status)");
					$save_query2->bindParam(":mes_id", $mes_id);
					$save_query2->bindParam(":sender", $_POST['sender']);
					$save_query2->bindParam(":receiver", $receiver);
					$save_query2->bindParam(":message", $_POST['message']);
					$save_query2->bindParam(":th_status", $th_status);
					$receiver = $_POST['seller'];
					$th_status = "Unread";
				}
				else if ($_POST['sender'] == $_POST['seller']) {
					$save_query2 = $conn->prepare("insert into threads_tbl (mes_id, sender, receiver, message, th_status)values(:mes_id, :sender, :receiver, :message, :th_status)");
					$save_query2->bindParam(":mes_id", $mes_id);
					$save_query2->bindParam(":sender", $_POST['sender']);
					$save_query2->bindParam(":receiver", $receiver);
					$save_query2->bindParam(":message", $_POST['message']);
					$save_query2->bindParam(":th_status", $th_status);
					$receiver = $_POST['costumer'];
					$th_status = "Unread";
				}

				if ($save_query2->execute()) {
				?>
					<span id="response-message">	
						<form id="form-message">
						  <input type="hidden" name="seller" value="<?=$_POST['seller'];?>">
						  <input type="hidden" name="costumer" value="<?=$_POST['costumer'];?>">
						  <input type="hidden" name="sender" value="<?=$_POST['sender'];?>">
						  <div class="input-group">
						    <input type="text" class="form-control success" name="message" placeholder="Compose a message..." required="true">
						    <div class="input-group-btn">
						      <button class="btn btn-success" type="submit" onclick="form_process ('form-message', '../functions/send-message.php', 'response-message')">Send</button>
						    </div>
						  </div>
						</form>
					</span>
				<?php
				}
			}
		}
		else {
			$mes_query = $conn->query("select * from messages_tbl where costumer = '".$_POST['costumer']."' and seller = '".$_POST['seller']."'");
			$mes_row = $mes_query->fetch();
			$update_query = $conn->prepare("update threads_tbl set th_status = :th_status where receiver = :receiver and mes_id = :mes_id");
			$update_query->bindParam(":th_status", $th_status);
			$update_query->bindParam(":receiver", $_POST['sender']);
			$update_query->bindParam(":mes_id", $mes_row['mes_id']);
			$th_status = "Read";
			$update_query->execute();

			if ($_POST['sender'] == $_POST['costumer']) {
				$save_query2 = $conn->prepare("insert into threads_tbl (mes_id, sender, receiver, message, th_status)values(:mes_id, :sender, :receiver, :message, :th_status)");
				$save_query2->bindParam(":mes_id", $mes_row['mes_id']);
				$save_query2->bindParam(":sender", $_POST['sender']);
				$save_query2->bindParam(":receiver", $receiver);
				$save_query2->bindParam(":message", $_POST['message']);
				$save_query2->bindParam(":th_status", $th_status);
				$receiver = $_POST['seller'];
				$th_status = "Unread";
			}
			else if ($_POST['sender'] == $_POST['seller']) {
				$save_query2 = $conn->prepare("insert into threads_tbl (mes_id, sender, receiver, message, th_status)values(:mes_id, :sender, :receiver, :message, :th_status)");
				$save_query2->bindParam(":mes_id", $mes_row['mes_id']);
				$save_query2->bindParam(":sender", $_POST['sender']);
				$save_query2->bindParam(":receiver", $receiver);
				$save_query2->bindParam(":message", $_POST['message']);
				$save_query2->bindParam(":th_status", $th_status);
				$receiver = $_POST['costumer'];
				$th_status = "Unread";
			}

			if ($save_query2->execute()) {
			?>
					<span id="response-message">	
						<form id="form-message">
						  <input type="hidden" name="seller" value="<?=$_POST['seller'];?>">
						  <input type="hidden" name="costumer" value="<?=$_POST['costumer'];?>">
						  <input type="hidden" name="sender" value="<?=$_POST['sender'];?>">
						  <div class="input-group">
						    <input type="text" class="form-control " name="message" placeholder="Compose a message..." required="true">
						    <div class="input-group-btn">
						      <button class="btn btn-success" type="submit" onclick="form_process ('form-message', '../functions/send-message.php', 'response-message')">Send</button>
						    </div>
						  </div>
						</form>
					</span>
				<?php
			}
		}
	}
?>