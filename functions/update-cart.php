<?php
	include "config.php";
	include "account-session.php";

	if (isset($_POST)) {
		$item_query = $conn->query("select * from items_tbl inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id where item_id = '".$_POST['item_id']."'");
		$item_row = $item_query->fetch();
		$quantity_query = $conn->query("select * from items_quantity_tbl where item_id = '".$_POST['item_id']."'");
		$quantity_row = $quantity_query->fetch();

		$update_query = $conn->prepare("update carts_tbl set quantity = :quantity, total_price = :total_price where cart_id = :cart_id");
		$update_query->bindParam(":quantity", $_POST['quantity']);
		$update_query->bindParam(":total_price", $total_price);
		$update_query->bindParam(":cart_id", $_POST['cart_id']);
		$total_price = number_format($_POST['quantity'] * $item_row['price'], 2);

		if ($update_query->execute()) {
		?>
		    <form id="updatecart-form<?=$_POST['item_id'];?>" method="POST">
            <input type="hidden" name="cart_id" value="<?=$_POST['cart_id'];?>">
            <input type="hidden" name="item_id" value="<?=$_POST['item_id'];?>">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                 <div class="col-lg-2 col-lg-2">
                    <div class="border" style="height: 130px; overflow: hidden;">
                      <img src="<?=$item_row['item_photo'];?>" style="height: 100%; width: auto;">
                    </div>
                 </div>
                 <div class="col-lg-4 col-lg-4">
                    <h4 class="margin-top-sm margin-bottom-sm"><?=$item_row['name'];?></h4>
                      <p class="text-small text-muted margin-bottom">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?></p>
                      <p class="text-left"><strong>Price:</strong> P<?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
                      <p class="text-left"><strong>Items Left:</strong> <?=$quantity_row['quantity'];?> Items</p>
                 </div>
                 <div class="col-lg-2 col-lg-2">
                    <label class="margin-top">No. of items:</label>
                    <input type="number" min="1" max="<?=$quantity_row['quantity'];?>" onkeyup="item_total ('input_item<?=$item_row['item_id'];?>', '<?=$item_row['price'];?>', 'total_response<?=$item_row['item_id'];?>')" value="<?=$_POST['quantity'];?>" id="input_item<?=$item_row['item_id'];?>" class="form-control input-lg" name="quantity">
                 </div>
                 <div class="col-lg-2 col-lg-2">
                    <label class="margin-top">Total Price:</label>
                    <p class="margin-top-sm lead">P<span id="total_response<?=$_POST['item_id'];?>"><?=$total_price;?></span></p>
                 </div>
                 <div class="col-lg-2 col-lg-2">
                    <button type="submit" style="margin-top: 15px;" class="btn btn-danger btn-lg btn-block" onclick="form_process ('updatecart-form<?=$_POST['item_id'];?>', '../functions/update-cart.php', 'updatecart-response<?=$_POST['item_id'];?>')">Update</button>
                    <button type="button" class="btn btn-danger btn-lg btn-block" onclick="load_process ('updatecart-response<?=$item_row['item_id'];?>', '../functions/delete-module.php?cart_id=<?=$cart_row['cart_id'];?>')">Cancel</button>
                 </div> 
              </div>
              </div>
            </div>
          </form>
		<?php	
		}
	}