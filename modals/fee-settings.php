<div id="modal-feesettings" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Fee Settings</h4>
      </div>
      <div class="modal-body">
      	<?php 
	      	$chk_fee_query = $conn->query("select count(fee_id) as fee_id from fees_tbl");
			$chk_fee_row = $chk_fee_query->fetch();

			if ($chk_fee_row['fee_id'] == 0) {
			?>
			<span id="feesettings-response">
	          <form id="feesettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
	            <div class="form-group">
	              <label class="control-label col-sm-2">Service Fee:</label>
	              <div class="col-sm-10">
	                <input type="number" class="form-control input-lg" name="service_fee" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">Delivery Fee:</label>
	              <div class="col-sm-10">
	                <input type="number" class="form-control input-lg" name="delivery_fee" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <div class="col-sm-offset-2 col-sm-10">
	                <button class="btn btn-danger btn-lg" onclick="form_process ('feesettings-form', '../functions/save-fees.php', 'feesettings-response')">Save</button>
	              </div>
	            </div>
	          </form>
	        </span> 
			<?php
			}
			else if ($chk_fee_row['fee_id'] != 0) {
				$fee_query = $conn->query("select * from fees_tbl");
				$fee_row = $fee_query->fetch();
			?>
			<span id="feesettings-response">
	          <form id="feesettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
	            <div class="form-group">
	              <label class="control-label col-sm-2">Service Fee:</label>
	              <div class="col-sm-10">
	                <input type="number" class="form-control input-lg" name="service_fee" value="<?=$fee_row['service_fee'];?>" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="control-label col-sm-2">Delivery Fee:</label>
	              <div class="col-sm-10">
	                <input type="number" class="form-control input-lg" name="delivery_fee" value="<?=$fee_row['delivery_fee'];?>" required="true">
	              </div>
	            </div>
	            <div class="form-group">
	              <div class="col-sm-offset-2 col-sm-10">
	                <button class="btn btn-danger btn-lg" onclick="form_process ('feesettings-form', '../functions/save-fees.php', 'feesettings-response')">Update</button>
	              </div>
	            </div>
	          </form>
	        </span> 
			<?php
			}
      	?>   
      </div>
    </div>
  </div>
</div>      	