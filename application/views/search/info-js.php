<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

function submitFrom(){
	$("#frm_info").submit();
}


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
	return true;
}
</script>