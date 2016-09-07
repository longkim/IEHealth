<?php foreach ($objective as $o){ ?>
<script>
	var o_id = <?php echo $o->o_id ;?>;
</script>
<div id="title" style="background-color:#<?php echo $color; ?>"><?php echo $o->o_name;?> : <?php echo $o->o_description?></div>
<h1 style="clear:left;text-align:center;margin-bottom:8px">Strategies</h1>
<?php } ?>
</div>
<div id="home_dialog"></div>
<div id="priority_area"><?php if (isset($result)){?>
<ul id="list_priority">
<?php foreach ($result as $res){?>
	<li class="list" value="<?php  echo $res->s_id ;?>" title="<?php echo $res->s_description ?>">
	<img class="editbutton" src='<?php echo asset_url().'img/edit.png';?>'/>
	<div style="background-color:#<?php echo $color;?>;vertical-align:top;height:40px" class="o_name"><?php echo $res->s_name;?></div>
	<div style="height:150px;" class="o_desc"><?php echo $res->s_description;?></div>
	</li>
	<?php }?>
	<li>
	<div><img class="clickme"
		style="cursor: pointer;" width="50px"
		src="<?php echo base_url().'assets/img/plus.png'?>" /></div>
	</li>
	<?php if ($this->session->userdata('admin')){?>
	<?php if($result != array()){ ?>
	<li id="trash">
	<div><img width="50px" src="<?php echo base_url().'assets/img/trash.png'?>" /></div>
	</li>
	<?php }}?>
</ul>
<?php  }?>
</body>
</html>
<script type="text/javascript">

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
         if (confirm('Are you sure you want to delete the '+ui.draggable.children('.o_name').text()+' ?')) {
            var p = ui.draggable.val();
        	$.get('<?php echo base_url()."strategy/delete/" ;?>'+ui.draggable.val(),function(data){
        			
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

$(".clickme").bind('click', function (e) {

    $.post('<?php echo base_url(); ?>strategy/add/'+o_id, function(response){
        $('#home_dialog').html(response);
        $( "#home_dialog" ).dialog('open');
      
});
    
});

$('ul#list_priority li.list').click(function(event) {
    if ($(this).hasClass('noclick')) {
        $(this).removeClass('noclick');
    }
    else {
    	var id = $(this).attr('value');
 	    window.location.href = "<?php echo base_url();?>task/index/"+id+"/<?php echo $color;?>";
    }
});

$(document).ready(function () {
     $(".editbutton").bind('click', function (e) {
    	e.stopPropagation();
       var li = $(this).parent("li");
       var id = li.attr("value");
       $.post('<?php echo base_url();?>strategy/edit/'+id,function(response){
    	   $("#home_dialog").html(response);
    	   $("#home_dialog").dialog('open');
           });
//    	$.post('<?php echo base_url(); ?>strategy/edit/'+id, function(response){
//    	        $('#home_dialog').html(response);
//    	        $( "#home_dialog" ).dialog('open');
//    });

    
});
});


</script>