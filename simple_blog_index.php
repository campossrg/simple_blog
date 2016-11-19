<!DOCTYPE html>

<!-- ************** BOOTSTRAP ************** -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- *************************************** -->

<!-- PHP scripts -->
<?php 
	include "includes\connection.php";
	include "includes\php_functions.php";
?>

<!-- Javascript scripts -->
<script type="text/Javascript" src="includes\javascript_functions.js"></script>
<script src="includes\JQuery_3.1.js"></script>

<html>
<head>
	<title>SIMPLE BLOG</title>
	<link rel="stylesheet" type="text/css" href="includes\style.css">
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
				<a href=simple_blog_new_post.php target="_blank">  Create a new post  </a><br><br>				
			</div>
		</div>

		<div class="dv_results">
			<!-- SHOW RESULTS --> 
			<?php
				
	    		//SHOW POSTS
	    		$sql = "SELECT * FROM table_posts ORDER BY postDate DESC";
				showPosts($conn, $sql, $btn=1);
			?> 
		</div>
    </div>
</body>
</html>
