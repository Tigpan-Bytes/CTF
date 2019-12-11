<?php
	session_start();

	include 'func.php';
    
    if (!isAdminAuth(getSessionVar('adminUsername'), getSessionVar('adminPassword')))
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = 'Admin';
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

    if (isAdminAuth(getSessionVar('adminUsername'), getSessionVar('adminPassword')))
    {
        $sql = '';
        $sqltwo = '';
        $resulted = '';
        $resultedtwo = '';
        $err = '';
        if (array_key_exists('fullquery', $_POST))
        {
            $sql = $_POST['query'];
        }
        if (array_key_exists('cnusubmit', $_POST))
        {
            if (strlen($_POST['newUsername']) > 16 || strlen($_POST['newUsername']) == 0)
            {
                $err = 'Max length for username is 16. Your length was '.strlen($_POST['newUsername']).".";
            }
            else
            {
                $sql = "
                INSERT INTO users (username, pwhash, team) 
                SELECT * FROM (SELECT '".$_POST['newUsername']."' as 'username', '".password_hash($_POST['newPassword'], PASSWORD_BCRYPT)."' as 'pwhash', '".$_POST['newTeam']."' as 'team') AS tmp
                WHERE NOT EXISTS (
                    SELECT username FROM users WHERE username='".$_POST['newUsername']."'
                ) AND EXISTS (
                    SELECT teamname FROM teams WHERE teamname='".$_POST['newTeam']."'
                ) LIMIT 1";
                $sqltwo = "UPDATE teams SET members = concat(members, concat('".$_POST['newUsername']."', ',')) WHERE (teamname = '".$_POST['newTeam']."')";
            }
        }
        if (array_key_exists('dusubmit', $_POST))
        {
            $sql = "
            DELETE FROM users 
            WHERE username='".$_POST['newUsername']."'";
        }
        if (array_key_exists('cupsubmit', $_POST))
        {
            $sql = "
            UPDATE users SET pwhash='".password_hash($_POST['newPassword'], PASSWORD_BCRYPT)."'
            WHERE username ='".$_POST['newUsername']."'";
        }
        if (array_key_exists('cutsubmit', $_POST))
        {
            $sql = "
            UPDATE users SET team='".$_POST['newTeam']."'
            WHERE username ='".$_POST['newUsername']."'";
            $sqltwo = "UPDATE teams SET members = concat(members, concat('".$_POST['newUsername']."', ',')) WHERE (teamname = '".$_POST['newTeam']."')";
        }

        if (array_key_exists('cntsubmit', $_POST))
        {
            if (strlen($_POST['newTeamname']) > 10 || strlen($_POST['newTeamname']) == 0)
            {
                $err = 'Max length for teamname is 10. Your length was '.strlen($_POST['newTeamname']).".";
            }
            else
            {
                $sql = "
                INSERT INTO teams (teamname, members, score, solved) 
                SELECT * FROM (SELECT '".$_POST['newTeamname']."' as 'teamname', '' as 'members', ".$_POST['newScore']." as 'score', '".$_POST['newSolveds']."' as 'solved') AS tmp
                WHERE NOT EXISTS (
                    SELECT teamname FROM teams WHERE teamname='".$_POST['newTeamname']."'
                ) LIMIT 1";
            }
        }
        if (array_key_exists('dtsubmit', $_POST))
        {
            $sql = "
            DELETE FROM teams 
            WHERE teamname='".$_POST['newTeamname']."'";
            $sqltwo = "
            DELETE FROM users 
            WHERE team='".$_POST['newTeamname']."'";
        }
        if (array_key_exists('ctscoresubmit', $_POST))
        {
            $sql = "
            UPDATE teams SET score=".$_POST['newScore']."
            WHERE teamname ='".$_POST['newTeamname']."'";
        }
        if (array_key_exists('ctsolvedsubmit', $_POST))
        {
            $sql = "
            UPDATE teams SET solved='".$_POST['newSolved']."'
            WHERE teamname ='".$_POST['newTeamname']."'";
        }

        if (array_key_exists('resetallsubmit', $_POST))
        {
            $sql = "
            UPDATE teams SET score = 0 AND solved = ''";
        }
        if (array_key_exists('resetallsubmit', $_POST))
        {
            $sql = "
            UPDATE teams SET score = 0 AND solved = ''";
        }

        if ($sql != '')
        {
            mysqli_multi_query($conn, $sql);
            if (mysqli_affected_rows($conn) > 0) 
            {
                $resulted = mysqli_affected_rows($conn).' row affected.';
            } 
            else 
            {
                $resulted = "Nothing affected.";
            }
        }
        if ($sqltwo != '')
        {
            mysqli_multi_query($conn, $sqltwo);
            if (mysqli_affected_rows($conn) > 0) 
            {
                $resultedtwo = mysqli_affected_rows($conn).' row affected.';
            } 
            else 
            {
                $resultedtwo = "Nothing affected.";
            }
        }
    }
?>

<?php include 'head.php';?>

<body>
    <div class='underline'>
        <h3 style='text-align:center;'>Alright Admin, work your magic.</h3>
    </div>

    <?php
        if(isset($err) && $err != '') 
        { 
            echo "<p>ERROR: ".$err."</p>";
        } 
        if(isset($sql) && $sql != '') 
        { 
            echo "<p>SQL 1: ".$sql."</p>";
        } 
        if(isset($resulted) && $resulted != '') 
        { 
            echo "<p>Result 1: ".$resulted."</p>";
        } 
        if(isset($sqltwo) && $sqltwo != '') 
        { 
            echo "<p>SQL 2: ".$sqltwo."</p>";
        } 
        if(isset($resultedtwo) && $resultedtwo != '') 
        { 
            echo "<p>Result 2: ".$resultedtwo."</p>";
        } 
    ?>

    <div class='scoreboard-holder' style='padding-left: 20px;'> 
        <h3 class='underline'>Users-Team</h3>
        <?php
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

            $sql = "SELECT username, team FROM users ORDER BY team";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) 
            {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<teamname style='font-size: 16px;'>" . $row["username"]. "</teamname> <teamscore style='font-size: 16px;'>" . $row["team"]. "</teamscore><br>";
                }
            } 
            else 
            {
                echo "<teamname>Currently no users.</teamname>";
            }
        ?>
    </div>
    
    <?php include 'scoreboard.php';?>

    <h3 style='text-align:left;'>Full Query (BSB?)</h3>
    <form method="post">
		Query: <input type="text" name="query"><br>
		<input type="submit" name='fullquery'>
	</form>

    <h3 style='text-align:left;'>Create new User</h3>
    <form method="post">
		Username: <input type="text" name="newUsername"><br>
		Password: <input type="text" name="newPassword"><br>
        Team: <input type="text" name="newTeam"><br>
		<input type="submit" name='cnusubmit'>
	</form>

    <h3 style='text-align:left;'>Delete User</h3>
    <form method="post">
		Username: <input type="text" name="newUsername"><br>
		<input type="submit" name='dusubmit'>
	</form>

    <h3 style='text-align:left;'>Change User Password</h3>
    <form method="post">
		Username: <input type="text" name="newUsername"><br>
        New Password: <input type="text" name="newPassword"><br>
		<input type="submit" name='cupsubmit'>
	</form>

    <h3 style='text-align:left;'>Change User Team</h3>
    <form method="post">
		Username: <input type="text" name="newUsername"><br>
        New Team: <input type="text" name="newTeam"><br>
		<input type="submit" name='cutsubmit'>
	</form>

    <div class='page-spacer'></div>
    <div class='page-spacer'></div>
    <div class='page-spacer'></div>

    <h3 style='text-align:left;'>Create new Team</h3>
    <form method="post">
		Teamname: <input type="text" name="newTeamname"><br>
		Score: <input type="text" name="newScore"><br>
        Solveds: <input type="text" name="newSolveds"><br>
		<input type="submit" name='cntsubmit'>
	</form>

    <h3 style='text-align:left;'>Delete Team</h3>
    <form method="post">
		Teamname: <input type="text" name="newTeamname"><br>
		<input type="submit" name='dtsubmit'>
	</form>

    <h3 style='text-align:left;'>Change Team Score</h3>
    <form method="post">
		Teamname: <input type="text" name="newTeamname"><br>
        New Score: <input type="text" name="newScore"><br>
		<input type="submit" name='ctscoresubmit'>
	</form>

    <h3 style='text-align:left;'>Change Team Solved</h3>
    <form method="post">
		Teamname: <input type="text" name="newTeamname"><br>
        New Solved: <input type="text" name="newSolved"><br>
		<input type="submit" name='ctsolvedsubmit'>
	</form>

    <div class='page-spacer'></div>
    <div class='page-spacer'></div>
    <div class='page-spacer'></div>

    <h3 style='text-align:left;'>Reset all Teams Score and Solved</h3>
    <form method="post">
		<input type="submit" name='resetallsubmit'>
	</form>
</body>