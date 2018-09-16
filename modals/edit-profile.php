<div id="modal-editprofile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Profile</h4>
      </div>
      <div class="modal-body">
      	<span id="profile-response">
          <form id="profile-form" class="form-horizontal" autocomplete="off" onsubmit="loading ('btn-response')" method="POST">
            <input type="hidden" name="acc_id" value="<?=$acc_row['acc_id'];?>">
            <div class="form-group">
              <label class="control-label col-sm-2">Firstname:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg" name="firstname" value="<?=$cos_row['firstname'];?>" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Lastname:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg" name="lastname" value="<?=$cos_row['lastname'];?>" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Birthdate:</label>
              <div class="col-sm-10">
                <input type="date" class="form-control input-lg" name="birthdate" value="<?=$cos_row['birthdate'];?>" required="true">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Gender:</label>
              <div class="col-sm-10">
                <select class="form-control input-lg" name="gender" value="<?=$cos_row['firstname'];?>" required="true">
                	<option <?php if($cos_row['gender'] == "Male"){ echo "selected='selected'";}?> value="Male">Male</option>
                	<option <?php if($cos_row['gender'] == "Female"){ echo "selected='selected'";}?> value="Female">Female</option>
                	<option>Select gender...</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Address:</label>
              <div class="col-sm-10">
                <textarea class="form-control input-lg" name="address" required="true"><?=$cos_row['address'];?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Profile Photo:</label>
              <div class="col-sm-10">
                <input type="file" class="form-control input-lg" name="profile_photo" required="true">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <span id="btn-response"> 
                <button type="submit" class="btn btn-danger btn-lg" onclick="form_process ('profile-form', '../functions/update-profile.php', 'profile-response')">Update</button>
                </span>
              </div>
            </div>
          </form>
        </span>
      </div>
    </div>
  </div>
</div>      	