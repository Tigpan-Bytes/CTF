<?php
	session_start();

	include 'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = 'Main';
?>

<?php include 'head.php';?>

<body>
	<?php include 'page-title.php';?>
    <div class='main-holder'>
        <div class='portion-holder'>
            <div class='underline' onclick="location.href='challenges.php'">
                <h2>Jeopardy</h2>
            </div>

            <p>&emsp;&emsp;This is the main page for only people who have logged in. In the future this will link to the jeopardy and the ai comp. 
            Also on the right side bar (if you are not in a challenge), the scores for each team. Base the design off <a href="https://github.com/UnrealAkama/NightShade">this</a>.</p>
            
            <p>&emsp;&emsp;Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus adipisci perferendis labore ipsa harum repudiandae ratione unde voluptate, pariatur, 
            accusamus porro eius eaque nihil officiis laborum libero laudantium consequatur aperiam! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus quibusdam temporibus hic sunt
            aperiam illum accusamus alias. Ullam natus voluptatum fugiat doloribus culpa magni repellendus nihil, excepturi, deleniti dolor expedita.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas distinctio voluptates ut, commodi pariatur obcaecati similique repellat 
            perspiciatis vitae accusamus sequi totam aspernatur facilis officia quidem autem temporibus ad earum!</p>
        </div>

        <div class='portion-holder'>
            <div class='underline'>
                <h2>Bot Conquest</h2>
            </div>
            <p>&emsp;&emsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt natus optio quas culpa tenetur. 
            Quibusdam eos quaerat distinctio iure error architecto adipisci dolores veniam, nihil voluptas, dolor ex reprehenderit aliquid?</p>
        </div>
    </div>
</body>