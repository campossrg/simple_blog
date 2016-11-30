<!DOCTYPE html>

<!-- ************** BOOTSTRAP ************** -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- **************************************** -->

<!-- PHP scripts -->
<?php
	include "..\includes\connection.php";
	include "..\simple_blog_model.php";
?>

<html>
<head>
	<title>SIMPLE BLOG - NEW POST</title>
	<link rel="stylesheet" type="text/css" href="..\includes\style.css">
	<!-- Awesome font -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- OpenSans font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
	<!-- Javascript scripts -->
	<script src="includes\JQuery_3.1.js"></script>
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
				<div class='form-group'>
					<label for='Title'>Title</label>
					<input type='text' class='form-control' name='txt_title' placeholder='Enter Title'>
				</div>	
	        	<div class='form-group'>
					<label for='Content'>Content</label>
		    		<textarea class='form-control' name='txt_content' cols='30' rows='5' placeholder='Insert text here...'></textarea>
				</div>
				<div class='form-group'>
					<label for='Author'>Author</label>
					<input type='text' class='form-control' name='txt_post_author' placeholder='Enter Author'>
				</div>	
  				<button type='submit' class='btn btn-primary' name='btn_post_submit'>Submit</button>
			</form>

			<!-- ADD NEW POST -->
			<?php   
		  
				//FORMULARY
				if(isset($_POST['btn_post_submit']))
				{
					//SET VARIABLES
					$table = array("table_posts", "postTitle", "postContent", "postAuthor"); 
					$txt = array($_POST['txt_title'], $_POST['txt_content'], $_POST['txt_post_author']);

					//INSERT COMMENT
					insertNew($table, $txt, $conn);
				}
				
				//CREATE STATIC HTML
				
				//GET THE CONTENT
				$post = fopen($row[Title].".txt","w") or die ("Unable to create the new post");
				$post_content = file_get_contents('templates\simple_blog_posts.php', FILE_USE_INCLUDE_PATH);
				$out = array();
				
				//MODIFY THE CONTENT
				foreach($post_content as $line)
				{
					if(strpos($var, "a_new_post")) $out[]="";
					else $out[]=$line;
					
					if(strpos($var, "$sql")) $out[]="$sql = 'SELECT * FROM table_posts WHERE postiD IS ".$."';";
					else $out[]=$line;
				}
				
				fwrite($post, $post_content);
				
				
				fclose($post);

			?>
		</div>
	</div>
	
</body>
</html>