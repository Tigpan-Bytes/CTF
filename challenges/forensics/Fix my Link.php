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
        $flagResult = checkFlag('only_getting_harder_from_here', 'Fix my Link', 50);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    Fix my Link';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>Fix my Link</h3>
                <p style='text-align:center;'>Forensics • 50 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;You can view any HTML being used by right clicking on the page where you want to view it, then clicking Inspect
                    or Inspect Element (you can also click View Page Source but this will show you the raw html for the entire webpage instead
                    of the specfic element you want to view. In addition, when you inspect element you can also change the HTML right there
                    and it will be changed on your browser.</p>
                
                <p>&emsp;&emsp;This challenge was originally going to be free, a single link to the flag with no real challenge... but
                    I can't figure out how to get the button to work, if you can figure it out then you can get the flag. You might want 
                    to use <a href="https://www.w3schools.com/html/html_links.asp">this</a> to help you learn how to make links.</p>

                <p>
                    <a click_for_link_to_webpage="<?php echo $_SESSION['redir']?>challenge-site/flag.html">Click for Flag</a>
                </p>
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