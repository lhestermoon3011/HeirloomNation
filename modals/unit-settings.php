<div id="modal-unitsettings" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Unit Settings</h4>
      </div>
      <div class="modal-body">
      	<span id="response-unit">
      		<form id="form-unit">
			  <div class="input-group">
			    <input type="text" class="form-control input-lg" name="unit_name" placeholder="Enter new unit of an item..." required="true">
			    <div class="input-group-btn">
			      <button class="btn btn-danger btn-lg" type="submit" onclick="form_process ('form-unit', '../functions/save-unit.php', 'response-unit')">Add</button>
			    </div>
			  </div>
			</form>
      	</span>
		<hr>
		<div class="panel-group" id="display-response">
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				setInterval(function(){
				$('#display-response').load('../functions/reload-unit.php');
				}, 2500);
			});
		</script>
      </div>
    </div>
  </div>
</div>      	