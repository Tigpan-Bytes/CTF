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
        $flagResult = checkFlag('LE0n4rD0-dA-vInC1', 'Gallery', 100);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    Gallery';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>Gallery</h3>
                <p style='text-align:center;'>Forensics • 100 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;"Hello, sorry the Gallery doesn't have any paintings to show you yet. We do have paintings, but they are all broken!
                We can't seem to look at them, try reaching deep into the text of the painting to fix it."</p>
                
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/starry-night.jpg" download>Starry Night</a> - Vincent van Gogh (CURRENTLY BROKEN)</p>
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/the-scream.jpg" download>The Scream</a> - Edvard Munch (CURRENTLY BROKEN)</p>
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/the-persistence-of-memory.jpg" download>The Persistence of Memory</a> - Salvador Dali (CURRENTLY BROKEN)</p>
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