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

    $un = $_SESSION['cache_username'];
    $pw = $_SESSION['cache_password'];

    $sql = "SELECT * FROM users WHERE (username='$un') AND (password='$pw')";
    if ($result = mysqli_query($conn, $sql))
    {
        if(mysqli_num_rows($result) == 0)
        {
            header('Location: index.php');
        }
    }
    else
    {        
        header('Location: index.php');
    }

    if(array_key_exists('sql_search', $_POST))
    {
        $name = $_POST['sql_name'];

        $sql = "SELECT * FROM products WHERE name Like '%$name%';--feeee";
        echo $sql;
        mysqli_multi_query($conn, $sql);
        $search_result = mysqli_store_result($conn);
        if (mysqli_error($conn))
        {
            echo "<h3>An error occured in our mySQL server when searching, oops?</h3>";
        }
    }

    mysqli_close($conn);
?>

<html>
    <head>
        <title>The 'Ess Que Elle' Needle Shop</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h2>Welcome <u><?php echo $_SESSION['cache_username'] ?></u> to The 'Ess Que Elle' Needle Shop</h2>
        <div class="horizontally">
            <div class="inner">
                <img src="needle2.jpg" alt="Buzzy bee">
            </div>
        </div>
        <br>
        <p>Search for products!</p>
        <form method="post">
            > Name of Item: <input type="text" name="sql_name" class="login-input"><br>
            <input type="submit" name='sql_search' value="-> search      ">
        </form>
        <table>
            <tr>
                <th>Name</th>
                <th>Price (CAN)</th>
                <th>Quantity</th>
            </tr>
            <?php
                if (!empty($search_result))
                {
                    while($row = mysqli_fetch_row($search_result))
                    {
                        echo '<tr>';
                        echo '<th>'.$row[0]."</th>";
                        echo '<th>'.$row[1]."</th>";
                        echo '<th>'.$row[2]."</th>";
                        echo '</tr>';
                    }
                }
            ?>
        </table>
        <p>Please contact if you are, or know, a web designer. Or have a <span style="color: yellow;">passion</span> for graphic design.</p>
        <div class="horizontally">
            <div class="inner">
                <img src="needle1.png" alt="Buzzy bee">
            </div>
        </div>
    </body>
</html>