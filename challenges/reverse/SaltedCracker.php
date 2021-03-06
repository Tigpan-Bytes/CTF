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
        $flagResult = checkFlag('usa', 'SaltedCracker', 300);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    SaltedCracker';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>SaltedCracker</h3>
                <p style='text-align:center;'>Reverse • 300 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;"Hey buddy, I need your help, I got the presidents password but its encrypted. I got his encrypted password
                and the c++ program that was used to encrypt the password. I know if they want to test if the password is correct, they
                rerun the algorithm will all the possible seeds and if any outputs match the password hash, then the password is correct.
                <a href="<?php echo $_SESSION['redir']?>challenge-site/SECRET-ENCRYPTOR.txt">Here</a> is the program, and the hash 
                is 'BE518B1DAF8A3DBFC1FB26294335D752F5175943'. I know that his password only uses lowercase letters and nothing else, and his
                password is only 3 characters long. If I were you I would consider using some brute force to break it." - Unknown.</p>
            </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 300 points for your team!</div>";
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