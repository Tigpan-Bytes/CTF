<?php
	session_start();

    $_SESSION['redir'] = '../../';

	include $_SESSION['redir'].'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }
    else
    {
        $flagResult = checkFlag('well-done-you-are-now-a-member-of-the-pwn-patrol---welcome-to-the-force-sir', 'b7 String', 100);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    b7 String';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
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

                <code>Flag = (31, 4, 14, 14, 35, 3, 20, 16, 4, 35, 33, 20, 26, 35, 0, 23, 4, 35, 16, 20, 31, 35, 0, 35, 15, 4, 15, 1, 4, 23, 35, 20, 5, 35, 25, 10, 4, 35, 21, 31, 16, 35, 21, 0, 25, 23, 20, 14, 35, 35, 35, 31, 4, 14, 2, 20, 15, 4, 35, 25, 20, 35, 25, 10, 4, 35, 5, 20, 23, 2, 4, 35, 24, 11, 23)7</code>
             </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 100 points for your team!</div>";
                }
                elseif ($flagResult == 'error')
                {
                    echo "<div class='error'>Flag successful but your team has already hacked this challenge.</div>";
                }
                elseif ($flagResult == 'failure') 
                { 
                    echo "<div class='failure'>Flag failed. Try again.</div>";
                } 
            ?>
        </div>
    </div>
</body>