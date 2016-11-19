<!DOCTYPE html>

<!-- Javascript scripts -->
<script type="text/Javascript" src="..\includes\javascript_functions.js"></script>

<!-- PHP scripts -->
<?php
	include "..\includes\connection.php";
	include "..\simple_blog_model.php";
?>

<html>
<head>
	<title>SIMPLE BLOG - NEW POST</title>
	<link rel="stylesheet" type="text/css" href="..\includes\style.css">
</head>
<body>
	<div class="dv_main"> 
    	<!-- NAV BAR -->
    	<div class="dv_navbar">
			<div class="dv_navbar_title">
				<span>SIMPLE_BLOG</span>
				<span>New post</span>
			</div>
			<div class="dv_navbar_links">
				<a href=..\simple_blog_index.php>  Home  </a> 
			</div>
		</div>

		<div class="dv_results">
			<!-- FORMULARY -->
			<form action="simple_blog_new_post.php" method="POST"><br>
				Title:<input type="text" name="txt_title"><br>
				<textarea onfocus="clearContent(this)" name="txt_content" cols="30" rows="5">Enter text here...</textarea><br>
				Author:<input type="text" name="txt_post_author"><br>
				<input type="submit" name="btn_post_submit"><br><br>
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
	</div>
	
</body>
</html>