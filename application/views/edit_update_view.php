<div style="clear:left;width:40%" id="task">
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open_multipart('update/updates',$attributes);?>
<?php foreach($result as $res){ $taskid = $res->t_id;?>
<table>
	<caption>
		<h1 style="padding-top:5px;margin-bottom:15px;clear:left" class="reg">Edit Update</h1>
	</caption>
		<tr>
			<td colspan="2">
				<?php echo form_label('Update Name:','uname')?>
				<input style="width:90%;height:25px;margin: 10px 0px" type="text" name="uname" value="<?php echo $res->up_name?>" id="tname"><span class="error sname"></span>
				<span class="error"><?php echo form_error('uname');?></span>
			</td>
		</tr>
		
		<tr>
			<td>
				<?php echo form_label('Type:','type')?>
				<select style="width: 150px;height:25px;margin:5px 0px;" name="type">
					<option <?php echo ($res->up_type == "Progress")? "Selected": ""?> value="Progress">Progress</option>
					<option <?php echo ($res->up_type == "Report")? "Selected": ""?> value="Report">Report</option>
					<option <?php echo ($res->up_type == "Issue")? "Selected": ""?> value="Issue">Issue</option>
					<option <?php echo ($res->up_type == "New contact")? "Selected": ""?> value="New contact">New contact</option>
					<option <?php echo ($res->up_type == "Upload")? "Selected": ""?> value="Upload">Upload</option>
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
				<textarea name="sdesc" cols="67" rows="10" style="margin: 5px 0px" id="sdesc"><?php echo $res->up_desc;?></textarea>
				<span class="error"><?php echo form_error('sdesc');?></span>
			</td>
		</tr>
		<tr>
			<td><input <?php echo ($res->worthy ==1 )? "checked":"" ;?> type="checkbox" name="worthy[]" value="1">Newsworthy ?</td>
			<td><input <?php echo ($res->ceo_report ==1 )? "checked":"";?>  type="checkbox" name="ceo[]" value="1">CEO Report ?</td>
		</tr>
</table>

<p>
	<input type="hidden" value="<?php echo $res->t_id;?>" name="sid" /> 
	<input type="hidden" value="<?php echo $color;?>" name="color" /> 
	<input type="hidden" value="<?php echo $res->up_id;?>" name="uid"/>
	<?php $btn_att = array('class' => 'addbtn')?>
	<?php echo form_submit('submit','Save Update',$btn_att)?>
	<?php if ($this->session->userdata('admin') || ($this->session->userdata('firstname').' '.$this->session->userdata('lastname')) == strtolower($res->t_owner)){?>
	<input type="button" id="Close" style="float:right;" class="addbtn" value="Close">
	<?php }?>
</p>
<?php }?>
<?php echo form_close();?>
</div>
</body>
</html>
<script type="text/javascript">
$("#Close").bind('click', function (e) {
	var uid = '<?php echo $sid;?>';
	$.post('<?php echo base_url().'update/close/'.$sid ;?>',uid,function(data){
		if (data.status == false) {
			 $.each(data.errors, function(key, val) {

	                $('.'+key).html(val);
	            });
        }else{
           window.location.href = "<?php echo base_url().'update/index/'.$taskid.'/'.$color?>"
        }
		},'json');
	});
//	window.location.href = "<?php echo base_url().'report/getCsvForOwner' ?>?sdate="+ sdate +"&edate="+ edate+"&owner="+owner;
 
</script>