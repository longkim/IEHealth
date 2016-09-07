<div style="clear:left" id="task">
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open('dashboard/sendmail',$attributes); ?>
<table>
	<caption>
		<h1 style="padding-top:5px;margin-bottom:15px;clear:left" class="reg">Send Mail To Comms Manager</h1>
	</caption>
		<tr>
			<td colspan="2">
				<?php echo form_label('Comms Manager Name:','cname')?>
				<input style="width:90%;height:25px;margin: 10px 0px" type="text" name="cname" value="" id="tname">
				<span class="error"><?php echo form_error('cname');?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo form_label('Comms Manager Email:','cemail')?>
				<input style="width:90%;height:25px;margin: 10px 0px" type="text" name="cemail" value="" id="cemail">
				<span class="error"><?php echo form_error('cemail');?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo form_label('Email Subject:','subject')?>
				<input style="width:90%;height:25px;margin: 10px 0px" type="text" name="subject" value="" id="subject">
				<span class="error"><?php echo form_error('subject');?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo form_label('Content:','content')?><br/>
				<textarea name="content" cols="67" rows="10" style="margin: 5px 0px">
				</textarea>
				<span class="error"><?php echo form_error('content');?></span>
			</td>
		</tr>
		
		
</table>
<p>
	<input type="hidden" value="<?php echo $uid;?>" name="uid"/> 
	<?php $btn_att = array('class' => 'addbtn')?>
	<?php echo form_submit('submit','Send',$btn_att)?>
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
