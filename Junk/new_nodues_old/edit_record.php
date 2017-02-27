<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Header</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="./mystyle.css" rel="stylesheet">
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	
	<?php
		session_start();
		include("./dbinfo.inc");
		include ("./header.php");	
	?>	
	
	<body>
	
	<?php
		$entryErr = $typeErr = $descErr = "";
		$amountErr = "";
		$type = "";
		
		if(isset($_GET["due_id"]) && isset($_SESSION["emp_no"])){
			$due_id = $_GET["due_id"];
			$emp_id = $_SESSION["emp_no"];
			
			$due_sql="SELECT * FROM dues WHERE due_id='$due_id' AND created_by='$emp_id'";
			$due_result = $con->query($due_sql);
			if(!$due_result){
				echo "zero";
			}
			else{
				while($row_data = $due_result->fetch_assoc()){
					$lab_id = $row_data["lab_id"];
					$dept_name = $row_data["department"];
					$entry_num = $row_data["entry_number"];
					$description = $row_data["description"];
					$amount = $row_data["amount"];
				}
			}
		}		
		
		$correct_entry = false;
		
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$correct_entry = true;				
			if(empty($_POST["type"])){
				$typeErr = "Choose one type";
				//$correct_entry = false;
			}
			else{
				$type = test_input($_POST["type"]);
			}
			
			if(empty($_POST["description"])){
				$descErr = "Required Field";
				$correct_entry = false;
			}
			else{
				$description = test_input($_POST["description"]);
			}
			
			if($_POST["amount"]==0){
				$amountErr = "Amount must be greater than 0";
				$correct_entry = false;
			}
			else{
				$amount = test_input($_POST["amount"]);
			}
		}
		
		if($correct_entry){
			$update_rec_sql = "UPDATE dues SET `amount` = '$amount', `description` = '$description', `modified_time` = now(), `closed_time`= now() WHERE due_id='$due_id' AND created_by='$emp_id'";
			$update_result = $con->query($update_rec_sql);
			if ($update_result){
				echo "Record Has been Successfully Updated;";
				//header("Location: http://localhost/new_nodues/lab_index2.php");
				exit();
			}
			//echo $add_result;
			
		}
		
		function test_input($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	
	
	<div class="container">
	
		<h3 class="col-sm-offset-1">Edit record:</h3>
		<p><span class="col-sm-offset-1 error"> * Required field. </span></p>
		<br>
			
		<form class="form-horizontal" method="post" action="">
			<div class="form-group">
				<label class="control-lablel col-sm-offset-1 col-sm-2">Entry No:</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="entry_num" value="<?php echo $entry_num;?>" readonly>
				</div>
			</div>
			<!--<span class="error">* <?php// echo $nameErr;?></span>-->
			
			<div class="form-group">
				<label class="control-lablel col-sm-offset-1 col-sm-2">Department:</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="department" value="<?php echo $dept_name;?>" readonly>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-lablel col-sm-offset-1 col-sm-2">Lab Id:</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="lab_id" value="<?php echo $lab_id;?>" readonly>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-lablel col-sm-2 col-sm-offset-1">Type:</label>
				<div class="col-sm-3">
					<select class="form-control">
						<option name="type" value="<?php echo $type;?>">Select type</option>
						<option name="type" value="breakage">Breakage</option>
						<option name="type" value="others">Others</option>
					</select>
				</div>
				<span class="error">* <?php echo $typeErr; ?> </span>
			</div>
			
			<div class="form-group">
				<label class="control-lablel col-sm-2 col-sm-offset-1">Description:</label>
				<div class="col-sm-7">
					<textarea class="form-control" rows="5" column="40" name="description"><?php echo $description; ?></textarea>
				</div>
				<span class="error">* <?php echo $descErr; ?> </span>
			</div>
			
			<div class="form-group">
				<label class="control-lablel col-sm-2 col-sm-offset-1">Amount:</label>
				<div class="col-sm-3">
					<input class="form-control" placeholder="Enter Amount" type="number" min="1" name="amount" value="<?php echo $amount;?>">
				</div>
				<span class="error">* <?php echo $amountErr; ?> </span>
			</div>
			<br>
			<br>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-3">
					<button class="form-control btn btn-primary" type="submit" name="add_due_button">Submit</button>
				</div>
				
				<div class="col-sm-offset-1 col-sm-3">
					<button class="form-control btn btn-danger" type="reset" name="cancle_button">Cancel</button>
				</div>
			</div>
			
		</form>
	
	</div>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>	
</html>