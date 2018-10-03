<?php
	session_start();
	$out='';
	$x=$_SESSION['user'];
	$conn = mysqli_connect('localhost','root','Aa#123','datastorage');
	$users = [];
	$result = mysqli_query($conn,"select column_name from information_schema.columns where table_name='userp".$x."'");
	while ($row = $result->fetch_assoc()) {
		$users[] = $row;
	}
	
	$flag=0;
	$i=0;
	foreach($users as $user)
	{
		if($flag==0)
			$flag=1;
		else
		{
			$out.='<br>'.$user['column_name']." : <input type='text' name='c".$i."'><br>";
			$i++;
			$_SESSION['number']=$i;
		}
	}
	
	if(isset($_POST['add']))
	{
		$n=$_SESSION['number'];
		
		$userp = [];
		$result = mysqli_query($conn,"SELECT * FROM userp".$x);
		while ($row = $result->fetch_assoc()) {
			$userp[] = $row;
		}
		$flag=0;
		$num=0;
		foreach($userp as $user)
		{
			$num++;
		}
		$num++;
		
		$addup="('".$num."',";
		for($i=0;$i<$n-1;$i++)
		{	
			$o=$_POST["c".$i];
			$addup.="'".$o."',";
		}
		$o=$_POST["c".$i];
		$addup.="'".$o."')";
		
		mysqli_query($conn,"INSERT INTO userp".$x." VALUES ".$addup);
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add</title>
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
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<?php echo $out; ?>
					<br><input type="submit" name="add" value="Add" id="submit"><br>
			</form>
		</center>
	</body>
</html>