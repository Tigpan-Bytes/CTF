<?php
    session_start();

    include 'func.php';

    if(array_key_exists('submit', $_POST))
    {
        $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'), TRUE);
        if (!$auth['success'])
        {
            $err = $auth['err'];
        }
        else
        {
            header('Location: main.php');
        }
    }
?>

<?php include 'head.php';?>

<body>
	<?php include 'page-title.php';?>

    <form method="post">
		Username: <input type="text" name="username"><br>
		Password: <input type="text" name="password"><br>
		<input type="submit" name='submit'>
	</form>

    <br />

    <?php
        if(isset($err)) 
        { 
            echo "Error: ".$err;
        } 
    ?>
</body>
