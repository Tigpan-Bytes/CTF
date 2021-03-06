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
        $flagResult = checkFlag('justcantlose', 'Literal Reversal', 250);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    Literal Reversal';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>Literal Reversal</h3>
                <p style='text-align:center;'>Reverse • 250 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;If you want to make a copy of a website so that you can edit it on your local machine you can do these things.
                Open the page sources when on the webpage and copy it. Then using either Notepad or Visual Studio Code, create a .html file
                and paste the contents in (in notepad you may need to save as a .txt then rename it to be .html). You can view this webpage by
                opening that file in your browser (right click on file > Open With > Chrome/Firefox). You can also edit that file and
                any changes you make on it will appear in your local version.

                <p>&emsp;&emsp;"Alright buddy, that reversal was easy peasy, try this one on for size. This one is a bit more complicated.
                If you can crack the code to <a href="<?php echo $_SESSION['redir']?>challenge-site/Literal Reversal.html">this</a>, I might just have to give you
                250 points."</p>
             </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 250 points for your team!</div>";
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