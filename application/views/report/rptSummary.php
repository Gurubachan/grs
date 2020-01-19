<?php
	//print_r($category);
	foreach($category as $c=>$v){
		$summary[$c]=array_count_values($v);
		/*echo $c;
		print_r( array_count_values($v));*/
	}

	//print_r($summary);

?>
<div class="card ">
	<h4 class="card-header card-header-primary">Reports</h4>
	<div class="card-body">
		<table class="table" id="detailsReport">
			<thead>
			<tr>
				<th>Sl#</th>
				<th>Category</th>
				<th>View</th>
				<th>Pending</th>
				<th>Process</th>
				<th>Resolved</th>
			</tr>
			</thead>
			<tbody class="text-small">
			<?php
			$i=0;
			foreach ($summary as $s=>$sv){
				$i++;
				$view=0;
				$pending=0;
				$process=0;
				$resolved=0;
				foreach($sv as $k=>$v){
					$view +=($k=="View")?$v:0;
					$pending +=($k=="Pending")?$v:0;
					$process +=($k=="Process")?$v:0;
					$resolved +=($k=="Resolved")?$v:0;


				}
				echo "<tr>
					<td>$i</td>
					<td>".$s."</td>
					<td>".$view."</td>
					<td>".$pending."</td>
					<td>".$process."</td>
					<td>".$resolved."</td>

				</tr>";
			}
			foreach ($category as $g){

			}
			?>
			</tbody>
		</table>
	</div>
</div>

