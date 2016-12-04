<?php
   	function showPosts($conn, $sql, $btn)
   	{
		foreach ($conn->query($sql) as $row){
			echo "<div name='dv_post' id=dv_post". $row['postIndex'] .">";
    		echo "<h1><a href='". $row['postTitle'] .".php' target='_blank'>". $row['postTitle'] . "</a><br><i><small> Posted on ". $row['postDate'] ." by ". $row['postAuthor'] ."</small></i></h1><br>";
    		echo "<p>". $row['postContent'] . "</p><br><br>";

    		if($btn)
			{
				//button show comments
	        	echo "<input type='submit' class='btn btn-primary' id='btn_show_comment' value='Show comments' onclick='showComments(". $row['postIndex'] .")')>";

	        	//commentaries
	        	echo "<div name=dv_commentaries id=dv_comment". $row['postIndex'] .">";	
	        	$sql = "SELECT * FROM table_comments WHERE commentPostIndex = ". $row['postIndex'];
	        	showComments($conn, $sql);

	        	//social media share
	        	echo "<br><div id='dv_social_media'>";
	        	echo "<h3><i>Share</i></h3><ul>";
		        echo "<li><a class='btn btn-facebook' href:'https://www.facebook.com/sharer/sharer.php?u=www.google.es'><span class='fa fa-facebook'>facebook</span></a></li>";
		        echo "<li><a class='btn btn-twitter' href:'http://www.twitter.com/'><span class='fa fa-twitter'>Twitter</span></a></li>";
		        echo "<li><a class='btn btn-google' href:'http://www.envelope.com/'><span class='fa fa-envelope'>Mail</span></a></li>";
	        	echo "</ul>";
	        	echo "</div>";

				//commentaries form
	        	echo "<form action='simple_blog_index.php' method='POST'><br>";
	        	echo "<div class='form-group'>";
				echo "<h3><i>Add new commentary</i></h3>";
				echo "<label for='Content'>Content</label>";
	    		echo "<textarea class='form-control' name='txt_comment' cols='30' rows='5' placeholder='Insert text here...'></textarea>";
  				echo "</div>";
  				echo "<div class='form-group'>";
				echo "<label for='Author'>Author</label>";
				echo "<input type='text' class='form-control' name='txt_comment_author' placeholder='Enter Author'>";
				echo "</div>";	
  				echo "<button type='submit' class='btn btn-primary' name='btn_comment_submit'>Submit</button>";
  				echo "</form>";
	        	echo "</div>";

	        	//insert
	        	if(isset($_POST['btn_comment_submit'])) 
				{
					$table = array("table_comments", "commentPostIndex", "commentText", "commentAuthor"); 
					$txt = array($row['postIndex'], $_POST['txt_comment'], $_POST['txt_comment_author']);

					insertNew($table, $txt, $conn);
				}
			}
    		echo "</div>";
		}

		
   	}

   	function showComments($conn, $sql)
   	{
		foreach ($conn->query($sql) as $row){
			echo "<div class='media'>";
			echo "<div class='media-left'>";
			echo "<img src='http://www.w3schools.com/bootstrap/img_avatar2.png' class='media-object' style='width:60px'>";
			echo "</div>";
			echo "<div class='media-body'>";
			echo "<h2>". $row['commentAuthor'] ."<br><small><i> posted on ". $row['commentDate'] . "</i></small></h2><br>";
			echo $row['commentText'] . "<br>";
			echo "</div>";
		}
   	}

   	function insertNew($table, $txt, $conn)
   	{
		//INSERT SENTENCE
		$sql = $conn->prepare("INSERT INTO ". $table[0] ." (". $table[1] .", ". $table[2] .", ". $table[3] .") 
							   VALUES (:n1, :n2, :n3)");

		//EXECUTE WITH VALUES
		try
		{
			if(empty($txt[0]))
			{
				$error[] = "The title is not completed!!";
			}
			if(empty($txt[1]))
			{
				$error[] = "The content is not completed!!";
			}
			if(empty($txt[2]))
			{
				$error[] = "The author is not completed!!";
			}

			if(isset($error))
			{
				foreach($error as $error)
				{
					echo "<p>". $error ."</p>";
				}
			}

			else
			{
				$sql->execute(array(
					"n1" => $txt[0],
					"n2" => $txt[1],
					"n3" => $txt[2]
				));

				//RETURN THE ID
				$id = $conn->lastInsertId();
				return $id;

				echo "Data submited!";
			}
			
		}
		
		catch(PDOException $e)
		{
			echo "Insert failed: " . $e->getMessage();
		}   
   	}

   	function insertStaticHTML($lastId, $conn)
   	{		
   		$sql = "SELECT * FROM table_posts WHERE postIndex = '". $lastId ."'";
		foreach($conn->query($sql) as $row)
		{
			//GET THE CONTENT
			$path = "D:\\Program Files\\XAMPP\\htdocs\\";
			$post = fopen($path . $row['postTitle'] .".php","w+") or die ("Unable to create the new post");
			$out = array();
			$post_content = file($path . 'templates\simple_blog_posts.php');
			
			//MODIFY THE CONTENT
			foreach($post_content as $line)
			{
				if(strpos($line, "a_new_post")) $out[]=" ";
				
				elseif(strpos($line, "<?php")) $out[]=" ";

				elseif(strpos($line, "SELECT"))
				{
					$out[] = "<div name='dv_post". $lastId ."'>";
					$out[] = "<h1>". $row['postTitle'] ."<i><small> posted by ". $row['postAuthor'] ." on ". $row['postDate'] ."</small></i></h1>";
		    		$out[] = "<p>". $row['postContent'] . "</p><br><br>";
		    		$out[] = "</div>";
				}

				elseif(strpos($line, "sql")) $out[]=" ";

				elseif(strpos($line, "?>")) $out[]=" ";

				else $out[] = $line;
			}

			//PRINT THE CONTENT
			foreach($out as $line) fwrite($post, $line);
			
			fclose($post);
			echo "Data submited!";
		}
	}
?>