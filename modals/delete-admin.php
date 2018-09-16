<div id="modal-deleteadmin<?=$account_row['acc_id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you sure you want to delete account?</p>
        <button type="button" class="btn btn-danger btn-lg" onclick="load_process ('<?=$account_row['acc_id'];?>', '../functions/delete-module.php?acc_id=<?=$account_row['acc_id'];?>&acc_type=<?=$account_row['acc_type'];?>')" data-dismiss="modal">Yes</button>
        <button class="btn btn-default btn-lg" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>