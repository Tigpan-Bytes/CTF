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
        $flagResult = checkFlag('mainframe', 'FlagTree', 50);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    Secret Deal';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>FlagTree</h3>
                <p style='text-align:center;'>Reverse • 50 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;Reverse challenges in CTFs require you to look through and run a piece of code, then analyze it and find
                    out what leads you to the correct output. Here you have an example of some Python code where one of the outcomes leads
                    to a 'right' answer, you need to find what input leads to that output then enter it.
                </p>
                
                <code>
                # Written by the President of the United States of America<br>
                <br>
                flag = input('What is the flag?\n')<br>
                <br>
                if flag == 'playing':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'hacking':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'CTF':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'hacking':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'never':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'surrender':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'Bee':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'Swarm':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'Battle':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'winning':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'hopeful':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'capture':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'gambling':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'losers':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'mainframe':<br>
                &emsp;&emsp;print('Right Flag')<br>
                elif flag == 'hackers':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                elif flag == 'battle':<br>
                &emsp;&emsp;print('Wrong Flag')<br>
                else:<br>
                &emsp;&emsp;print('Really Wrong Flag')<br>
                </code>
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