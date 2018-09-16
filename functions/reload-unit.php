<?php
	include "config.php";

	$unit_query = $conn->query("select * from units_tbl");
	while ($unit_row = $unit_query->fetch()) {
	?>
	<span id="unit<?=$unit_row['unit_id'];?>">	
		<div class="panel panel-default">
			<div class="panel-body padding-sm">
				<button class="pull-right btn-default btn-lg no-border" onclick="load_process ('unit<?=$unit_row['unit_id'];?>', '../functions/delete-module.php?unit_id=<?=$unit_row['unit_id'];?>')" title="Remove this unit"><i class="fa fa-times fa-fw"></i></button>
					<h4 class="margin-left"><?=$unit_row['unit_name'];?></h4>
			</div>
		</div>
	</span>	
	<?php
	}
?>