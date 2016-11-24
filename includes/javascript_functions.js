$(document).ready(function(){
	$('div[name=dv_commentaries').hide();
})

function showComments(id)
{ 
	$("#dv_comment"+id).toggle();
	if($('#btn_show_comment').val() == "Show comments") $('#btn_show_comment').val("Hide comments");
	else $('#btn_show_comment').val("Show comments");
}