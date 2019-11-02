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
        $flagResult = checkFlag('Fr13nD5hIP', 'My Little Pwnies', 200);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    My Little Pwnies';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>My Little Pwnies</h3>
                <p style='text-align:center;'>Forensics • 200 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;"Hey, don't judge my ponies. It's not like I'm hiding a flag in them or anything... Go away."</p>
                
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/pinky-pie.png" download>Pinkypie</a></p>
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/rainbow-dash.png" download>Rainbow Dash</a></p>
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/twilight-sparkle.png" download>Twilight Sparkle</a></p>
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/fluttershy.png" download>Fluttershy</a></p>
            </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 200 points for your team!</div>";
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