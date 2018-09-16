<div id="modal-additem" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Item</h4>
      </div>
      <div class="modal-body">
        <span id="additem-response">
          <form id="additem-form" class="form-horizontal" onsubmit="loading ('btn-response')" method="POST">
            <input type="hidden" name="acc_id" value="<?=$seller_row['acc_id'];?>">
            <input type="hidden" name="cat_id" value="<?=$cat_row['cat_id'];?>">
            <div class="form-group">
              <label class="control-label col-sm-2">Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg" name="item_name" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Description (Maximum of 150 characters only):</label>
              <div class="col-sm-10"> 
                <textarea class="form-control input-lg" name="item_desc" maxlength="150" required="true"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Unit:</label>
              <div class="col-sm-10">
                <select class="form-control input-lg" name="item_unit" required="true">
                  <?php
                    $unit_query = $conn->query("select * from units_tbl");
                    while ($unit_row = $unit_query->fetch()) {
                    ?>
                    <option value="<?=$unit_row['unit_name'];?>"><?=$unit_row['unit_name'];?></option>
                    <?php
                    }
                  ?>
                  <option selected="selected">Select unit...</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Price:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg" name="item_price" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Photo:</label>
              <div class="col-sm-10">
                <input type="file" class="form-control input-lg" name="item_photo" accept="image/*" required="true">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <span id="btn-response"> 
                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('additem-form', '../functions/save-item-2.php', 'additem-response')">Save</button>
                </span>
              </div>
            </div>
          </form>
        </span>
      </div>
    </div>
  </div>
</div>        