<?php
    session_start();

    include 'func.php';

    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'), TRUE);
    if ($auth['success'])
    {
        $message = 'Yeeter';
    }
    else
    {
        $err = $auth['err'];
    }
    //header('Location: index.php');
?>

<?php include 'head.php';?>

<body>
	<?php include 'page-title.php';?>

    Welcome <?php echo $_POST["username"]; ?><br>
    Your password is: <?php echo $_POST["password"]; ?>
    <br />
    <br />
    <?php
        if (isset($err))
        {
            echo "Err: ".$err."<br>";
        }
        if (isset($message))
        {
            echo "Message: ".$message."<br>";
        }
    ?> 
</body>
