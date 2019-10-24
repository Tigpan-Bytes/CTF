<?php
	session_start();

	include 'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));
    if ($auth['success'])
    {
        $message = 'Yeeter';
    }
    else
    {
        header('Location: index.php');
    }
?>

<?php include 'head.php';?>

<body>
	<?php include 'page-title.php';?>
    <p>This is the main page for only people who have logged in. In the future this will link to the jeopardy and the ai comp. 
    Also on the right side bar (if you are not in a challenge), the scores for each team. Base the design off <a href="https://github.com/UnrealAkama/NightShade">this</a>.</p>
    <h2>Jeopardy</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt natus optio quas culpa tenetur. 
    Quibusdam eos quaerat distinctio iure error architecto adipisci dolores veniam, nihil voluptas, dolor ex reprehenderit aliquid?</p>

    <p2>
    Welcome <?php echo getSessionVar('username'); ?><br>
    Your password is: <?php echo getSessionVar('password'); ?>
    </p2>
</body>