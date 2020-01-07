<?php
	session_start();

	include 'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = 'Main';
    $_SESSION['redir'] = '';
?>

<?php include 'head.php';?>

<body>
    <?php include 'page-title.php';?>
    
    <div class='main-holder'>
        <div class='portion-holder'>
            <div class='underline' onclick="location.href='challenges.php'">
                <h2>Jeopardy</h2>
            </div>

            <p>&emsp;&emsp;The Jeopardy Capture the Flag event is a CTF that is seperated into catagories. Each catagory covering
            a different type and area of hacking. Each catagory is also seperated into different challenges, each one harder than the 
            last but also awarding more points. You are not restricted to only a specific catagory or even solving the challenges in 
            order, you may do any challenge at any time. There are 3 different catagories for this CTF.</p>
            
            <p>&emsp;&emsp;
            <span style='color: white;'>Crypto</span> is cracking codes and solving ciphers. 
            <span style='color: white;'>Forensics</span> is about finding hidden information to piece together the Flag. Finally
            <span style='color: white;'>Reverse</span> is all about working backwards through code to find the Flag.
            </p>
        </div>

        <div class='portion-holder'>
            <div class='underline' onclick="location.href='aibattle/aibattle.php'">
                <h2>AI Battle</h2>
            </div>

            <p>&emsp;&emsp;In most CTFs for your skill level, there is typically a Misc or Prog catagory for coding
			programs to solve specific problems. The twist for this CTF is that instead of a Prog catagory, an AI Battle is being
			held. Each team submits their best AIs to play a simple game, every <span style='color: white;'>10mins</span> each team's most recent AI is tested against
            all the other team's Bots. The team who gets <span style='color: white;'>first gets 200 points</span>, <span style='color: white;'>second gets 125 points</span>, 
            and <span style='color: white;'>third gets 50 points</span>. Each team can
			submit AIs as often as they please, but only the most recent one is used. Everyone will have access to extensive documentation,
			some sample Bots, and an API for for controling the AI, and a local version of the game to test your bot before the match. Have fun!
			</p>
        </div>
    </div>

    <?php include 'scoreboard.php';?>
</body>