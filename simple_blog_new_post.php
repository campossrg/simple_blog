<!DOCTYPE html>

<!-- Javascript scripts -->
<script type="text/Javascript" src="includes\javascript_functions.js.js"></script>

<!-- PHP scripts -->
<?php
	include "includes\connection.php";
	include "includes\php_functions.php";
?>

<html>
<head>
	<title>SIMPLE BLOG - NEW POST</title>
	<link rel="stylesheet" type="text/css" href="includes\style.css">
</head>
<body>
	<div class="dv_main">
		<!-- FORMULARY -->
		<form action="simple_blog_new_post.php" method="POST"><br>
			Title:<input type="text" name="txt_title"><br>
			Content:<textarea onfocus="clearContent(this)" name="txt_content" cols="30" rows="5">Enter text here...</textarea><br>
			Author:<input type="text" name="txt_post_author"><br>
			<input type="submit" name="btn_ post_submit"><br><br>
		</form>

		<!-- ADD NEW POST -->
		<?php   
	  
			if(isset($_POST['btn_post_submit']))
			{
				//SET VARIABLES
				$table = array("table_posts", "postTitle", "postContent", "postAuthor"); 
				$txt = array($_POST['txt_title'], $_POST['txt_content'], $_POST['txt_post_author']);

				//INSERT COMMENT
				insertNew($table, $txt, $conn);
			}

	?>
	</div>
	
</body>
</html>