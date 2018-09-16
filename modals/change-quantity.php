<div id="modal-changequantity" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Quantity</h4>
      </div>
      <div class="modal-body" ng-app>
      	<span id="updateqty-response">
      	<form id="updateqty-form" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
          <input type="hidden" name="url" value="<?=$_SERVER['PHP_SELF'];?>">
      	 	<input type="hidden" name="item_id" value="<?=$item_row['item_id'];?>">
      	  <div class="form-group">
            <label>Quantity to Add:</label>
            <input type="number" class="form-control input-lg" name="quantity" ng-model="val_quantity" required="true">
          </div>  
            <span id="btn-response">
	          <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('updateqty-form', '../functions/update-quantity.php', 'updateqty-response')">Update</button>
	         </span>
      	</form>
      	</span>
      	<hr>
      	<div class="row">
      		<div class="col-lg-6 col-sm-6">
      			<p><strong><?=$item_row['name'];?> Current Quantity:</strong></p>
      			<p><strong><?=$item_row['name'];?> Quantity to be Added:</strong></p>
      			</br>
      			<p class="lead margin-top"><strong>Total Quantity:</strong></p>
      		</div>
      		<div class="col-lg-6 col-sm-6">
      			<p><?=$quantity_row['quantity'];?> Stocks</p>
      			<p>{{val_quantity}} Stocks</p>
      			<p>_________________________</p>
      			<p class="lead">{{val_quantity + <?=$quantity_row['quantity'];?>}} Stocks</p>
      		</div>
      	</div>
      </div>
    </div>
  </div>
</div>      	