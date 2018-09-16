<div id="modal-deletecat<?=$category_row['cat_id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you sure you want to delete category '<?=$category_row['category_name'];?>'?</p>
        <button type="button" class="btn btn-danger btn-lg" onclick="load_process ('<?=$category_row['cat_id'];?>', '../functions/delete-module.php?cat_id=<?=$category_row['cat_id'];?>')" data-dismiss="modal">Yes</button>
        <button class="btn btn-default btn-lg" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>