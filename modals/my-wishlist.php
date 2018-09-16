<div id="modal-mywishlist" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">My Wishlist </h4>
      </div>
      <div class="modal-body">
      <?php
          if ($cnt_wish_row['wish_id'] != 0) {
          ?>  
        <div class="panel-group">
        <?php
          $item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id");
          while($item_row = $item_query->fetch()) {
            $wish_query = $conn->query("select * from wishlists_tbl where item_id  = '".$item_row['item_id']."' and acc_id = '".$cos_row['acc_id']."'");
            while($wish_row = $wish_query->fetch()) {
          ?>
          <span id="wish-response<?=$item_row['item_id'];?>">
          <form id="wish-form<?=$item_row['item_id'];?>" method="POST">
            <input type="hidden" name="item_id" value="<?=$item_row['item_id'];?>">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                 <div class="col-lg-2 col-lg-2">
                    <div class="border" style="height: 130px; overflow: hidden;">
                      <img src="<?=$item_row['item_photo'];?>" style="height: 100%; width: auto;">
                    </div>
                 </div>
                 <div class="col-lg-7 col-lg-7">
                    <h4 class="margin-top-sm margin-bottom-sm"><?=$item_row['name'];?></h4>
                      <p class="text-small text-muted margin-bottom">by: <?=$item_row['firstname'];?> <?=$item_row['lastname'];?> &bull; Added to wishlist last <?=date("F j, Y - h:ia", strtotime($wish_row['wish_added']));?></p>
                      <p class="text-left"><strong>Price:</strong> P<?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
                      <p class="text-left"><strong>Items Left:</strong> <?=$item_row['quantity'];?> Items</p>
                 </div>
                 <div class="col-lg-3 col-lg-3">
                  <?php
                    $cnt_cart_query = $conn->query("select count(cart_id) as cart_id from carts_tbl where item_id = '".$item_row['item_id']."' and acc_id = '".$cos_row['acc_id']."'");
                    $cnt_cart_row = $cnt_cart_query->fetch();

                    if ($cnt_cart_row['cart_id'] == 0) {
                    ?>
                    <button type="button" style="margin-top: 15px;" class="btn btn-danger btn-lg btn-block" onclick="load_process ('wish-response<?=$item_row['item_id'];?>', '../functions/move-to-cart.php?item_id=<?=$item_row['item_id'];?>')">Move to Cart</button>
                    <button type="button" class="btn btn-danger btn-lg btn-block" onclick="load_process ('wish-response<?=$item_row['item_id'];?>', '../functions/delete-module.php?wish_id=<?=$wish_row['wish_id'];?>')">Remove to Wishlist</button>
                    <?php
                    }
                    else {
                    ?>
                    <p class="text-center margin-top">* Item already in cart</p>
                     <button type="button" class="btn btn-danger btn-lg btn-block" onclick="load_process ('wish-response<?=$item_row['item_id'];?>', '../functions/delete-module.php?wish_id=<?=$wish_row['wish_id'];?>')">Remove to Wishlist</button>
                    <?php  
                    }
                  ?>
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
      <?php
          }
          else {
          ?>
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <i class="fa fa-frown fa-fw fa-10x margin-top-lg"></i>
              <p class="lead margin-bottom-lg">No item added to wishlist yet.</p>
            </div>
          </div>
          <?php  
          }
      ?>  
      </div>
      <div class="modal-footer">
        <a class="btn btn-info btn-lg" href="index.php">Continue Shopping <i class="fa fa-shopping-bag fa-fw"></i></a>
      </div>
    </div>
  </div>
</div>