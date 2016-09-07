<div style="clear:left" id="task">
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open('task/update',$attributes); ?>
<?php foreach($result as $res){ $members = explode(',',$res->t_member); ?>
<table>
	<caption>
		<h1 style="padding-top:5px;margin-bottom:15px;clear:left" class="reg">Edit Task</h1>
	</caption>
		<tr>
			<td colspan="2">
				<?php echo form_label('Task Name:','tname')?>
				<input style="width:90%;height:25px;margin: 10px 0px" type="text" name="tname" value="<?php echo $res->t_short_desc ?>" id="tname"><span class="error sname"></span>
				<span class="error"><?php echo form_error('tname');?></span>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo form_label('Owner:','owner')?>
				<select style="width: 150px;height:25px" name="owner">
					<?php foreach ($users as $user){?>
						<option <?php echo ($res->t_owner == ucfirst($user->u_name).' '.ucfirst($user->u_last_name))? "selected":""?> value="<?php echo ucfirst($user->u_name).' '.ucfirst($user->u_last_name);?>"><?php echo ucfirst($user->u_name).' '.ucfirst($user->u_last_name);?></option>
					<?php } ?>
				</select>
			</td>
			<td>
				<table>
				<tr><td>
				<?php echo form_label('Team Members:','member')?></td><td>
				<?php foreach ($users as $user){ ?>
				<input <?php echo (in_array(ucfirst($user->u_name).' '.ucfirst($user->u_last_name), $members) ? "checked":"")?> type="checkbox" name="member[]" value="<?php echo ucfirst($user->u_name).' '.ucfirst($user->u_last_name);?>"/>
				<span  style="font-family:inherit" ><?php echo ucfirst($user->u_name).' '.ucfirst($user->u_last_name);?></span></br>
				<?php } ?>
				</td></tr>
				<tr><td colspan="2"><span class="error"><?php echo form_error('member[]');?></span></td></tr>
				</table>
				
			</td>
			
		</tr>
		<tr>
			<td>
				<?php echo form_label('Status:','status')?>
				<select id="reason" style="width: 150px;height:25px;margin:5px 0px;" name="status">
					<option <?php echo ($res->t_status == "Open")? "Selected":""?> value="Open">Open</option>
					<option <?php echo ($res->t_status == "Completed")? "Selected":""?> value="Completed">Completed</option>
					<option <?php echo ($res->t_status == "Delayed")? "Selected":""?> value="Delayed">Delayed</option>
					<option <?php echo ($res->t_status == "Not Started")? "Selected":""?> value="Not Started">Not Started</option>
					<option <?php echo ($res->t_status == "Never Started")? "Selected":""?> value="Never Started">Never Started</option>
				</select>
				
			</td>
		</tr>
		<tr class="reason" <?php echo ($res->t_status == "Delayed" || $res->t_status == "Never Started") ? "" :"style='display:none'"?> >
			<td colspan="2">
				<?php echo form_label('Reason:','reason')?><br/>
				<textarea name="reason" cols="67" rows="10" style="margin: 5px 0px" id="reason_text"><?php echo $res->reason?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo form_label('Description:','sdesc')?></br>
				<textarea name="sdesc" cols="67" rows="10" style="margin: 5px 0px" id="sdesc"><?php echo $res->t_desc;?></textarea>
				<span class="error"><?php echo form_error('sdesc');?></span>
			</td>
			
		</tr>
		<tr>
			<td><?php echo form_label('Start Date:','sdate')?><input style="width: 150px;" type="date" name="sdate" value="<?php echo $res->t_start_date; ?>"/><span class="error"><?php echo form_error('sdate');?></span></td>
			<td><?php echo form_label('End Date:','edate')?><input style="width: 150px;" type="date" name="edate" value="<?php echo $res->t_end_date; ?>"/><span class="error"><?php echo form_error('edate');?></span></td>
		</tr>
		<tr>
			<td><?php echo form_label('Linked Task ID:','linkid')?><input style="width: 150px;height:25px;margin:10px 0px;" type="text" name="linkid" value="<?php echo $res->t_link_id; ?>"/><span class="error"><?php echo form_error('linkid');?></span></td>
		</tr>
</table>

<p>
	<input type="hidden" value="<?php echo $res->s_id;?>" name="sid" /> 
	<input type="hidden" value="<?php echo $color;?>" name="color" /> 
	<input type="hidden" value="<?php echo $res->t_id;?>" name="tid"/>
 	<?php $btn_att = array('class' => 'addbtn')?>
	<?php echo form_submit('submit','Save Task',$btn_att)?>
</p>
<?php }?>
<?php echo form_close();?>
</div>
</body>
</html>
<script type="text/javascript">
$("#reason").change(function(){
	var a = $(this).val();
	if(a == "Delayed" || a == "Never Started"){
		$(".reason").show();
	}else{
		$(".reason").hide();
		$("#reason_text").val("");
	}
})

</script>