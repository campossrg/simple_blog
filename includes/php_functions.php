<!-- Javascript scripts -->
<script type="text/Javascript" src="javascript_functions.js"></script>
<script src="includes\JQuery 3.1.1"></script>

<?php
   	function showPosts($conn, $sql, $btn)
   	{
		foreach ($conn->query($sql) as $row){
			echo "<div id=post". $row['postIndex'] .">";
    		echo $row['postTitle'] . "<br>";
    		echo $row['postContent'] . "<br><br>";
    		echo "Posted on " . $row['postDate'] . "   ";
    		echo " by " . $row['postAuthor'] . "<br><br>";

    		if($btn)
			{
				//BUTTON
	        	echo "<input type='button' value='Comment' name='btn_comment' onclick='addCommentary(". $row['postIndex'] .")'><br><br>";

	        	//COMMENTS
	        	echo "<div name=comment id=div_comment". $row['postIndex'] .">";
	        	$sql = "SELECT * FROM table_comments WHERE commentPostIndex = ". $row['postIndex'];
	        	showComments($conn, $sql);
	        	echo "</div>";
	        	echo "<input type='button' value='Show comments' onclick='moreComments(". $row['postIndex'] .")'>";
			}

    		echo "</div>";
		}

		
   	}

   	function showComments($conn, $sql)
   	{
		foreach ($conn->query($sql) as $row){
			echo "<div id=comment". $row['commentIndex'] .">";
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