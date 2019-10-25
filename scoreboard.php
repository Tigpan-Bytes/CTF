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
                    echo "<arrow>=>&nbsp;</arrow><yourteamname>" . $row["teamname"]. "</yourteamname> <teamscore>" . $row["score"]. "</teamscore><br>";
                }
                else
                {
                    echo "<number>".$num.":&nbsp;</number><teamname>" . $row["teamname"]. "</teamname> <teamscore>" . $row["score"]. "</teamscore><br>";
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