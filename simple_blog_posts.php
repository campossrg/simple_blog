<!DOCTYPE html>

<!-- ************** BOOTSTRAP ************** -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- **************************************** -->


<html>
<head>
	<title>SIMPLE BLOG</title>
	<link rel="stylesheet" type="text/css" href="includes\style.css">
	<!-- Awesome font -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- bootstrap.social -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css">
	<!-- OpenSans font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<!-- Javascript scripts -->
	<script src="includes\JQuery_3.1.js"></script>
	<script src="includes\javascript_functions.js"></script>
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
				<a id="a_new_post" href=templates/simple_blog_new_post.php target="_blank">  Create a new post  </a><br><br>				
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