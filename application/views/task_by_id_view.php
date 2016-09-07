<h1 style="clear:left;text-align:center">Tasks</h1>
<ul id="list_priority">

<?php if(isset($result)){ foreach ($result as $res){?>
	<li class="list" name="<?php echo $res->t_short_desc;?>" value="<?php  echo $res->t_id ;?>" style="width:auto;height:auto" title="<?php echo $res->t_short_desc ?>">
		<table style="border-left:solid 40px #<?php echo $color; ?>; ?>" id="tasklist">
			<th colspan="2"><h3 ><?php echo $res->t_short_desc;?></h3></th>
			<tr>
				<td style="font-weight:bold">Task ID:</td>
				<td><?php echo $res->t_id;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Description:</td>
				<td><?php echo $res->t_desc;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Owner:</td>
				<td><?php echo $res->t_owner;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Members:</td>
				<td><?php echo $res->t_member;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Priority Area:</td>
				<td><?php echo $res->p_name;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Objective</td>
				<td><?php echo $res->o_name;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Strategy:</td>
				<td><?php echo $res->s_name;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Start Date:</td>
				<td><?php echo date_format(date_create($res->t_start_date),'d-m-Y');?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">End date:</td>
				<td><?php echo date_format(date_create($res->t_end_date),'d-m-Y');?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Linked task:</td>
				<td><?php echo $res->t_link_id;?></td>
			</tr>
			<tr>
				<td style="font-weight:bold">Status:</td>
				<td><?php echo $res->t_status;?></td>
			</tr>
				<tr>
				<td style="font-weight:bold">Reason:</td>
				<td><?php echo $res->reason;?></td>
			</tr>
		</table>
		
	</li>
	<?php }}?>
</ul>
</body>
</html>
