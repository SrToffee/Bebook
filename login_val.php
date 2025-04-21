<?php
	include('functions.php');
	include('connect_bd.php');
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST['email']))
			$errors[] = 'Email';
		if(empty($_POST['password']))
			$errors[] = 'Password';
		if(!empty($errors))
		{
			foreach($errors as $input)
			{
				echo '<h3>'.$input.' é necessario para o Login';
			}
			header('refresh:1;url=login.php');
		}else
		{
			$email = clean_input($_POST['email']);
			$password = clean_input($_POST['password']);
			$sql = "SELECT * FROM users WHERE email =$email AND password =$password";
			if(!$result = mysqli_query($conn, $sql))
				echo 'Houve um erro';
			else
			if (mysqli_num_rows($result) == 1)
			{
				$user = mysqli_fetch_assoc($result);
				$_SESSION['id_user'] = $user['id_user'];
				mysqli_close($conn);
				if($user['u_type'] == 1)
				{
					header('location:index.php');
				}else
					header('Location:dashboard.php');
			}else
			{
				header('Location:login.php?w_pass');
			}
		}
	}
?>