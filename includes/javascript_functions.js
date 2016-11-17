
function clearContent(element)
{
	element.value = "";
}

function addCommentary(index)
{		
	window.open("simple_blog_new_comment.php?postIndex="+ index +"");
}

function moreComments(id)
{
	$("#div_comment" + id).show("slow");
}

//HIDE ALL COMMENT ELEMENTS
$(document).ready(function() {
  $("div[name=comment]").hide();
});