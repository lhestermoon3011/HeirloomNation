<div id="addcat" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <span id="response-cat">
          <form id="form-cat">
            <div class="input-group">
              <input type="text" class="form-control input-lg" name="cat_name" placeholder="Enter new category of an item..." required="true">
              <div class="input-group-btn">
                <button class="btn btn-danger btn-lg" type="submit" onclick="form_process ('form-cat', '../functions/save-category.php', 'response-cat')">Add</button>
              </div>
            </div>
          </form>
        </span>
        <hr>
        <div class="panel-group" id="display-response-2">
        </div>
        <script type="text/javascript">
          $(document).ready(function(){
            setInterval(function(){
            $('#display-response-2').load('../functions/reload-cat.php');
            }, 2500);
          });
        </script>
      </div>
      <div class="modal-footer">
        <a href="<?=$_SERVER['PHP_SELF'];?>" class="btn btn-lg btn-info">Reload Page</a>
      </div>
    </div>
  </div>
</div>