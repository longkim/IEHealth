<div id="ceo">
	<h1 style="clear:both;color:#888888;text-align:center">Adhoc Report</h1>
	<?php if (!isset($report)){?>
	<span class="error"><?php echo (isset($error) ? $error : "");?></span>
	<h3>Please select start data and end date to begin:</h3>
	<form action="" method="post">
		<label>Start Date</label>
		<input type="date" value="<?php echo isset($sdate)? $sdate:""; ?>" name="sdate"/>
		<label>End Date</label>
		<input type="date" value="<?php echo isset($edate)? $edate:""; ?>" name="edate"/></br>
<!--		<input style="margin:10px 0px" type="submit" value="Get Report"/>-->
		<table>
			<tr>
				<td><h3>Filter By Owner</h3></td>
				<td>
					<select name="owner">
						<option value="">Select Owner:</option>
						<?php foreach ($user as $u){?>
						<option value="<?php echo $u->u_name.' '.$u->u_last_name?>"><?php echo $u->u_name.' '.$u->u_last_name?></option>
						<?php }?>
					</select>
				</td>
				<td>
					<input type="submit" value="Display Result"/>
				</td>
				<td>
					<input type="button" onclick="$('#owner_result').hide();" value="Hide Result"/>
				</td>
			</tr>
			<?php if(isset($owner)){?>
			<tr>
				<table id="owner_result" border="1">
						<tr>
							<th>Priority</th>
							<th>Strategy</th>
							<th>Objective</th>
							<th>Task Name</th>
							<th>Task Owner</th>
							<th>Team Members</th>
							<th>Status</th>
							<th>Due</th>
						</tr>
					<?php foreach($owner as $o){?>
						<tr>
							<td><?php echo $o->p_name?></td>
							<td><?php echo $o->s_name?></td>
							<td><?php echo $o->o_name?></td>
							<td><?php echo $o->t_short_desc?></td>
							<td><?php echo $o->t_owner?></td>
							<td><?php echo $o->t_member?></td>
							<td><?php echo $o->t_status?></td>
							<td><?php echo $o->t_end_date?></td>
						</tr>
					<?php }?>
						<tr>
							<td style="text-align:center" colspan="8">
								<input id="export_owner" type="button" value="Export">
							</td>
						</tr>
				</table>
			</tr>
			<?php }?>
			<table>
			<tr>
				<td><h3>Filter By Status Of Task</h3></td>
				<td>
					<select name="status">
						<option value="">Select Status:</option>
						<option value="Open">Open</option>
						<option value="Completed">Completed</option>
						<option value="Delayed">Delayed</option>
						<option value="Not Started">Not Started</option>
						<option value="Never Started">Never Started</option>
					</select>
				</td>
				<td>
					<input type="submit" value="Display Result"/>
				</td>
				<td>
					<input type="button" onclick="$('#status_result').hide();" value="Hide Result"/>
				</td>
			</tr>
			<?php if(isset($status)){?>
			<tr>
				<table id="status_result" border="1">
						<tr>
							<th>Priority</th>
							<th>Strategy</th>
							<th>Objective</th>
							<th>Task Name</th>
							<th>Task Owner</th>
							<th>Team Members</th>
							<th>Status</th>
							<th>Due</th>
						</tr>
					<?php foreach($status as $o){?>
						<tr>
							<td><?php echo $o->p_name?></td>
							<td><?php echo $o->s_name?></td>
							<td><?php echo $o->o_name?></td>
							<td><?php echo $o->t_short_desc?></td>
							<td><?php echo $o->t_owner?></td>
							<td><?php echo $o->t_member?></td>
							<td><?php echo $o->t_status?></td>
							<td><?php echo $o->t_end_date?></td>
						</tr>
					<?php }?>
						<tr>
							<td style="text-align:center" colspan="8">
								<input id="export_status" type="button" value="Export">
							</td>
						</tr>
				</table>
			</tr>
			<?php }?>
			</table>
			<table>
			<tr>
				<td><h3>Filter By Priority Area</h3></td>
				<td>
					<select name="priority">
						<option value="">Select Priority:</option>
						<?php foreach($plist as $p){?>
						<option value="<?php echo $p->p_id?>"><?php echo $p->p_name;?></option>
						<?php }?>
					</select>
				</td>
				<td>
					<input type="submit" value="Display Result"/>
				</td>
				<td>
					<input type="button" onclick="$('#p_result').hide();" value="Hide Result"/>
				</td>
			</tr>
			<?php if(isset($priority)){?>
			<tr>
				<table id="p_result" border="1">
						<tr>
							<th>Priority</th>
							<th>Strategy</th>
							<th>Objective</th>
							<th>Task Name</th>
							<th>Task Owner</th>
							<th>Team Members</th>
							<th>Status</th>
							<th>Due</th>
						</tr>
					<?php foreach($priority as $o){?>
						<tr>
							<td><?php echo $o->p_name?></td>
							<td><?php echo $o->s_name?></td>
							<td><?php echo $o->o_name?></td>
							<td><?php echo $o->t_short_desc?></td>
							<td><?php echo $o->t_owner?></td>
							<td><?php echo $o->t_member?></td>
							<td><?php echo $o->t_status?></td>
							<td><?php echo $o->t_end_date?></td>
						</tr>
					<?php }?>
						<tr>
							<td style="text-align:center" colspan="8">
								<input id="export_p" type="button" value="Export">
							</td>
						</tr>
				</table>
			</tr>
			<?php }?>
			</table>
			<table>
			<tr>
				<td><h3>Filter By Type of Update</h3></td>
				<td>
					<select name="update">
						<option value="">Select Type:</option>
						<option value="Progress">Progress</option>
						<option value="Report">Report</option>
						<option value="Issue">Issue</option>
						<option value="New Contact">New Contact</option>
						<option value="Upload">Upload</option>
						<option value="news">Newsworthy</option>
					</select>
				</td>
				<td>
					<input type="submit" value="Display Result"/>
				</td>
				<td>
					<input type="button" onclick="$('#u_result').hide();" value="Hide Result"/>
				</td>
			</tr>
			<?php if(isset($update)){?>
			<tr>
				<table id="u_result" border="1">
						<tr>
							<th>Priority</th>
							<th>Strategy</th>
							<th>Objective</th>
							<th>Task Name</th>
							<th>Update Name</th>
							<th>Task Owner</th>
							<th>Team Members</th>
							<th>Update Type</th>
							<th>Due</th>
						</tr>
					<?php foreach($update as $o){?>
						<tr>
							<td><?php echo $o->p_name?></td>
							<td><?php echo $o->s_name?></td>
							<td><?php echo $o->o_name?></td>
							<td><?php echo $o->t_short_desc?></td>
							<td><?php echo $o->up_name?></td>
							<td><?php echo $o->t_owner?></td>
							<td><?php echo $o->t_member?></td>
							<td><?php echo $o->up_type?></td>
							<td><?php echo $o->t_end_date?></td>
						</tr>
					<?php }?>
						<tr>
							<td style="text-align:center" colspan="9">
								<input id="export_update" type="button" value="Export">
							</td>
						</tr>
				</table>
			</tr>
			<?php }?>
			</table>
		</table>
	</form>
	<?php }?>
</div>
<script type="text/javascript">
<?php if(isset($owner)){?>
$("#export_owner").bind('click', function (e) {
	var sdate = "<?php echo $sdate?>";
	var edate = "<?php echo $edate?>";
	var owner = "<?php echo $owners?>";
	window.location.href = "<?php echo base_url().'report/getCsvForOwner' ?>?sdate="+ sdate +"&edate="+ edate+"&owner="+owner;
  
})
<?php }?>
<?php if(isset($status)){?>
$("#export_status").bind('click', function (e) {
	var sdate = "<?php echo $sdate?>";
	var edate = "<?php echo $edate?>";
	var status = "<?php echo $statuses?>";
	window.location.href = "<?php echo base_url().'report/getCsvForStatus' ?>?sdate="+ sdate +"&edate="+ edate+"&status="+status;
  
})
<?php }?>
<?php if(isset($priority)){?>
$("#export_p").bind('click', function (e) {
	var sdate = "<?php echo $sdate?>";
	var edate = "<?php echo $edate?>";
	var priority = "<?php echo $priorities?>";
	window.location.href = "<?php echo base_url().'report/getCsvForPriority' ?>?sdate="+ sdate +"&edate="+ edate+"&priority="+priority;
  
})
<?php }?>
<?php if(isset($update)){?>
$("#export_update").bind('click', function (e) {
	var sdate = "<?php echo $sdate?>";
	var edate = "<?php echo $edate?>";
	var update = "<?php echo $updates?>";
	window.location.href = "<?php echo base_url().'report/getCsvForUpdate' ?>?sdate="+ sdate +"&edate="+ edate+"&update="+update;
  
})
<?php }?>


</script>