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
        $flagResult = checkFlag('nohack', "The 'Ess Que Elle' Needle Shop", 450);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    The \'Ess Que Elle\' Needle Shop';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>The 'Ess Que Elle' Needle Shop</h3>
                <p style='text-align:center;'>Forensics • 450 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;"Hey buddy, a guy that owes me money owns this 'needle shop' I want you to hack into it and give me his password. 
                    If you can give me the password then I can reward you with 450 points. I also know some things that may help you:<br><br>
                    &emsp;1. The database he uses is called 'My Ess Que Elle', however I don't know what that means.<br>
                    &emsp;2. His account's username is 'Daniel'.<br>
                    &emsp;3. The table with all the users is called 'Users'.<br>
                    &emsp;4. There are at least 3 ways of solving this (another hacker friend told me this).<br><br>
                    &emsp;&emsp;Best of luck to you!" - A Friend
                    </p>
                
                <p>&emsp;&emsp;<a href="<?php echo $_SESSION['redir']?>challenge-site/needleshop/index.php">The 'Ess Que Elle' Needle Shop</a></p>
             </div>

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 450 points for your team!</div>";
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