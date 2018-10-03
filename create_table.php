<?php
	$choices='';
	session_start();
	if(isset($_POST['go']))
	{
		$n=$_POST['number'];
		for($i=0;$i<$n;$i++)
		{
			$choices.=($i+1).". <input type='text' name='c".$i."' required><br>";
		}
		$choices.="<input type='submit' name='submit' value='create' id='submit'>";
		$_SESSION['number']=$n;
	}
	if(isset($_POST['submit']))
	{
		$x=$_SESSION['user'];
		$conn = mysqli_connect('localhost','root','Aa#123','datastorage');
		mysqli_query($conn,"CREATE TABLE userp".$x." (id INT AUTO_INCREMENT PRIMARY KEY)");
		for($i=0;$i<$_SESSION['number'];$i++)
		{
			$a=$_POST["c".$i];
			mysqli_query($conn,"ALTER TABLE userp".$x." ADD $a varchar(255);");		
		}
		mysqli_query($conn,"UPDATE users SET table_flag=1 WHERE id=$x");
		header('Location: main.php');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Create Table</title>
		<style>
			body
			{
				background-color:grey;
				padding : 0px 0px 150px 0px;
			}
			form
			{
				background-color:white;
				width:20%;
				padding : 10px 20px 10px 20px;
				font-size:25px;
			}
			label
			{
				font-size:30px;
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
			<h1>Step 1 : Create Table</h1>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<label>Number of columns :</label>
					<input type="text" name="number" value="<?php if(isset($_POST['go'])) echo $_POST['number']; else echo '4'; ?>">
					<input type="submit" name="go" value="Go" id="submit"><br>
					<?php echo $choices; ?>
			</form>
		</center>
	</body>
</html>