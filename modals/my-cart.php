<script type="text/javascript">
  function item_total (input, price, response) {
    var input_items = document.getElementById(input).value;
    var total_price = input_items * price;
    document.getElementById(response).innerHTML = total_price.toFixed(2);
  }
</script>
<div id="modal-mycart" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">My Cart </h4>
      </div>
      <div class="modal-body">
        <?php
          if ($cnt_cart_row['cart_id'] != 0) {
          ?>
          <div class="panel-group">
          <?php
            $cart_total = 0;
            $item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id");
            while($item_row = $item_query->fetch()) {
              $cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and acc_id = '".$cos_row['acc_id']."' and cart_status = 'Pending'");
              while($cart_row = $cart_query->fetch()) {
                $cart_total += $cart_row['total_price'];
            ?>
            <span id="updatecart-response<?=$item_row['item_id'];?>">
            <form id="updatecart-form<?=$item_row['item_id'];?>" method="POST">
              <input type="hidden" name="cart_id" value="<?=$cart_row['cart_id'];?>">
              <input type="hidden" name="item_id" value="<?=$item_row['item_id'];?>">
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
                        <p class="text-left"><strong>Items Left:</strong> <?=$item_row['quantity'];?> Items</p>
                   </div>
                   <div class="col-lg-2 col-lg-2">
                      <label class="margin-top">No. of items:</label>
                      <input type="number" min="1" max="<?=$item_row['quantity'];?>" onkeyup="item_total ('input_item<?=$item_row['item_id'];?>', '<?=$item_row['price'];?>', 'total_response<?=$item_row['item_id'];?>')" value="<?=$cart_row['quantity'];?>" id="input_item<?=$item_row['item_id'];?>" class="form-control input-lg" name="quantity">
                   </div>
                   <div class="col-lg-2 col-lg-2">
                      <label class="margin-top">Total Price:</label>
                      <p class="margin-top-sm lead">P<span id="total_response<?=$item_row['item_id'];?>"><?=$cart_row['total_price'];?></span></p>
                   </div>
                   <div class="col-lg-2 col-lg-2">
                      <button type="submit" style="margin-top: 15px;" class="btn btn-success btn-lg btn-block" onclick="form_process ('updatecart-form<?=$item_row['item_id'];?>', '../functions/update-cart.php', 'updatecart-response<?=$item_row['item_id'];?>')">Update</button>
                      <button type="button" class="btn btn-success btn-lg btn-block" onclick="load_process ('updatecart-response<?=$item_row['item_id'];?>', '../functions/delete-module.php?cart_id=<?=$cart_row['cart_id'];?>')">Cancel</button>
                   </div> 
                </div>
                </div>
              </div>
            </form>
            </span>
            <?php  
              }
            }
          ?>
          </div>
          <script type="text/javascript">
            $(document).ready(function(){
              setInterval(function(){
                $('#carttotal<?=$cos_row['acc_id'];?>').load('../functions/reload-total-cart.php?acc_id=<?=$cos_row['acc_id'];?>');
              }, 3000);
            });
          </script>
          <div class="border-top padding-top">
            <p class="lead pull-left"><strong>CART TOTAL</strong></p>
            <p class="lead pull-right" id="carttotal<?=$cos_row['acc_id'];?>"><strong></strong></p>
          </div>
          <div class="clearfix"></div>
          <?php
          }
          else {
          ?>
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
              <p class="lead margin-bottom-lg">No item added to cart yet.</p>
            </div>
          </div>
          <?php  
          }
        ?>
      </div>
      <div class="modal-footer">
        <a class="btn btn-warning" href="index.php">Continue Shopping <i class="fa fa-shopping-bag fa-fw"></i></a>
        <a class="btn btn-warning" href="cos-checkout.php">Proceed to Checkout <i class="fa fa-chevron-right fa-fw"></i></a>
      </div>
    </div>
  </div>
</div>        