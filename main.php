<?php
	if(isset($_POST['add']))
		header('Location: add.php');
	else if(isset($_POST['view']))
		header('Location: view.php');
	else if(isset($_POST['edit']))
		header('Location: edit.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Main</title>
		<style>
			body
			{
				background-color:grey;
				padding : 150px 0px 150px 0px;
			}
			form
			{
				background-color:white;
				width:20%;
				padding : 10px 20px 10px 20px;
				font-size:25px;
			}
			input
			{
				font-size : 20px;
			}
			#submit
			{
				background-color:lightgreen;
				width:100%;
			}
		</style>
	</head>
	<body>
		<center>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<center>
					<br>
					<input type="submit" name="add" value="Add" id="submit"><br><br>
					<input type="submit" name="view" value="View" id="submit"><br><br>
					<input type="submit" name="edit" value="Edit" id="submit"><br><br>
				</center>
			</form>
		</center>
	</body>
</html>