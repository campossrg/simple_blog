
function clearContent(element)
{
	element.value = "";
}

function addCommentary(index)
{		
	window.open("simple_blog_new_comment.php?postIndex="+ index +"");
}
