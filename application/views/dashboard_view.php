
 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['New Updates', 'Hours per Day'],
          ['New Updates',     <?php echo $NewUpdate;?>],
          ['Old Updates',      <?php echo ($TotalUpdate - $NewUpdate);?>],
        ]);
		
        var options = {
          title: 'Updates'
        };

		var staOptions = {
		  title: "Tasks Status",
		  pieHole: 0.2,
		};
        var chart = new google.visualization.PieChart(document.getElementById('updates'));

//        function selectHandler() {
//            var selectedItem = chart.getSelection()[0];
//            if (selectedItem) {
//              var topping = data.getValue(selectedItem.row, 0);
//              
//              alert('The user selected ' + topping);
//            }
//          }

	

//        google.visualization.events.addListener(chart, 'select', selectHandler);            
        
        var staChart = new google.visualization.PieChart(document.getElementById('status'));

		var statusData = google.visualization.arrayToDataTable([
 			['New Updates', 'Hours per Day'],
			['Completed',     <?php echo $TotalStatus->Completed;?>],
			['Delayed',     <?php echo $TotalStatus->Delay;?>],
			['Never Started',     <?php echo $TotalStatus->Never_started;?>],
			['Not Started',   <?php echo $TotalStatus->Not_started;?>],
			['Open',   <?php echo $TotalStatus->Open;?>],
		 ]);

		function statusSelectHandler(){
			var selectedItem = staChart.getSelection()[0];
            if (selectedItem) {
              var topping = statusData.getValue(selectedItem.row, 0);
              window.open("<?php echo base_url().'task/taskType/'?>"+topping,"_blank");
//              alert('The user selected ' + topping);
            }

		}
		
		google.visualization.events.addListener(staChart, 'select', statusSelectHandler);    
		
        chart.draw(data, options);
        staChart.draw(statusData, staOptions);
      }
    </script>

<div id="dashboard">
	<table style="margin:10px auto">
		<tr>
			<td><div id="updates" style="border: 2px solid blue;width: 500px; height: 200px;"></div></td>
			<td><div id="status" style="border: 2px solid blue;width: 500px; height: 200px;"></div></td>
			<td>
				<table>
					<tr>
						<td><h4>Total Newsworthy Updates:</h4></td>
						<td><h4><?php echo $TotalWorthyNews;?></h4></td>
					</tr>
					<tr>
						<td><h4>Total Overdue Tasks:</h4></td>
						<td><h4><?php echo $OverdueTasks;?></h4></td>
					</tr>
					<tr>
						<td><h4>Updates Closed This Week:</h4></td>
						<td><h4><?php echo $CloseThisWeekTasks;?></h4></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table border="1" style="width:95%;margin:auto">
		<caption><h1>Updated This Week</h1></caption>
		<tr>
			<th>Priority</th>
			<th>Objective</th>
			<th>Strategy</th>
			<th>Task</th>
			<th>Owner</th>
			<th>Due</th>
			<th>Status</th>
			<th>Update</th>
			<th>Newsworthy</th>
<!--			<th>CEO Report</th>-->
		</tr>
		<?php foreach ($UpdateThisWeek as $u){?>
			<tr>
				<td width="15%"><?php echo $u->p_name?></td>
				<td><?php echo $u->o_name?></td>
				<td><?php echo $u->s_name?></td>
				<td><?php echo $u->t_short_desc?></td>
				<td><?php echo $u->t_owner?></td>
				<td><?php echo $u->t_end_date?></td>
				<td><?php echo $u->t_status?></td>
				<td><?php echo $u->up_desc?></td>
				<td><input uid="<?php echo $u->up_id ?>" class="worthy" type="checkbox" name="worthy[]"></td>
<!--				<td><input type="checkbox" name="ceo[]" <?php echo ($u->ceo_report == 1) ? "checked":""?> ></td>-->
			</tr>
		<?php }?>
<!--		<tr>-->
<!--			<td colspan="10"><input type="button" onclick="window.location.href='<?php echo base_url().'dashboard/sendmail'?>'" style="float:right" class="addbtn" value="Send Mail"></td>-->
<!--		</tr>-->
	</table>
</div>
</body>
</html>
<script type="text/javascript">
$('.worthy').click(function() {
    if ($(this).is(':checked')) {
          var uid= $(this).attr("uid");
    	  window.location.href="<?php echo base_url().'dashboard/sendmail/'?>"+uid;
    }else{
    	 
        }
});

</script>