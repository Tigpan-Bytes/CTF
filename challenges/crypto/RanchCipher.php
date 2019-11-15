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

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > 
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
                <p>&emsp;&emsp;Hey man my friend gave me this code, he said its a 'spin on a caesar cipher', something about different shifts per character 
                or something... whatever that means. Anyway do you mind helping me crack it? </p>

                <p>He also told me that 'a' is 0 and '-' is 26; I don't know what it means though?</p>
                
                <code>Flag = ((-20, j), (3, d), (-19, m), (-48, y), (26, -), (7, y), (6, f), (33, o), 
                (30, v), (40, m), (15, h), (-46, p), (-18, n), (-37, q), (50, y), (34, l), (49, n), 
                (35, a), (5, e), (25, q), (31, e), (-16, w), (13, n), (8, l), (-36, r), (2, p), (-32, j), 
                (-49, e), (-15, p), (22, j), (32, z), (-15, n), (-2, r))</code>
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