<!--<script src="<?php echo asset_url().'js/jscolor.js'?>"></script>-->
<script>

$('document').ready(function(){
	$.getScript("<?php echo asset_url().'js/jscolor.js'?>");
	$('form.loginform').on('submit',function(form){
		$('.pname').html('');
		$('.pdesc').html('');
		form.preventDefault();
		var p = $("form.loginform").serialize();
		$.post('<?php echo base_url()."priority/create" ;?>',p,function(data){
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
<h1 style="padding-top:5px" class="reg">Add New Priority</h1>
<?php $attributes = array('class' => 'loginform', 'id' => 'loginform');?>
<?php echo form_open('priority/create',$attributes); ?>
<p>
	<?php echo form_label('Priority Name:','pname')?>
	<?php echo form_input('pname','','id="pname"')?>
	<span class="error pname"></span>
</p>
<p>
	<?php echo form_label('Color:','color')?>
	<input value="ffcc00" style="display:block;margin:5px 0px" id="color" name="color" class="jscolor {width:243, height:150, position:'right',
    borderColor:'#FFF', insetColor:'#FFF', backgroundColor:'#666'}">
</p>
<p>
	<?php echo form_label('Description:','pdesc')?>
	<?php echo form_textarea('pdesc','',array('id' => 'pdesc', 'rows' => '10','cols'=>'20'))?>
	<span class="error pdesc"></span>
</p>
<p>
	<?php $btn_att = array('class' => 'smbtn')?>
	<?php echo form_submit('submit','Register',$btn_att)?>
</p>
<?php echo form_close();?>
</div>
</body>
</html>

