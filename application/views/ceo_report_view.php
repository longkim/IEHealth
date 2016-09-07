<div id="ceo">
	<h1 style="clear:both;color:#888888;text-align:center">CEO Report</h1>
	<?php if (!isset($report)){?>
	<h3>Please select start data and end date to begin:</h3>
	<form action="" method="get">
		<label>Start Date</label>
		<input type="date" value="<?php echo isset($sdate)? $sdate:""; ?>" name="sdate"/>
		<label>End Date</label>
		<input type="date" value="<?php echo isset($edate)? $edate:""; ?>" name="edate"/></br>
		<input style="margin:10px 0px" type="submit" value="Get Report"/>
	</form>
	<?php }?>
<?php if(isset($sdate) && isset($edate)){?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

		var staOptions = {
		  title: "Tasks Status From <?php echo $sdate; ?> to <?php echo $edate; ?>",
		  titleTextStyl:{fontSize:"25px"},
		  pieHole: 0.2,
		  is3D: true,
		};
        
        var staChart = new google.visualization.PieChart(document.getElementById('ceo_task_status'));

		var statusData = google.visualization.arrayToDataTable([
			['Tasks', 'Status'],
			['Completed',     <?php echo $TotalStatus->Completed;?>],
			['Delayed',     <?php echo $TotalStatus->Delay;?>],
			['Never Started',     <?php echo $TotalStatus->Never_started;?>],
			['Not Started',   <?php echo $TotalStatus->Not_started;?>],
			['Open',   <?php echo $TotalStatus->Open;?>],
		 ]);


		function selectHandler() {
	            var selectedItem = staChart.getSelection()[0];
	            if (selectedItem) {
	              var topping = statusData.getValue(selectedItem.row, 0);
	              alert('The user selected ' + topping);
	            }
	          }
        staChart.draw(statusData, staOptions);
        google.visualization.events.addListener(staChart, 'select', selectHandler);       
      }
</script>



<div style="height:auto">
	<h1 style="clear:both;color:#888888;text-align:center">CEO Report From <?php echo date('d/m/Y',strtotime($sdate));?> To <?php echo date('d/m/Y',strtotime($edate));?></h1>
	<div  style="width: 900px; height: 500px;" id="ceo_task_status"></div>
	<h1 style="clear:both;color:#888888;text-align:center">Summary of New Updates</h1>
	<div id="priority_area"><?php if (isset($result)){?>
<ul id="list_priority">
<?php foreach ($result as $res){ ?>
	<li class="list" name="<?php echo $res->up_name;?>" value="<?php  echo $res->up_id ;?>" style="width:auto;height:auto" title="<?php echo $res->up_name ?>">
		<table cellspacing="7" style="border-left:solid 40px royalblue; ?>; width:320px" id="tasklist">
			<th colspan="2"><h3 ><?php echo $res->up_name;?></h3></th>
			<tr>
				<td style="font-weight:bold">Strategy Description</td>
				<td><?php echo $res->s_description;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Update Description:</td>
				<td><?php echo $res->up_desc;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Type:</td>
				<td><?php echo $res->up_type;?></td>
			</tr>	
			<tr>
				<td></td>
			</tr>			
		</table>
		
	</li>
	<?php }?>

</ul></div>
	<?php if(!isset($report)){?>
	<div style="clear:left;text-align:center;height:60px"><a target="_blank" href="<?php echo base_url().'report/ceo?sdate='.$sdate.'&edate='.$edate.'&report=1'?>"><button style="width:100px">Generate Report</button></a></div>
	<?php }?>
<?php  }?>
</div>
</div>
<?php } ?>
</body>
</html>