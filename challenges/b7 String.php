<?php
	session_start();

	include '../func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\'../challenges.php\'" class="btn">Challenges</button> >
    b7 String';

    $_SESSION['redir'] = '../';

    $error = false;
    $success = false;
    $failure = false;
    if(array_key_exists('submit', $_POST))
    {
        if ($_POST['flag'] == 'well-done-you-are-now-a-member-of-the-pwn-patrol---welcome-to-the-force-sir')
        {
            $servername = "localhost";
            $username = "admin";
            $password = "pleaseNoHacking123";
            $dbname = "ctf";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }

            $chname = 'b7 String';
            $likechname = '%b7 String%';
            $error = true;

            $stmt = mysqli_prepare($conn, "UPDATE teams SET score = score + 100 WHERE (teamname = ? AND solved NOT LIKE ?)");
            mysqli_stmt_bind_param($stmt, 'ss', $_SESSION['team'], $likechname);
            
            if (mysqli_stmt_execute($stmt))
            {
                if (mysqli_affected_rows($conn) == 1)
                {
                    $stmt = mysqli_prepare($conn, "UPDATE teams SET solved = concat(solved, concat(?, ',')) WHERE (teamname = ? AND solved NOT LIKE ?)");
                    mysqli_stmt_bind_param($stmt, 'sss', $chname, $_SESSION['team'], $likechname);
                    if (mysqli_stmt_execute($stmt))
                    {
                        $success = true;
                    }
                }
            }

            mysqli_close($conn);
        }
        else
        {
            $failure = true;
        }
    }
?>

<?php include 'chhead.php';?>

<body>
    <?php include '../page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>b7 String</h3>
                <p style='text-align:center;'>Crypto • 100 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;Computers store numbers in many different ways. They typically store numbers in one of four ways: binary (0-1, base 2), 
                octal (0-7, base 8), decimal (0-9, base 10), and hexadecimal (0-F, base 16). Although anybody could use any base they choose...</p>
                
                <p>&emsp;&emsp;In a computer, text is typically stored as a long string of bytes, each of those bytes represents a number which represents a character.
                For example: 0 -> 'a', 1 -> 'b', 2 -> c... '26' -> '-'. If you would want to decrypt such a code, doing it by hand would take much too long.
                Decrypting it by a making a program would be much smarter.</p>

                <code>Flag = (31, 4, 14, 14, 35, 3, 20, 16, 4, 35, 33, 20, 26, 35, 0, 23, 4, 35, 16, 20, 31, 35, 0, 35, 15, 4, 15, 1, 4, 23, 35, 20, 5, 35, 
                25, 10, 4, 35, 21, 31, 16, 35, 21, 0, 25, 23, 20, 14, 35, 35, 35, 31, 4, 14, 2, 20, 15, 4, 35, 25, 20, 35, 25, 10, 4, 35, 5, 20, 23, 2, 4, 35, 24, 11, 23)7</code>
             </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($success) 
                { 
                    echo "<div class='success'>Flag successful! You earned 100 points for your team!</div>";
                }
                elseif ($error)
                {
                    echo "<div class='error'>Flag successful but your team has already hacked this challenge.</div>";
                }
                if ($failure) 
                { 
                    echo "<div class='failure'>Flag failed. Try again.</div>";
                } 
            ?>
        </div>
    </div>
</body>