<div id="modal-addfeatures" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Features</h4>
      </div>
      <div class="modal-body">
        <span id="addfeature-response">
        <form id="addfeature-form" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
          <input type="hidden" name="url" value="<?=$_SERVER['PHP_SELF'];?>">
          <input type="hidden" name="item_id" value="<?=$item_row['item_id'];?>">
          <div class="form-group">
            <label>Content (Maximum of 100 characters only):</label>
            <textarea class="form-control input-lg" name="feature" maxlength="100" required="true"></textarea>
          </div>
          <span id="btn-response">
          <button type="submit" class="btn btn-danger btn-lg margin-bottom-lg" onclick="form_process ('addfeature-form', '../functions/save-features.php', 'addfeature-response')">Save</button>
          </span>
        </form>  
      </div>
    </div>
  </div>
</div>      	