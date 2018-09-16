<div id="modal-orderdetails<?=$order_row['order_id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order # <?=$order_row['order_id'];?> Details</h4>
      </div>
      <div class="modal-body">
      	<h4>Payment And Order Details</h4>
      	<div class="row">
      		<div class="col-lg-4 col-sm-4">
      			<p class="text-left"><strong>Payment Via:</strong></p>
      		</div>
      		<div class="col-lg-8 col-sm-8">
      			<p class="text-right"><?=$order_row['payment_type'];?></p>
      		</div>
      		<div class="col-lg-4 col-sm-4">
      			<p class="text-left"><strong>Order Status:</strong></p>
      		</div>
      		<div class="col-lg-8 col-sm-8">
      			<p class="text-right"><?=$order_row['order_status'];?></p>
      		</div>
      		<div class="col-lg-4 col-sm-4">
      			<p class="text-left"><strong>Delivery Date:</strong></p>
      		</div>
      		<div class="col-lg-8 col-sm-8">
      			<p class="text-right"><?=date("F j, Y", strtotime($order_row['order_deliverydate']));?></p>
      		</div>
      	</div>
      	<hr>
      	<h4>Costumer Details</h4>
      	<div class="row">
      		<div class="col-lg-4 col-sm-4">
      			<p class="text-left"><strong>Fullname:</strong></p>
      		</div>
      		<div class="col-lg-8 col-sm-8">
      			<p class="text-right"><?=$cos_row['firstname'];?> <?=$cos_row['lastname'];?></p>
      		</div>
      		<div class="col-lg-4 col-sm-4">
      			<p class="text-left"><strong>Mobile Number:</strong></p>
      		</div>
      		<div class="col-lg-8 col-sm-8">
      			<p class="text-right"><?=$add_row['mobile_number'];?></p>
      		</div>
      		<div class="col-lg-4 col-sm-4">
      			<p class="text-left"><strong>Telephone Date:</strong></p>
      		</div>
      		<div class="col-lg-8 col-sm-8">
      			<p class="text-right"><?=$add_row['telephone_number'];?></p>
      		</div>
                  <div class="clearfix"></div>
      		<div class="col-lg-4 col-sm-4">
      			<p class="text-left"><strong>Address:</strong></p>
      		</div>
      		<div class="col-lg-8 col-sm-8">
      			<p class="text-right"><?=$add_row['address'];?></p>
      		</div>
      		<div class="col-lg-4 col-sm-4">
      			<p class="text-left"><strong>Address Details:</strong></p>
      		</div>
      		<div class="col-lg-8 col-sm-8">
      			<p class="text-justify"><?=$add_row['address_details'];?></p>
      		</div>
      	</div>
      </div>
  	</div>
  </div>
</div>  	