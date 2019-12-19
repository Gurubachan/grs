
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead class="small">
		<tr>
			<th>Sl#</th>
			<th>Forward To</th>
			<th>Action Taken</th>
			<th>Receive Date</th>
			<th>File Link</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$i=0;
			foreach ($records as $r){
				$i++;
				echo "<tr>
			<td>$i</td>
			<td>$r->forwardto</td>
			<td>$r->remark</td>
			<td>$r->letterdate</td><td>";
				if ($r->letterlink!=""){
					echo "<a id='btnDownload' class='btn btn-sm btn-success' target='_blank' href=\"$r->letterlink\" >View</a>";
				}
			echo"
		</td></tr>";
			}
		?>

		</tbody>
	</table>
</div>
