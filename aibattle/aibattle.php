<?php
    session_start();
    
    $_SESSION['redir'] = '../';

	include $_SESSION['redir'].'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: '.$_SESSION['redir'].'index.php');
    }
    else if (!start())
    {
        header('Location: '.$_SESSION['redir'].'main.php');
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> >
    AI Battle';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='main-holder'>
        <div class='underline' onclick="location.href='GO TO GITHUB PAGE IN THE FUTURE.php'">
            <h2>Download AI Kit</h2>
        </div>

        <div class='underline' onclick="location.href='upload.php'">
            <h2>Submit AI</h2>
        </div>

        <div class='portion-holder'>
            <div class='underline' onclick="location.href='overview.php'">
                <h2>Gameplay Overview</h2>
            </div>

            <p>&emsp;&emsp; Read this to learn all the rules of the game, Bee Swarm Battle. You should <span style='color: white;'>read me first!</span> </p>
        </div>

        <div class='portion-holder'>
            <div class='underline' onclick="location.href='documentation.php'">
                <h2>Documentation</h2>
            </div>

            <p>&emsp;&emsp; Read this to learn how to get started writing your own AI's and to use 
            the prebuilt functions and commands to jumpstart your Bots. You should <span style='color: white;'>read me second!</span> </p>
        </div>
    </div>

    <?php include $_SESSION['redir'].'scoreboard.php';?>
</body>