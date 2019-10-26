<?php
    session_start();

    include 'func.php';

    if(array_key_exists('submit', $_POST))
    {
        if (!isAdminAuth(getSessionVar('adminUsername'), getSessionVar('adminPassword')))
        {
            $err = 'Nope...';
        }
        else
        {
            $_SESSION["adminUsername"] = $_POST["adminUsername"];
            $_SESSION["adminPassword"] = $_POST["adminPassword"];
            header('Location: adminPage.php');
        }
    }

    $_SESSION['titlePath'] = ' Admin Login';
    $_SESSION['redir'] = '';
?>

<?php include 'head.php';?>

<body>
    <div class='underline'>
        <h3 style='text-align:center;'>This is not a secret flag/challenge. It will not give you secret buffs for the AI battle, this is strictly for administration. Don't waste your time
        attempting to hack it. (Unless you want, it's your time to waste).</h3>
    </div>
    
    <div class='page-spacer'></div>
    
    <form method="post">
		Username: <input type="text" name="adminUsername"><br>
		Password: <input type="password" name="adminPassword"><br>
		<input type="submit" name='submit'>
	</form>

    <br />

    <?php
        if(isset($err)) 
        { 
            echo "<p>Error: ".$err."</p>";
        } 
    ?>
</body>
