$(document).ready(function(){
	$('td[name=tcol1]')
	$('div[name=dv_commentaries').hide();
})

function showComments(id)
{
	window.alert(id);
	$("#dv_comments"+id).show();
}