<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Make Request</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="./mystyle.css" rel="stylesheet">
	</head>

	<?php
		session_start();
		ini_set('session.cache_limiter','public');
		session_cache_limiter(false);
		include("./dbinfo.inc");
		$due_id=$_POST['did'];

		$target_dir = "./uploads/";		
		$extension=pathinfo($_FILES["file_to_upload"]["name"])['extension'];
		$target_file = $target_dir.$due_id.'_'.$_SESSION['entry_no'].'.'.$extension;
		$uploadOk=1;
		$comment = $_POST["comment"];
		//checking whether file already exists or not
		/**if(file_exists($target_file)){
			echo "File already exists.<br>";
			$uploadOk = 0;
		}**/
		
		//check file size

		if($_FILES["file_to_upload"]["size"] >1000000){
			echo "Sorry, your file is too large.<br>";
			$uploadOk = 0;
		}
		
		if($uploadOk ==0){
			echo "Sorry, your file was not uploaded.";
		}
		else{


		if (file_exists($target_file)) {
		     unlink($target_file);
		    //echo "deleted";
		}
				
			if(move_uploaded_file($_FILES["file_to_upload"]["tmp_name"],$target_file)){
				//echo "The file ".basename($_FILES["file_to_upload"]["name"])." has been uploaded.";
				$due_id = $_GET["due_id"];
				$con->query("SET AUTOCOMMIT=0");
				$con->query("START TRANSACTION");

				$request_sql1 = "UPDATE dues SET
									status = 'R'
										WHERE dueID = $due_id;";
				$request_sql = "INSERT INTO duesra (
									dueID,
									requested_comment,
									requested_time) VALUES(
									$due_id,
									'$comment',
									now()) ON DUPLICATE KEY UPDATE requested_comment = '$comment', requested_time = now();";
				$request_result1 = $con->query($request_sql1);
				$request_result = $con->query($request_sql);

				if($request_result1 && $request_result){
					$con->query("COMMIT");
					// echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
					header("Location: http://testportal.iitd.ac.in/new_nodues/student_index.php");
					exit();
				}
				else{
					$con->query("ROLLBACK");
				}
				
			}
			else {
				echo "Sorry, there was an error in uploading file.";
			}
		}
		
	?>
	<body>
		<script src="script/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>