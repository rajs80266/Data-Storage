<?php
	session_start();
	$err='';
	$table=0;
	if(isset($_POST['signin']))
	{
		$uname=htmlentities($_POST['username']);
		$password=htmlentities($_POST['password']);
		
		$conn = mysqli_connect('localhost','root','Aa#123','datastorage');
		$users = [];
		$result = mysqli_query($conn,'SELECT * FROM users');
		while ($row = $result->fetch_assoc()) {
			$users[] = $row;
		}
		$flag=0;
		foreach($users as $user)
		{
			if($user['username']==$uname && $user['password']==$password)
			{
				$flag=$user['id'];
				$table=$user['table_flag'];
				break;
			}
		}
		if($flag==0)
			$err="Invalid username or password!";
		else
		{
			$_SESSION['user']=$flag;
			if($table==0)
				header('Location: create_table.php');
			else
				header('Location: main.php');
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sign in</title>
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
			}
			form
			{
				font-size:25px;
			}
			label
			{
				font-size:30px;
			}
			a
			{
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
			h3
			{
				color:red;
			}
		</style>
	</head>
	<body>
		<center>
			<h1>Enter to Best Data Storing site!</h1>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<label>Username :<br>
					</label><input type="text" name="username" value="<?php if(isset($_POST['signin'])) echo $_POST['username']; else echo ''; ?>" required><br><br>
					<label>Password :<br>
					</label><input type="password" name="password" required><br>
					<a href="#" id="fp">Forgot password?</a>
					<h3><?php echo $err; ?></h3>
				<center>
					<input type="submit" name="signin" value="Sign in" id="submit"><br>
					New User?<a href="create_account.php">Create an account.</a>
				</center>
			</form>
		</center>
	</body>
</html>