<?php
	include "config.php";

	if (isset($_GET['acc_id'])) {
		$cart_total = 0;
		$item_query = $conn->query("select * from items_tbl inner join items_quantity_tbl on items_tbl.item_id=items_quantity_tbl.item_id inner join sellers_tbl on sellers_tbl.acc_id=items_tbl.seller_id");
        while($item_row = $item_query->fetch()) {
            $cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and acc_id = '".$_GET['acc_id']."' and cart_status = 'Pending'");
            while($cart_row = $cart_query->fetch()) {
              $total_price = str_replace(",", "", $cart_row['total_price']);
              $cart_total += $total_price;
          	}
      	}
    ?>
    <strong>P<?php echo number_format($cart_total, 2);?></strong>
    <?php  
	}
?>