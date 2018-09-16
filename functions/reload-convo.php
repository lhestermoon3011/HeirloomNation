							<?php
								include "config.php";
								
								if (isset($_GET['mes_id']) && isset($_GET['sender_id'])) {
									$th_cnt_query = $conn->query("select count(th_id) as th_id from threads_tbl where mes_id = '".$_GET['mes_id']."'");
									$th_cnt_row = $th_cnt_query->fetch();
									if ($th_cnt_row['th_id'] != 0) {
										$th_query = $conn->query("select * from threads_tbl where mes_id = '".$_GET['mes_id']."' order by th_sent desc");
										while ($th_row = $th_query->fetch()) {
											if ($th_row['sender'] == $_GET['sender_id']) {
												$sender_query = $conn->query("select * from accounts_tbl where acc_id = '".$th_row['sender']."'");
												$sender_row = $sender_query->fetch();

												if ($sender_row['acc_type'] == "Costumer") {
													$cos2_query = $conn->query("select * from costumers_tbl where acc_id = '".$sender_row['acc_id']."'");
													$cos2_row = $cos2_query->fetch();
													?>
													<div class="row">
														<div class="col-lg-8 col-sm-8">
															<div class="panel">
																<div class="panel-body btn-success">
																	<p style="margin-top: -5px;"><?=$cos2_row['firstname'];?> <?=$cos2_row['lastname'];?> &bull; <?=$sender_row['acc_type'];?> &bull; <i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($th_row['th_sent']));?></p>
																	<p class="margin-bottom-sm"><?=$th_row['message'];?></p>
																</div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4"></div>
													</div>
													<?php
												}
												else if ($sender_row['acc_type'] == "Seller") {
													$seller2_query = $conn->query("select * from sellers_tbl where acc_id = '".$sender_row['acc_id']."'");
													$seller2_row = $seller2_query->fetch()
													?>
													<div class="row">
														<div class="col-lg-8 col-sm-8">
															<div class="panel">
																<div class="panel-body btn-success">
																	<p style="margin-top: -5px;"><?=$seller2_row['firstname'];?> <?=$seller2_row['lastname'];?> &bull; <?=$sender_row['acc_type'];?> &bull; <i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($th_row['th_sent']));?></p>
																	<p class="margin-bottom-sm"><?=$th_row['message'];?></p>
																</div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4"></div>
													</div>
													<?php
												}
											?>
											<?php	
											}
											else {
												$sender_query = $conn->query("select * from accounts_tbl where acc_id = '".$th_row['sender']."'");
												$sender_row = $sender_query->fetch();

												if ($sender_row['acc_type'] == "Costumer") {
													$cos2_query = $conn->query("select * from costumers_tbl where acc_id = '".$sender_row['acc_id']."'");
													$cos2_row = $cos2_query->fetch();
													?>
													<div class="row">
														<div class="col-lg-4 col-sm-4"></div>
														<div class="col-lg-8 col-sm-8">
															<div class="panel">
																<div class="panel-body btn-default">
																	<p style="margin-top: -5px;"><?=$cos2_row['firstname'];?> <?=$cos2_row['lastname'];?> &bull; <?=$sender_row['acc_type'];?> &bull; <i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($th_row['th_sent']));?></p>
																	<p class="margin-bottom-sm"><?=$th_row['message'];?></p>
																</div>
															</div>
														</div>
													</div>
													<?php
												}
												else if ($sender_row['acc_type'] == "Seller") {
													$seller2_query = $conn->query("select * from sellers_tbl where acc_id = '".$sender_row['acc_id']."'");
													$seller2_row = $seller2_query->fetch()
													?>
													<div class="row">
														<div class="col-lg-4 col-sm-4"></div>
														<div class="col-lg-8 col-sm-8">
															<div class="panel">
																<div class="panel-body btn-default">
																	<p style="margin-top: -5px;"><?=$seller2_row['firstname'];?> <?=$seller2_row['lastname'];?> &bull; <?=$sender_row['acc_type'];?> &bull; <i class="fa fa-clock fa-fw"></i> <?=date("F j, Y - h:ia", strtotime($th_row['th_sent']));?></p>
																	<p class="margin-bottom-sm"><?=$th_row['message'];?></p>
																</div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4"></div>
													</div>
													<?php
												}	
											}
										}
									}
									else {
									?>
									<p class="margin-top-lg lead text-center">No conversations made yet. Compose your message below.</p>
									<?php
									}
								}
							?>