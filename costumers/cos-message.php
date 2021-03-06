<?php include "../functions/account-session.php";?>
<!DOCTYPE html>
<html>
<head>
	<title>Messages &bull; HeirloomNation</title>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "cos-navbar.php";?>
<div class="container" style="margin-top: 50px; margin-bottom: 75px;">
	<h3><i class="fa fa-envelope fa-fw"></i> Messages</h3>
	<hr>
	<div class="row">
		<div class="col-lg-4 col-sm-4">
		<?php
			$cnt_seller_query = $conn->query("select count(acc_id) as acc_id from sellers_tbl");
			$cnt_seller_row = $cnt_seller_query->fetch();
		?>	
			<div class="input-group search-extended">
				<span class="input-group-addon"><i class="fa fa-search"></i></span>
				<input type="text" class="form-control" name="search" placeholder="Search from over <?=$cnt_seller_row['acc_id'];?> sellers..." onkeyup="load_process ('convo-container', '../functions/search-module.php?cos_id=<?=$cos_row['acc_id'];?>&search-convo='+this.value)" autocomplete="off">
			</div>
			<hr>
			<div class="panel-group" id="convo-container">
			<?php
				$seller_query = $conn->query("select * from sellers_tbl inner join accounts_tbl on sellers_tbl.acc_id=accounts_tbl.acc_id order by firstname asc limit 10");
				while ($seller_row = $seller_query->fetch()) {
					$th_query = $conn->query("select * from threads_tbl where sender = '".$seller_row['acc_id']."' and receiver = '".$cos_row['acc_id']."' and th_status = 'Unread'");
					$th_row = $th_query->fetch();
					$cnt_unread_query = $conn->query("select count(th_id) as th_id from threads_tbl where sender = '".$seller_row['acc_id']."' and receiver = '".$cos_row['acc_id']."' and th_status = 'Unread'");
					$cnt_unread_row = $cnt_unread_query->fetch();

					if ($cnt_unread_row['th_id'] != 0) {
						if (!empty($_GET['seller_id'])) {						
							if ($_GET['seller_id'] == $seller_row['acc_id']) {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 35px;" class="btn btn-success btn-block active"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php
							}
							else {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 35px;" class="btn btn-success btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php
							}
						}
						else {
						?>
						<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 35px;" class="btn btn-success btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?> <span class="badge"><?=$cnt_unread_row['th_id'];?> Unread Messages</span></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
						<?php		
						}
					}
					else {
						if (!empty($_GET['seller_id'])) {						
							if ($_GET['seller_id'] == $seller_row['acc_id']) {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 35px;" class="btn btn-success btn-block active"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php
							}
							else {
							?>
							<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 35px;" class="btn btn-success btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
							<?php
							}
						}
						else {
						?>
						<a href="../functions/update-unread.php?mes_id=<?=$th_row['mes_id'];?>&seller_id=<?=$seller_row['acc_id'];?>" style="height: 35px;" class="btn btn-success btn-block"><span class="pull-left"><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></span><i class="fa fa-chevron-right fa-fw pull-right" style="margin-top: 2px;"></i></a>
						<?php		
						}
					}
				}
			?>
			</div>
		</div>
		<div class="col-lg-8 col-sm-8">
			<?php
				if (!empty($_GET['seller_id'])) {
					$seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$_GET['seller_id']."'");
					$seller_row = $seller_query->fetch();
					
					$mes_query = $conn->query("select * from messages_tbl where costumer = '".$cos_row['acc_id']."' and seller = '".$_GET['seller_id']."'");
					$mes_row = $mes_query->fetch();
				?>
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="dropdown pull-right" style="margin-top: 5px;">
							  <button class="btn no-border dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-chevron-down fa-fw"></i></button>
							  <ul class="dropdown-menu">
							    <li><a href="index.php?acc_id=<?=$seller_row['acc_id'];?>"><i class="fa fa-external-link-alt fa-fw"></i> View Seller Items</a></li>
							    <li><a href="#" onclick="load_process ('convo-response<?=$mes_row['mes_id'];?>', '../functions/delete-module.php?mes_id=<?=$mes_row['mes_id'];?>')"><i class="fa fa-trash fa-fw"></i> Clear Conversation</a></li>
							  </ul>
							</div>
							<h4><?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></h4>
						</div>
						<div class="panel-body" id="convo-response<?=$mes_row['mes_id'];?>" style="height: 375px; overflow-y: auto; display: flex; flex-direction: column-reverse;">
							<?php include "../functions/reload-convo.php";?>
						</div>
						<div class="panel-body border-top">
						  <span id="response-message">	
							<form id="form-message">
							  <input type="hidden" name="seller" value="<?=$seller_row['acc_id'];?>">
							  <input type="hidden" name="costumer" value="<?=$cos_row['acc_id'];?>">
							  <input type="hidden" name="sender" value="<?=$_SESSION['acc_id'];?>">
							  <div class="input-group">
							    <input type="text" class="form-control input-lg" name="message" placeholder="Compose a message..." required="true">
							    <div class="input-group-btn">
							      <button class="btn btn-danger btn-lg" type="submit" onclick="form_process ('form-message', '../functions/send-message.php', 'response-message')">Send</button>
							    </div>
							  </div>
							</form>
						  </span>	
						</div>
					</div>	
				</div>		
				<?php
				}
				else {
				?>
				<div class="panel panel-default">
					<div class="panel-body text-center" style="height: 455px; padding-top: 75px;">
						<i class="fa fa-comment-alt fa-fw fa-10x margin-top-lg"></i>
	              		<p class="lead">Questions about the product of a seller? Discuss it here in messages.</p>
					</div>
				</div>
				<?php	
				}
			?>
		</div>
	</div>
</div>
<?php include "cos-footer.php";?>

<script type="text/javascript">
	$(document).ready(function(){
		setInterval(function(){
		$('#convo-response<?=$mes_row['mes_id'];?>').load('../functions/reload-convo.php?mes_id=<?=$mes_row['mes_id']?>&sender_id=<?=$_SESSION['acc_id'];?>');
		}, 2500);
		$("#convo-response<?=$mes_row['mes_id'];?>").animate({ scrollTop: $(this).height() }, "slow");
    return false;
	});
</script>
</body>
</html>
	