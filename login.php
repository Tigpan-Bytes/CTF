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

    $_SESSION['titlePath'] = ' Login';
    $_SESSION['redir'] = '';
?>

<?php include 'head.php';?>

<body>
    <?php include 'page-title.php';?>
    
    <?php
        if(isset($err)) 
        { 
            echo "<p style='text-align: center;'>Error: ".$err."</p>";
        } 
    ?>

    <div class='login-box login'>
        <form method="post">
            Username: <input type="text" name="username" class="login-input"><br>
            Password: <input type="password" name="password" class="login-input"><br>
            <input type="submit" name='submit' class="login-submit" value="Login">
        </form>
    </div>
</body>
