<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";
$('#userTable').DataTable();

// remove functions 
function getAjaxData(str,value)
{
	//console.log(str);
	//console.log(value);
	if(str == 'exam')
	{
		if(value != ''){
		  $.ajax({
			url: base_url+'search/getAjaxData',
			type: 'post',
			data: { type:str, id:value }, 
			dataType: 'json',
			success:function(response) {
			   $("#exam_div").html(response.data);
			}
		  }); 
		}
	}
	else if(str == 'cast_category')
	{
		var year = $("#year").val();
		//var myArr = year.split("#");


		if(value != ''){
		  $.ajax({
			url: base_url+'search/getAjaxData',
			type: 'post',
			data: { type:str, id:value, year:year }, 
			dataType: 'json',
			success:function(response) {
			   $("#cast_div").html(response.data);
			}
		  }); 
		}
	}
      return false;
}
function checkForm(){
	
	var year = jQuery.trim($("#year").val());
	var stream = jQuery.trim($("#stream").val());
	var exam = jQuery.trim($("#exam").val());
	var cast = jQuery.trim($("#cast").val());
	var min_marks = jQuery.trim($("#min_marks").val());
	var actual_marks = jQuery.trim($("#actual_marks").val());
	var max_marks = jQuery.trim($("#max_marks").val());
	
	if(year == '')
	{	
		$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
		  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
		  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>Please select Aspirant Year</div>');
		  $("#year").focus();
		  return false;
	}
	if(stream == '')
	{	
		$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
		  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
		  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>Please select stream</div>');
		  $("#year").focus();
		  return false;
	}
	if(exam == '')
	{	
		$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
		  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
		  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>Please select exam</div>');
		  $("#year").focus();
		  return false;
	}
	if(cast == '')
	{	
		$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
		  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
		  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>Please select cast category</div>');
		  $("#year").focus();
		  return false;
	}
	if(min_marks == '')
	{	
		$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
		  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
		  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>Please enter min marks</div>');
		  $("#year").focus();
		  return false;
	}
	if(actual_marks == '')
	{	
		$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
		  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
		  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>Please enter actual marks</div>');
		  $("#year").focus();
		  return false;
	}
	if(max_marks == '')
	{	
		$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
		  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
		  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>Please enter max marks</div>');
		  $("#year").focus();
		  return false;
	}
	return true;;
}
</script>