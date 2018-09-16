<div id="modal-deleteitem" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you sure you want to delete item '<?=$item_row['name'];?>'?</p>
        <button type="button" class="btn btn-danger btn-lg" onclick="load_process ('<?=$item_row['item_id'];?>', '../functions/delete-module.php?item_id=<?=$item_row['item_id'];?>')" data-dismiss="modal">Yes</button>
        <button class="btn btn-default btn-lg" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>