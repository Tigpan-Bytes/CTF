<?php
    session_start();
    
    $_SESSION['redir'] = '../';

	include $_SESSION['redir'].'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> >
    <button onclick="location.href=\'aibattle.php\'" class="btn">AI Battle</button> >
    Overview';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='main-holder'>
        <div class='portion-holder'>
            <h5>CTF: Bee Swarm Battle</h5>

            <p>&emsp;&emsp; Bee Swarm Battle is similar to the Real Time Strategy genre. It is a multiplayer, simultaneous-turns 
            game that takes place on a large interconnected procedurally generated grid. Many players will inhabit the grid at one time. You construct
            an AI that controls your Bees to destroy the enemies as efficently as possible without getting yourself killed in the
            process.</p>
            <p>&emsp;&emsp; Every Team will write AI's that control Bees to collect food, grow their colony and crush others. Teams may submit
            as many AI's as they wish, but only the latest submission will get used in the competition. Every <span style='color: white;'>15mins</span> each team's most recent AI is tested against
            all the other team's AI's. The team who gets <span style='color: white;'>first gets 50 points</span>, <span style='color: white;'>second gets 40 points</span>, 
            and <span style='color: white;'>third gets 30 points</span></p>
        </div>

        <div class='portion-holder'>
            <h5>Map, Food, and Hives</h5>


            <p> <img src="map_example.png" alt="An Example 3x3 Map" align="right"> &emsp;&emsp;The map is always a pattern of repeating 32x32 tile areas.
             Where <span style='color: white;'>0,0 is in the bottom left corner</span> of the map. The number of repeating grids on
            the x and y axis is dependant on how many AI's are able to participate.</p>
            <p>&emsp;&emsp;In the picture there are light green squares. These are food tiles. When walked over by a bee (the diamond shaped object), they are collect for
            that colony. That colony gets 2 'food value', distributed evenly between the colony's remaining hives. A hive cannot have more than 10 'food value'.
            At some point in the turn (explained later), for each hive, if there is no bee standing on it and if its food value is greater than 0, then decrease its
            food value by one and spawn a friendly bee. If a hive is stepped on by an enemy bee, that hive is destroyed. <span style='color: white;'>Every colony starts with 2 hives, and 
            10 bees</span> (5 bees arranged around each hive in a + shape).</p>
            <p>&emsp;&emsp; The game starts with 3 food tiles in each grid, these are mirrored to the other grids for fairness. <span style='color: white;'>Food is spawned per turn based on
            the colony with the highest bee count</span>. If the highest bee count is less than 80, than food is spawned every 8 turns. 
            If the highest bee count is less than 140 and greater or equal to 80, than food is spawned every 16 turns.
            Finally if the highest bee count is less than 200 and greater or equal to 140, than food is spawned every 32 turns, and if the highest bee count is greater or equal
            to 200 then no food is spawned.
        </div>

        <div class='portion-holder'>
            <h5>The Bee</h5>

            <p> The Bee has many stats and attributes associated with it. </p>
            <p>
            &emsp;• Index. (the id of the colony it belongs to) [.index] <br>
            &emsp;• Position. (x,y) [.position] <br>
            &emsp;• Health. (int from 0-6) [.health] <br>
            &emsp;• Data. (a string that can be freely controlled by the colony to store data) [.data] <br>
            &emsp;• Action. (a string that is used to tell the game what action the bee should take) [.action] <br>
            &emsp;• Action Success. (a bool if the last action was successful (default True)) [.action_success] <br>
            </p>

            <p> On its turn it can do 2 different actions either Attack (A) or Move (M). </p>
            <p> Move: A move action  </p>
        </div>
    </div>

    <?php include $_SESSION['redir'].'scoreboard.php';?>
</body>