<!-- Javascript scripts -->
<script type="text/Javascript" src="javascript_functions.js"></script>
<script src="includes\JQuery_3.1.js"></script>

<?php
   	function showPosts($conn, $sql, $btn)
   	{
		foreach ($conn->query($sql) as $row){
			echo "<div name='dv_post' id=dv_post". $row['postIndex'] .">";
    		echo "<p>". $row['postTitle'] . "</p><br>";
    		echo "<p>". $row['postContent'] . "</p><br><br>";
    		echo "<p>Posted on " . $row['postDate'] . "   ";
    		echo "<p> by " . $row['postAuthor'] . "</p><br><br>";

    		if($btn)
			{
				//BUTTON
	        	echo "<input type='button' value='Comment' name='btn_comment' onclick='addCommentary(". $row['postIndex'] .")'><br><br>";
	        	echo "<form method='POST'>";
	        	echo "<input type='submit' value='Show comments' name=btn_show_comment". $row['postIndex'] .">";
	        	echo "</form><br><br>";

	        	//COMMENTS
	        	if(isset($_POST['btn_show_comment'. $row['postIndex']]))
	        	{
		        	echo "<div name=dv_commentaries id=dv_comment". $row['postIndex'] .">";
		        	$sql = "SELECT * FROM table_comments WHERE commentPostIndex = ". $row['postIndex'];
		        	showComments($conn, $sql);
		        	echo "</div>";
	        	}
			}
    		echo "</div>";
		}

		
   	}

   	function showComments($conn, $sql)
   	{
		foreach ($conn->query($sql) as $row){
			echo "<div>";
			echo $row['commentText'] . "<br>";
			echo "Posted on " . $row['commentDate'] . "   ";
			echo " by " . $row['commentAuthor'] . "<br><br>";
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
			$n1 = $txt[0];
			$n2 = $txt[1];
			$n3 = $txt[2];

			//BASIC VALIDATION

			if(empty($n1))
			{
				$error[] = "The title is not completed!!";
			}
			if(empty($n2))
			{
				$error[] = "The content is not completed!!";
			}
			if(empty($n3))
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
				//EXECUTE
				$sql->execute(array(
					"n1" => $n1,
					"n2" => $n2,
					"n3" => $n3
				));

				//CLOSE
				echo "Data submited! Closing...";
				echo "<script>setTimeout('window.close();', 1500);</script>";
			}
			
		}
		
		catch(PDOException $e)
		{
			echo "Insert failed: " . $e->getMessage();
		}   
   	}
?>