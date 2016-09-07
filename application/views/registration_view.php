<div style="width:90%;margin:auto">
<h1 class="reg">Manage Users</h1><br/>
<table style="width:100%" border="1">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Is Activated?</th>
		<th>Is Admin User?</th>
	</tr>
	<?php foreach($user as $u){?>
	<tr>
		<td><?php echo $u->u_name;?></td>
		<td><?php echo $u->u_last_name;?></td>
		<td><?php echo $u->u_email;?></td>
		<td><input class="status_checkbox" id="<?php echo $u->u_id;?>" type="checkbox" <?php echo ($u->u_status ==0)? "checked":"";?> name="status[]"/></td>
		<td><input class="admin_checkbox" id="<?php echo $u->u_id;?>" type="checkbox" <?php echo ($u->admin == 0)? "":"checked";?> name="admin[]"/></td>
	</tr>
	<?php }?>
</table>
</div>
</br></br></br>
<hr/>
<div style="padding:0px" id="login">
<h1 class="reg">Registration</h1>
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open('admin/registration',$attributes); ?>
<p>
	<?php echo form_label('First Name:','fname')?>
	<?php echo form_input('fname','','id="fname"')?>
	<?php echo form_error('fname', '<span class="error">', '</span>'); ?>
</p>
<p>
	<?php echo form_label('Last Name:','lname')?>
	<?php echo form_input('lname','','id="lname"')?>
	<?php echo form_error('lname', '<span class="error">', '</span>'); ?>
</p>
<p>
	<?php echo form_label('Email Address:','email')?>
	<?php echo form_input('email','','id="email"')?>
	<?php echo form_error('email', '<span class="error">', '</span>'); ?>
</p>
<p>
	<?php echo form_label('Password:','password')?>
	<?php echo form_password('password','','id="password"')?>
	<?php echo form_error('password', '<span class="error">', '</span>'); ?>
</p>
<p>
	<?php echo form_label('Confirm Password:','cpassword')?>
	<?php echo form_password('cpassword','','id="cpassword"')?>
	<?php echo form_error('cpassword', '<span class="error">', '</span>'); ?>
</p>
<p>
	<?php $btn_att = array('class' => 'smbtn')?>
	<?php echo form_submit('submit','Register',$btn_att)?>
</p>
<?php echo form_close();?>
</div>
</body>
</html>
<script type="text/javascript">
$('.status_checkbox').bind('click', function() {
	var id = $(this).attr('id');
    if($(this).is(":checked")) {
    	$.get('<?php echo base_url()."admin/updateStatus/0/" ;?>'+id,function(data){});
    } else {
    	$.get('<?php echo base_url()."admin/updateStatus/1/" ;?>'+id,function(data){});
    }
});
$('.admin_checkbox').bind('click', function() {
	var id = $(this).attr('id');
    if($(this).is(":checked")) {
    	$.get('<?php echo base_url()."admin/updateAdmin/1/" ;?>'+id,function(data){});
    } else {
    	$.get('<?php echo base_url()."admin/updateAdmin/0/" ;?>'+id,function(data){});
    }
});

</script>