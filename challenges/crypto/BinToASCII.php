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
        $flagResult = checkFlag('w31c0mE_t0_7hE_CTF_:)', 'Bin->ASCII', 50);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    Bin->ASCII';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>Bin->ASCII</h3>
                <p style='text-align:center;'>Crypto • 50 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;If you are a computer and you want to encode text into binary you need to choose a method of doing so.
                    One very commonly used encoding standard is called ASCII. It is a table of 256 different characters, each representing
                    a binary number from 0-255 (or 00000000 to 11111111). There are many tools and resources available to help you decode
                    or encode said text.</p>

                <p>&emsp;&emsp;Decode the below text to find the flag.</p>

                <code>01110111 00110011 00110001 01100011 00110000 01101101 01000101 01011111 01110100 00110000 01011111 00110111 01101000 01000101 01011111 01000011 01010100 01000110 01011111 00111010 00101001</code>
             </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 50 points for your team!</div>";
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