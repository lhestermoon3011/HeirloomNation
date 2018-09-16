<?php
	include "config.php";

	if (isset($_GET['seller_id'])) {
		$cnt_notif_query = $conn->query("select count(notif_id) as notif_id from notif_tbl where notified_id = '".$_GET['seller_id']."' and notif_status = 'Unread'");
    	$cnt_notif_row = $cnt_notif_query->fetch();

    	if ($cnt_notif_row['notif_id'] != 0) {
    	?>
    	<button class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown" style="margin-top: 13px;">Unread Messages <span class="badge"><?=$cnt_notif_row['notif_id'];?></span></button>
    	<ul class="dropdown-menu" style="width: 375px; height: 250px; overflow-y: auto;">
    	<?php	
    		$notif_query = $conn->query("select * from notif_tbl where notified_id = '".$_GET['seller_id']."' and notif_status = 'Unread'");
    		while($notif_row = $notif_query->fetch()) {
    			$mes_query = $conn->query("select * from messages_tbl where mes_id = '".$notif_row['mes_id']."'");
    			$mes_row = $mes_query->fetch();
    			$cos_query = $conn->query("select * from costumers_tbl where acc_id = '".$mes_row['costumer']."'");
    			$cos_row = $cos_query->fetch();
    			?>
    			<div class="panel-group margin-sm">
					<div class="panel btn-default">
						<div class="panel-body" style="padding-top: 7px; padding-bottom: 3px;" onclick="window.location.assign('../functions/update-notif-seller.php?mes_id=<?=$mes_row['mes_id'];?>&notified_id=<?=$notif_row['notified_id']?>');">
							<div class="row padding-top-sm padding-bottom-sm">
								<div class="col-lg-2 col-sm-2">
									<p class="margin-top"><i class="fa fa-envelope fa-fw fa-2x"></i></p>
								</div>
								<div class="col-lg-10 col-sm-10">
									<p class="text-justified"> New unread message from <?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?>.</p>
									<p class="text-muted" style="margin-top: -10px;"><i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($mes_row['convo_started']));?></p>
								</div>
							</div>
						</div>
					</div>
				</div>	
    			<?php
    		}
    	} 
    	?>
    	</ul>
    <?php
	}
    
    if (isset($_GET['cos_id'])) {
        $cnt_notif_query = $conn->query("select count(notif_id) as notif_id from notif_tbl where notified_id = '".$_GET['cos_id']."' and notif_status = 'Unread'");
        $cnt_notif_row = $cnt_notif_query->fetch();

        if ($cnt_notif_row['notif_id'] != 0) {
        ?>
        <button class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown" style="margin-top: 13px;">Unread Messages <span class="badge"><?=$cnt_notif_row['notif_id'];?></span></button>
        <ul class="dropdown-menu" style="width: 375px; height: 250px; overflow-y: auto;">
        <?php   
            $notif_query = $conn->query("select * from notif_tbl where notified_id = '".$_GET['cos_id']."' and notif_status = 'Unread'");
            while($notif_row = $notif_query->fetch()) {
                $mes_query = $conn->query("select * from messages_tbl where mes_id = '".$notif_row['mes_id']."'");
                $mes_row = $mes_query->fetch();
                $seller_query = $conn->query("select * from sellers_tbl where acc_id = '".$mes_row['seller']."'");
                $seller_row = $seller_query->fetch();
                ?>
                <div class="panel-group margin-sm">
                    <div class="panel btn-default">
                        <div class="panel-body" style="padding-top: 7px; padding-bottom: 3px;" onclick="window.location.assign('../functions/update-notif-cos.php?mes_id=<?=$mes_row['mes_id'];?>&notified_id=<?=$notif_row['notified_id']?>');">
                            <div class="row padding-top-sm padding-bottom-sm">
                                <div class="col-lg-2 col-sm-2">
                                    <p class="margin-top"><i class="fa fa-envelope fa-fw fa-2x"></i></p>
                                </div>
                                <div class="col-lg-10 col-sm-10">
                                    <p class="text-justified"> New unread message from <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?>.</p>
                                    <p class="text-muted" style="margin-top: -10px;"><i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($mes_row['convo_started']));?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <?php
            }
        } 
        ?>
        </ul>
    <?php
    }
?>