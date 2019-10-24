<?php
	session_start();

	include 'func.php';
    
	$auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));
?>

<?php include 'head.php';?>

<body>
	<?php include 'page-title.php';?>

	<form action="login.php" method="post">
		Username: <input type="text" name="username"><br>
		Password: <input type="text" name="password"><br>
		<input type="submit">
	</form>
</body>