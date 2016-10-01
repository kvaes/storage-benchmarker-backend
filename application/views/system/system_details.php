
	<h1>System Details</h1>
	
	<div id="body">
	
	<table class="table table-striped table-hover ">
	  <thead>
		<tr>
		  <th>Tests Results for system <?php echo $system_name;?></th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
	    echo "<tr><td><a href=".base_url('/system/compare/'.$system_name.'/').">Compare</a></td><td>All Results</td></tr>";
		foreach ($results->result() as $row)
		{
				echo "<tr><td><a href=".base_url('/')."system/results/".$system_name."/".$row->metric_unixdate."/>".$row->metric_unixdate."</a></td><td>".$row->metric_scenario."</td></tr>";
		}
	  ?>
	  </tbody>
	</table>
	
	</div>
