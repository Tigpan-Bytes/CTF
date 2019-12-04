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
        $flagResult = checkFlag('you_are_hacker_supreme', 'PwnaLisa', 400);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    PwnaLisa';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>PwnaLisa</h3>
                <p style='text-align:center;'>Crypto • 400 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;Hey, dude! You are clearing this challenges too quickly, we need you to slow it down. So for this one I'm not 
                going to give you any hints, you will recieve no Comment from me.</p>

                <!--1 least significant bit, 3px per char, message ends on 1-->

                <p>Here's a picture of the Mona Lisa, nothing else.</p>

                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/pwner-lisa.png" download>Mona Lisa</a></p>
            </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 400 points for your team!</div>";
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