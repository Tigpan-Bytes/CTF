<?php
	session_start();

	include '../func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }
    else
    {
        $flagResult = checkFlag('shawcenter', 'Secret Deal', 150);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\'../challenges.php\'" class="btn">Challenges</button> >
    Secret Deal';

    $_SESSION['redir'] = '../';
?>

<?php include '../head.php';?>

<body>
    <?php include '../page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>Secret Deal</h3>
                <p style='text-align:center;'>Reverse • 150 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;Reverse challenges require a lot of technical knowledge and a lot of searching what random functions do on the internet. 
                For these challenges you will be given a piece of code that typically checks an input, encodes it, and checks it against a constant value.
                The input that results in the correct outcome being met is the flag.</p>

                <p>&emsp;&emsp;Some important things to look up for these challenges may be the ASCII values for characters and what Bitwise operations are.
                They may not be for this one, but they may come up later.</p>
                
                <p>&emsp;&emsp;"Hey buddy, meet me behind <a href="../challenge-site/Secret-Deal.py" download>this</a> location tonight. 
                Then I can give you the 1337 hacking tools." - Unknown.</p>
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