<?php
	session_start();

	include 'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));
    
    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > Challenges';
?>

<?php include 'head.php';?>

<body>
	<?php include 'page-title.php';?>
    <div class='main-holder'>
        <p>&emsp;&emsp;Yo you are on the jeopardy page.</p>
    </div>
</body>