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
        $flagResult = checkFlag('8948-1777-5992', 'Color Math', 300); //212*64-42*110 (rbbg), 97+240/30*210 (ggbr), 255*255-239*247 (rbgr)
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
                <h3 style='text-align:center;'>Color Math</h3>
                <p style='text-align:center;'>Crypto • 300 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;I think you may have gotten off easy. Only writing simple python programs to automate decoding a flag,
                childs play. Lets have a bit more of a fun one. The flag for this one is in the format of three, four digit numbers
                seperated by hyphens. Example: 0000-0000-0000.</p>

                <p>This puzzle has a fair number of pieces. You may want to dig deep into the core values of this puzzle.</p>

                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/operations-keys.png" download>A</a></p>
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/operations.png" download>B</a></p>
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/values.png" download>C</a></p>
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/value-index.png" download>D</a></p>
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