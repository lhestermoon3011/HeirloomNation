<div id="modal-adminsettings" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Account Settings</h4>
      </div>
      <div class="modal-body">
        <span id="adsettings-response">
          <form id="adsettings-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
            <div class="form-group">
              <label class="control-label col-sm-2">E-mail:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control input-lg" value="<?=$acc_row['email'];?>" name="email" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Old Password:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control input-lg" name="old_password" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">New Password:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control input-lg" name="new_pass" required="true">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <span id="btn-response"> 
                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('adsettings-form', '../functions/admin-accountsettings.php', 'adsettings-response')">Update</button>
                </span>
              </div>
            </div>
          </form>	
        </span>
      </div>
    </div>
  </div>
</div>        	