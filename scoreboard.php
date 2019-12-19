<div class='scoreboard-holder'> 
    <h3 class='underline'>Scoreboard</h3>
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

        $sql = "SELECT teamname, score FROM teams ORDER BY score DESC";
        $result = mysqli_query($conn, $sql);

        $num = 1;

        if (mysqli_num_rows($result) > 0) 
        {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) 
            {
                if (!empty($_SESSION['team']) && $row['teamname'] == $_SESSION['team'])
                {
                    echo "<arrow>=>&nbsp;</arrow>
                    <form method='get' action='".$_SESSION['redir']."viewteam.php' class='entry'><input type='submit' class='yourteamname clickable' name='viewteam' value='". $row["teamname"]."'>
                    </input> <teamscore>" . $row["score"]. "</teamscore></form><br>";
                }
                else
                {
                    echo "<number>".$num.":&nbsp;</number>
                    <form method='get' action='".$_SESSION['redir']."viewteam.php' class='entry'><input type='submit' class='teamname clickable' name='viewteam' value='". $row["teamname"]."'>
                    </input> <teamscore>" . $row["score"]. "</teamscore></form><br>";
                }
                $num++;
            }
        } 
        else 
        {
            echo "<teamname>Currently no teams.</teamname>";
        }
    ?>
</div>