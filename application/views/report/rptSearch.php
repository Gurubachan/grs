<?php
	//print_r($grivance);
?>

<div class="card ">
	<h4 class="card-header card-header-primary">Reports</h4>
	<div class="card-body">
		<table class="table" id="detailsReport">
			<thead>
				<tr>
					<th>Sl#</th>
					<th>Name</th>
					<th>Subject</th>
					<th>Message</th>
					<th>Receive Date</th>
					<th>Receive By</th>
					<th>Referance</th>
					<th>Priority</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody class="text-small">
			<?php
			$i=0;
			foreach ($grivance as $g){
				$i++;
				echo "<tr>
					<td>$i</td>
					<td>".$g['name']."</td>
					<td>".$g['subject']."</td>
					<td>".$g['body']."</td>
					<td>".$g['recivedate']."</td>
					<td>".$g['referby']."</td>
					<td>".$g['receiver']."</td>
					<td>".$g['priority']."</td>
					<td>".$g['statusname']."<br>".$g['effectivedate']."</td>
				</tr>";
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<script>
	$("#detailsReport").dataTable({
		"paging":   false,
		scrollY:'55vh',
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print','colvis'
		]
	});
</script>
