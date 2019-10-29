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
        $flagResult = checkFlag('sh0u1d.h4ve.b3at.1t.l1g1t', 'Runner Cube 4', 100);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\'../challenges.php\'" class="btn">Challenges</button> >
    Runner Man 4';

    $_SESSION['redir'] = '../';
?>

<?php include '../head.php';?>

<body>
    <?php include '../page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>Runner Cube 4</h3>
                <p style='text-align:center;'>Forensics • 100 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;As you may already know, when you go on any website you can right click to 'inspect element' this allows you to look
                at all of the HTML of the page and even change it (it doesn't change for everybody just locally for yourself). In addition to that you
                can also view any JavaScript being run by inspecting element or pressing f12 to bring up the developer console, then either going to
                sources (Chrome) or debugger (Firefox). In that section you can find the JavaScript code, it is also sometimes a good idea to copy the JS
                the HTML onto your computer so you can edit it and view it more easily.</p>
                
                <p>&emsp;&emsp;Can you beat my game, <a href="../challenge-site/Runner Cube 4.html">Runner Cube 4</a>? I could do it first try 
                (I might have to use a cheat code however).</p>

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