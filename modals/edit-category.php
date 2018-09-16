<div id="modal-editcat<?=$category_row['cat_id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Category</h4>
      </div>
      <div class="modal-body">
        <span id="editcat-response<?=$category_row['cat_id'];?>">
          <form id="editcat-form<?=$category_row['cat_id'];?>" class="form-horizontal" onsubmit="loading ('btn-response<?=$category_row['cat_id'];?>')" method="POST">
            <input type="hidden" name="cat_id" value="<?=$category_row['cat_id'];?>">
            <div class="form-group">
              <label class="control-label col-sm-2">Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg" value="<?=$category_row['category_name'];?>" name="cat_name" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Photo:</label>
              <div class="col-sm-10">
                <input type="file" class="form-control input-lg" name="cat_photo" accept="image/*">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <span id="btn-response<?=$category_row['cat_id'];?>"> 
                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('editcat-form<?=$category_row['cat_id'];?>', '../functions/update-category.php', 'editcat-response<?=$category_row['cat_id'];?>')">Update</button>
                </span>
              </div>
            </div>
          </form>
        </span>
      </div>
    </div>
  </div>
</div>