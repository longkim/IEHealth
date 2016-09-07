<div style="clear:left" id="task">
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open('task/create',$attributes); ?>
<table>
	<caption>
		<h1 style="padding-top:5px;margin-bottom:15px;clear:left" class="reg">Add New Task</h1>
	</caption>
		<tr>
			<td colspan="2">
				<?php echo form_label('Task Name:','tname')?>
				<input style="width:90%;height:25px;margin: 10px 0px" type="text" name="tname" value="" id="tname"><span class="error sname"></span>
				<span class="error"><?php echo form_error('tname');?></span>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo form_label('Owner:','owner')?>
				<select style="width: 150px;height:25px" name="owner">
					<?php foreach ($users as $user){?>
						<option value="<?php echo ucfirst($user->u_name).' '.ucfirst($user->u_last_name);?>"><?php echo ucfirst($user->u_name).' '.ucfirst($user->u_last_name);?></option>
					<?php } ?>
				</select>
			</td>
			<td>
				<table>
				<tr><td>
				<?php echo form_label('Team Members:','member')?></td><td>
				<?php foreach ($users as $user){?>
				<input type="checkbox" name="member[]" value="<?php echo ucfirst($user->u_name).' '.ucfirst($user->u_last_name);?>"/>
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
					<option value="Open">Open</option>
					<option value="Completed">Completed</option>
					<option value="Delayed">Delayed</option>
					<option value="Not Started">Not Started</option>
					<option value="Never Started">Never Started</option>
				</select>
				
			</td>
		</tr>
		<tr class="reason" style="display:none">
			<td colspan="2">
				<?php echo form_label('Reason:','reason')?><br/>
				<textarea name="reason" cols="67" rows="10" style="margin: 5px 0px" id="reason_text"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo form_label('Description:','sdesc')?></br>
				<textarea name="sdesc" cols="67" rows="10" style="margin: 5px 0px" id="sdesc"></textarea>
				<span class="error"><?php echo form_error('sdesc');?></span>
			</td>
			
		</tr>
		<tr>
			<td><?php echo form_label('Start Date:','sdate')?><input style="width: 150px;" type="date" name="sdate" value=""/><span class="error"><?php echo form_error('sdate');?></span></td>
			<td><?php echo form_label('End Date:','edate')?><input style="width: 150px;" type="date" name="edate" value=""/><span class="error"><?php echo form_error('edate');?></span></td>
		</tr>
		<tr>
			<td><?php echo form_label('Linked Task ID:','linkid')?><input style="width: 150px;height:25px;margin:10px 0px;" type="text" name="linkid" value=""/><span class="error"><?php echo form_error('linkid');?></span></td>
		</tr>
</table>

<p>
	<input type="hidden" value="<?php echo $sid;?>" name="sid" /> 
	<input type="hidden" value="<?php echo $color;?>" name="color" /> 
	<?php $btn_att = array('class' => 'addbtn')?>
	<?php echo form_submit('submit','Add Task',$btn_att)?>
</p>
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
