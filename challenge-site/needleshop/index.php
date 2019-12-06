<?php
    session_start();

    $servername = "localhost";
    $username = "needle";
    $password = "daniel_the_needle_shop";
    $dbname = "needle";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(array_key_exists('sql_submit', $_POST))
    {
        $un = $_POST['sql_username'];
        $pw = $_POST['sql_password'];

        $sql = "SELECT * FROM users WHERE (username='$un') AND (password='$pw')";
        if ($result = mysqli_query($conn, $sql))
        {
            $row = mysqli_fetch_assoc($result);

            if(mysqli_num_rows($result) >= 1)
            {
                $_SESSION['cache_username'] = $row['username'];
                $_SESSION['cache_password'] = $row['password'];
                header('Location: home.php');
            }
            else
            {
                echo "<h3>Invalid username and password</h3>";
            }
        }
        else
        {        
            echo "<h3>An error occured in our mySQL server when logging in, oops?</h3>";
        }

        mysqli_close($conn);
    }
?>

<html>
    <head>
        <title>The 'Ess Que Elle' Needle Shop</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>The 'Ess Que Elle' Needle Shop</h1>
        <div class="horizontally">
            <div class="inner">
                <img src="needle1.png" alt="Buzzy bee">
            </div>
        </div>
        <form method="post">
            => Username: <input type="text" name="sql_username" class="login-input"><br>
            -> Password: <input type="password" name="sql_password" class="login-input"><br>
            <input type="submit" name='sql_submit' value="    button">
        </form>
        <br>
        <p>Please contact if you are, or know, a web designer. Or have a <span style="color: yellow;">passion</span> for graphic design.</p>
        <div class="horizontally">
            <div class="inner">
                <img src="needle2.jpg" alt="Buzzy bee">
            </div>
        </div>
    </body>
</html>