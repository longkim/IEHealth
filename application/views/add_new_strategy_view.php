<script>

$('document').ready(function(){
	$('form.loginform').on('submit',function(form){
		$('.sname').html('');
		$('.sdesc').html('');
		form.preventDefault();
		var p = $("form.loginform").serialize();
		$.post('<?php echo base_url()."strategy/create/".$oid ;?>',p,function(data){
			if (data.status == false) {
				 $.each(data.errors, function(key, val) {

		                $('.'+key).html(val);
		            });
	        }else{
	           location.reload();
	        }
			},'json');
		});
});


</script>
<div id="dialog">
<h1 style="padding-top:5px" class="reg">Add New Strategy</h1>
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open('strategy/create',$attributes); ?>
<p>
	<?php echo form_label('Strategy Name:','sname')?>
	<?php echo form_input('sname','','id="sname"')?>
	<span class="error sname"></span>
</p>
<p>
	<?php echo form_label('Description:','sdesc')?>
	<?php echo form_textarea('sdesc','',array('id' => 'sdesc', 'rows' => '10','cols'=>'20'))?>
	<span class="error sdesc"></span>
</p>
<p>
	<?php $btn_att = array('class' => 'smbtn')?>
	<?php echo form_submit('submit','Register',$btn_att)?>
</p>
<?php echo form_close();?>
</div>
</body>
</html>

