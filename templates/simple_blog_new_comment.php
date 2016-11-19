<!DOCTYPE html>

<!-- Javascript scripts -->
<script type="text/Javascript" src="..\includes\javascript_functions.js"></script>

<!-- INCLUDES -->
<?php
	//START THE SESSION TO KEEP INDEX VARIABLE
	session_start(); 

	include "..\includes\connection.php";
	include "..\simple_blog_model.php";
?>

<html>
<head>
	<title>SIMPLE BLOG - NEW COMMENTARY</title>
	<link rel="stylesheet" type="text/css" href="..\includes\style.css">
</head>
<body>
	<div class="dv_main"> 
		<!-- NAV BAR -->
		<div class="dv_navbar">
			<div class="dv_navbar_title">
				<span>SIMPLE_BLOG</span>
			</div>
			<div class="dv_navbar_links">
				<a href=simple_blog_index.php>  Home  </a> 
			</div>
		</div>
		<div class="dv_results">
			<!-- SHOW POST AND COMMENTARIES -->
			<?php

				if(!isset($_POST['btn_comment_submit']))
				{
					$_SESSION['index'] = $_GET['postIndex']; // Save the variable into $_SESSION
					$sql = 'SELECT * FROM table_posts WHERE postIndex = '. $_SESSION['index'];
					showPosts($conn, $sql, $btn=0);		

					$sql = 'SELECT * FROM table_comments WHERE commentPostIndex = '. $_SESSION['index'];
					showComments($conn, $sql);
				}
					
			?>

			<!-- COMMENT FORM -->
			<form method="POST" action='simple_blog_new_comment.php'> 
				Commentary:<br> 
				<textarea onfocus='clearContent(this)' cols='30' rows='5' name="txt_comment">Enter the text here...</textarea><br> 
				Author: <input type='text' name='txt_comment_author'><br> 
				<input type='submit' name='btn_comment_submit'><br><br>
			</form>

			<!-- INSERT COMMENTS -->
			<?php

				if(isset($_POST['btn_comment_submit'])) 
				{
					//SET VARIABLES
					$table = array("table_comments", "commentPostIndex", "commentText", "commentAuthor"); 
					$txt = array($_SESSION['index'], $_POST['txt_comment'], $_POST['txt_comment_author']);

					//INSERT COMMENT
					insertNew($table, $txt, $conn);

					session_destroy(); //Close the session
				}
			?>
		</div>
	</div>
</body>
</html>
