<?php
	session_start();

	include 'func.php';
    
	$auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

	if ($auth['success'])
	{
		header('Location: main.php');
	}
?>

<?php include 'head.php';?>

<body>
	<?php include 'page-title.php';?>

	<p>Sup homies, this is the index page, it will also redirect you if you are logged in, login to continue.</p>
</body>