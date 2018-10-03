<?php
	$err='';
	
	if(isset($_POST['create']))
	{
		$uname=htmlentities($_POST['username']);
		$email=htmlentities($_POST['email']);
		$password=htmlentities($_POST['password']);
		$cpassword=htmlentities($_POST['cpassword']);
		
		if(strlen($password)<6)
			$err="Week Password!";
		else if($password!=$cpassword)
			$err="Password not match!";
		else
		{
			$conn = mysqli_connect('localhost','root','Aa#123','datastorage');
			$x=1;
			$flag=1;
			
			$users = [];
			$result = mysqli_query($conn,'SELECT * FROM users');
			while ($row = $result->fetch_assoc()) {
				$users[] = $row;
			}
			$flag=1;
			foreach($users as $user)
			{
				if($user['user']==$uname)
				{
					$flag=0;
					break;
				}
				$x++;
			}
			if($flag==1)
			{
				mysqli_query($conn,"INSERT INTO users(email,username,password,table_flag) VALUES ('$email','$uname','$password',0)");
				header('Location: index.php');
			}
			else
			{
				$err='Username Already Taken!';
			}
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
			<h1>Create an account of Best data sharing site!</h1>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<label>email-id :<br>
					</label><input type="email" name="email" value="<?php if(isset($_POST['create'])) echo $_POST['email']; else echo ''; ?>" required><br><br>
					<label>Username :<br>
					</label><input type="text" name="username" value="<?php if(isset($_POST['create'])) echo $_POST['username']; else echo ''; ?>" required><br><br>
					<label>Create Password :<br>
					</label><input type="password" name="password" value="<?php if(isset($_POST['create'])) echo $_POST['password']; else echo '';?>" required><br><br>
					<label>Confirm Password :<br>
					</label><input type="password" name="cpassword" required>
					<h3><?php echo $err; ?></h3>
				<center>
					<input type="submit" name="create" value="Create Account" id="submit"><br>
					Already have an account?<a href="index.php">click here</a>
				</center>
			</form>
		</center>
	</body>
</html>