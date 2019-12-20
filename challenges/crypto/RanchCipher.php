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
        $flagResult = checkFlag('caesar-is-the-best-salad-no-doubt', 'RanchCipher', 150);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    RanchCipher';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>RanchCipher</h3>
                <p style='text-align:center;'>Crypto • 150 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;Hey man, my friend gave me this secret code, he said its a 'spin on a caesar cipher', something about different shifts per character 
                or something... whatever that means. Anyway, do you mind helping me crack it? </p>

                <p>He also told me that 'a' is 0 and '-' is 26; I don't know what it means though?</p>
                
                <code>Flag = ((-5;y), (-2;z), (-1;d), (2;u), (-4;x), (2;t), (-2;y), (9;r), (4;w), (-6;u), (-1;s), (-10;y), (-6;z), (-5;v), (6;h), (9;n), (-1;r), (2;v), (-6;u), (-3;p), (3;d), (7;s), (5;f), (1;e), (5;e), (1;o), (7;v), (7;g), (-3;a), (10;y), (7;a), (3;e), (-3;q))</code>
             </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 150 points for your team!</div>";
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