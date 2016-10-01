
	<h1>System Overview</h1>
	
	<div id="body">
	
	<table class="table table-striped table-hover ">
	  <thead>
		<tr>
		  <th>System</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
	    if ($systems->num_rows() > 0) {
			foreach ($systems->result() as $row)
			{
					echo "<tr><td><a href=".base_url('/')."system/details/".$row->system_name."/>".$row->system_name."</a></td></tr>";
			}
		} else {
			echo "<tr><td>No systems found!</td></tr>";
		}
	  ?>
	  </tbody>
	</table>
	
	</div>
