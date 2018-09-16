<?php
	include "config.php";

	if (isset($_GET['acc_id'])) {
		$cnt_cart_query = $conn->query("select count(cart_id) as cart_id from carts_tbl where acc_id = '".$_GET['acc_id']."'");
		$cnt_cart_row = $cnt_cart_query->fetch();

		if ($cnt_cart_row['cart_id'] != 0) {
          ?>
          <h3>Items in My Cart</h3>
          <div class="panel-group">
          <?php  
            $cart_query = $conn->query("select * from carts_tbl inner join items_tbl on carts_tbl.item_id=items_tbl.item_id where acc_id = '".$_GET['acc_id']."'");
            while ($cart_row = $cart_query->fetch()) {
            ?>
            <span id="<?=$cart_row['cart_id'];?>">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                 <div class="col-lg-2 col-lg-2">
                    <div class="border" style="height: 105px; overflow: hidden;">
                      <img src="<?=$cart_row['item_photo'];?>" style="height: 100%; width: auto;">
                    </div>
                 </div>
                 <div class="col-lg-4 col-lg-4">
                  <h4 class="margin-top-sm margin-bottom"><?=$cart_row['name'];?> <span class="label label-success"><?=$cart_row['item_status'];?></span></h4>
                    <p class="text-left"><strong>Price:</strong> P<?=$cart_row['price'];?>/<?=$cart_row['unit'];?></p>
                 </div>
                 <div class="col-lg-2 col-lg-2">
                  <label class="margin-top-sm">No. of items:</label>
                  <p class="margin-top-sm lead"><?=$cart_row['quantity'];?></p>  
                 </div>
                 <div class="col-lg-2 col-lg-2">
                  <label class="margin-top-sm">Total Price:</label>
                  <p class="margin-top-sm lead">P<span id="total_response<?=$cart_row['item_id'];?>"><?=$cart_row['total_price'];?></span></p>
                 </div>
                 <div class="col-lg-2 col-lg-2">
                    <button type="submit" class="btn btn-danger btn-lg btn-block margin-top" onclick="load_process ('<?=$cart_row['cart_id'];?>', '../functions/delete-module.php?cart_id=<?=$cart_row['cart_id'];?>')">Cancel</button>
                 </div> 
                </div>
              </div>
            </div>
            </span>    
            <?php
            }
          ?>
          </div>
          <?php 
          }
	}
?>