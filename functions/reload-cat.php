<?php
  include "config.php";

  $cat_query = $conn->query("select * from categories_tbl");
  while ($cat_row = $cat_query->fetch()) {
  ?>
  <span id="cat<?=$cat_row['cat_id'];?>">  
    <div class="panel panel-default">
      <div class="panel-body padding-sm">
        <button class="pull-right btn-default btn-lg no-border" onclick="load_process ('cat<?=$cat_row['cat_id'];?>', '../functions/delete-module.php?cat_id=<?=$cat_row['cat_id'];?>')" title="Remove this unit"><i class="fa fa-times fa-fw"></i></button>
          <h4 class="margin-left"><?=$cat_row['category_name'];?></h4>
      </div>
    </div>
  </span> 
  <?php
  }
?>