<?php 
	include "includes\connection.php";
	
	require_once "simple_blog_model.php";

	$sql = "SELECT * FROM table_posts ORDER BY postDate DESC";
	$posts = showPosts($conn, $sql, $btn=1);

	require 'templates\simple_blog_posts.php';
?>
