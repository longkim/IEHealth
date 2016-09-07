<div style="clear:left;width:40%" id="task">
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open_multipart('update/create',$attributes);?>
<table>
	<caption>
		<h1 style="padding-top:5px;margin-bottom:15px;clear:left" class="reg">Add New Update</h1>
	</caption>
		<tr>
			<td colspan="2">
				<?php echo form_label('Update Name:','uname')?>
				<input style="width:90%;height:25px;margin: 10px 0px" type="text" name="uname" value="" id="tname"><span class="error sname"></span>
				<span class="error"><?php echo form_error('uname');?></span>
			</td>
		</tr>
		
		<tr>
			<td>
				<?php echo form_label('Type:','type')?>
				<select style="width: 150px;height:25px;margin:5px 0px;" name="type">
					<option value="Progress">Progress</option>
					<option value="Report">Report</option>
					<option value="Issue">Issue</option>
					<option value="New contact">New contact</option>
					<option value="Upload">Upload</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo form_label('Document Upload:','file')?>
				 <input type="file" name="userfile" accept="file_extension">
				<span class="error"><?php if (isset($error)){echo($error['error']);}?></span>
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
			<td><input type="checkbox" name="worthy[]" value="1">Newsworthy ?</td>
			<td><input type="checkbox" name="ceo[]" value="1">CEO Report ?</td>
		</tr>
</table>

<p>
	<input type="hidden" value="<?php echo $sid;?>" name="sid" /> 
	<input type="hidden" value="<?php echo $color;?>" name="color" /> 
	<?php $btn_att = array('class' => 'addbtn')?>
	<?php echo form_submit('submit','Add Update',$btn_att)?>
</p>
<?php echo form_close();?>
</div>
</body>
</html>
