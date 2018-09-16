<div id="modal-addaccount" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Admin</h4>
      </div>
      <div class="modal-body">
        <span id="addaccount-response">
          <form id="addaccount-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
            <div class="form-group">
              <label class="control-label col-sm-2">E-mail:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control input-lg" name="email" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Password:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control input-lg" name="password" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Firstname:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg" name="firstname" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Lastname:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg" name="lastname" required="true">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <span id="btn-response"> 
                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('addaccount-form', '../functions/save-account.php', 'addaccount-response')">Save</button>
                </span>
              </div>
            </div>
          </form>	
        </span>
      </div>
    </div>
  </div>
</div>        	