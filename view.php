<?php
	session_start();
	$out=$ouput='';
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
	
	if(isset($_POST['view']))
	{
		$n=$_SESSION['number'];
		$users = [];
		$result = mysqli_query($conn,"select column_name from information_schema.columns where table_name='userp".$x."'");
		while ($row = $result->fetch_assoc()) {
			$users[] = $row;
		}
		
		$flag=0;
		$i=0;
		
		$addup='';
		foreach($users as $user)
		{
			if($flag==0)
				$flag=1;
			else
			{
				//$out.='<br>'.$user['column_name']." : <input type='text' name='c".$i."'><br>";
				$o=$user['column_name'];
				$a=$_POST["c".$i];
				if($a!='')
					$addup.=$o."='".$a."' AND ";
				$i++;
			}
		}
		$addup.="TRUE";
		$details = [];
		$result=mysqli_query($conn,"SELECT * FROM userp".$x." WHERE ".$addup);
		while ($row = $result->fetch_assoc()) {
			$details[] = $row;
		}
		$output='';
		foreach($details as $detail)
		{
			$flag=0;
			foreach($users as $user)
			{
				if($flag==0)
					$flag=1;
				else
				{
					$o=$user['column_name'];
					$output.=$detail[$o]." ";
				}
			}
			$output.="<br>";
		}
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
					<br><input type="submit" name="view" value="View" id="submit"><br>
					<?php echo $output; ?>
			</form>
		</center>
	</body>
</html>