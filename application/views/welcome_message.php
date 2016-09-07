<div id="home_dialog"></div>
<div id="priority_area"><?php if (isset($result)){?>
<ul id="list_priority">
<?php foreach ($result as $res){?>
	<li class="list" value="<?php  echo $res->p_id ;?>" title="<?php echo $res->p_description ?>" style="background-color:#<?php echo $res->p_color; ?>">
	<div><?php echo $res->p_name;?></div>
	</li>
	<?php }?>
	<?php if ($this->session->userdata('admin')){?>
	<li>
	<div><img id="clickme"
		style="cursor: pointer;" width="50px"
		src="<?php echo base_url().'assets/img/plus.png'?>" /></div>
	</li>
	<li id="trash">
	<div><img width="50px" src="<?php echo base_url().'assets/img/trash.png'?>" /></div>
	</li>
	<?php }?>
</ul>

	<?php }?></div>

<script>

$(function() {
	$("ul#list_priority li.list").draggable({
		 start: function(event, ui) {
       	$(this).addClass('noclick');
   		},
		revert:true
		});
	
    $('#trash').droppable({
    	accept: '.list',
        drop: function(event, ui) {
         if (confirm('Are you sure you want to delete the '+ui.draggable.children().text()+' Priority ?')) {
            var p = ui.draggable.val();
        	$.get('<?php echo base_url()."priority/delete/" ;?>'+ui.draggable.val(),function(data){
        			
        			});
             ui.draggable.remove();
         } else {
             ui.draggable.show();
         }  
        }
    });
	
    $( "#home_dialog" ).dialog({
      autoOpen: false,
      width:500,
      show: {
        effect: "scale",
        duration: 500
      },
      hide: {
        effect: "scale",
        duration: 500
      },
      modal:true
      
    });
  });


$('ul#list_priority li.list').click(function(event) {
    if ($(this).hasClass('noclick')) {
        $(this).removeClass('noclick');
    }
    else {
    	var id = $(this).attr('value');
 	    window.location.href = "<?php echo base_url();?>objective/index/"+id;
    }
});

$("#clickme").bind('click', function (e) {

    $.post('<?php echo base_url(); ?>priority', function(response){
        $('#home_dialog').html(response);
        $( "#home_dialog" ).dialog('open');
      
});

 
    
});

</script>
<!--<input type='color' id="custom" /><h2>Basic Usage</h2>-->





</body>
</html>
