<?php
	session_start();

	include 'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > 
    View Team: '.$_GET['viewteam'];
    $_SESSION['redir'] = '';

    $servername = "localhost";
    $username = "admin";
    $password = "pleaseNoHacking123";
    $dbname = "ctf";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    $stmt = mysqli_prepare($conn, "SELECT * FROM teams WHERE teamname = ? ");
    //prepared statements protect against sql injections

    mysqli_stmt_bind_param($stmt, "s", $_GET['viewteam']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);
?>

<?php include 'head.php';?>

<body>
    <?php include 'page-title.php';?>
    
    <div class='main-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h4>Team: <?php echo $row['teamname']; ?></h4>
            </div>

            <p>&emsp;&emsp;<span style='color: white;'>Score:</span> <?php echo $row['score']; ?></p>
            <p>&emsp;&emsp;<span style='color: white;'>Members:</span> <?php echo substr($row['members'], 0, strlen($row['members']) - 1); ?></p>
            <p>&emsp;&emsp;<span style='color: white;'>Solved Challenges:</span> <?php echo substr($row['solved'], 0, strlen($row['solved']) - 1); ?></p>
        </div>
    </div>

    <?php include 'scoreboard.php';?>
</body>