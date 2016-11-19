
function clearContent(element)
{
	element.value = "";
}

function addCommentary(index)
{		
	window.open("/templates/simple_blog_new_comment.php?postIndex="+ index +"");
}
