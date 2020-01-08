<?php
	session_start();

	include 'func.php';
    
	$auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

	if ($auth['success'])
	{
		header('Location: main.php');
	}

	$_SESSION['titlePath'] = 'Index';
	$_SESSION['redir'] = '';
?>

<?php include 'head.php';?>

<body>
	<?php include 'page-title.php';?>

	<div class='main-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h4>What is this?</h4>
            </div>

            <p>&emsp;&emsp;A Capture the Flag event (CTF), is an ethical hacking competition where participants are given
			several challenges, in each of which is a Flag. Finding and entering that Flag awards points to your team. The 
			team with the most points at the end of the event wins.</p>

			<p>&emsp;&emsp;This is also a Jeopardy style CTF with a twist (explained later), in a Jeopardy CTF there are many 
			catagories of challenges (3 in this CTF). Each catagory is also seperated into different challenges, 
			each one harder than the last but also awarding more points. You arn't restricted to only a specific 
            catagory or even solving the challenges in order, you may do any challenge at any time.</p>
			
			<p>&emsp;&emsp;Crypto is cracking codes and solving ciphers. Forensicsis about finding hidden information to piece together the Flag.
			Reverse is all about working backwards through code to find the Flag.</p>

			<p>&emsp;&emsp;In most CTFs for your skill level, there is typically a Misc or Prog catagory for coding
			programs to solve specific problems. The twist for this CTF is that instead of a Prog catagory, an AI Battle is being
			held. Each team submits their best AIs to play a simple game, every 15mins each team's most recent AI is tested against
			all the other team's Bots. The team who wins gets 250 points, second gets 175 points, and third gets 100 points. Each team can
			submit AIs as often as they please, but only the most recent one is used. Everyone will have access to extensive documentation,
			some sample Bots, and an API for for controling the AI, and a local version of the game to test your bot before the match. Have fun!
			</p>
        </div>
    </div>

	<?php include 'scoreboard.php';?>
</body>