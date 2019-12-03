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
            <h5>Getting Started</h5>

            <p>&emsp;&emsp; To get started writing an AI for Bee Swarm Battle first go back to the AI Battle section of this webpage to 'Download AI Kit',
                this will navigate you to a public github repository. Download it.
            </p>
            <p>&emsp;&emsp; When it is downloaded you <span style='color: white;'>first must install pygame</span>, you can do this in thonny easily by 
                going to Tools > Manage Packages, then search for pygame and install. Then you can run main.py. You will notice the game starts with 3 bots.
                These are the default bots, you may use code from them to construct your own AI, you may even submit the entire thing yourself (they won't do that well).
                It is strongly recommended that you read and look through these bots to help you learn. You should also take the best parts of each bot and put
                them together to make a better bot.
            </p>
            <p>&emsp;&emsp; You should have your team build their bots, then test them against each other on your local machine. Then submit the best one by going
                to 'Submit AI' on the AI Battle section of this webpage. You can choose what bots to test by putting them in the bots folder. If you want to change how
                many grids there should be on the map (to accommodate for more or less bots) open main.py then change the constant variables X_GRIDS and Y_GRIDS accordingly.
            </p>
            <p>&emsp;&emsp; It is also <span style='color: white;'>highly recommended</span> that you skim the overview before reading this.</p>
            </p>
        </div>

        <div class='portion-holder'>
            <h5>Position</h5>

            <p> The position of everything in Bee Swarm Battle is stored using the Position type. It has these variables and constuctors. </p>

            <p>
                &emsp;&emsp;&emsp;&emsp;&emsp; <span style='color: white;'>Position</span> <br>
                &emsp;&emsp;&emsp; • position.x [Int] (The x coordinate) <br>
                &emsp;&emsp;&emsp; • position.y [Int] (The y coordinate) <br>
                &emsp;&emsp;&emsp; • CONSTRUCTOR: position = Position(x,y) (creates a new position variable with the variables x and y) <br>
            <p>

            <p> For example: </p>
            <code>
            # This code creates 2 different positition variable <br>
            # Then creates a third one with the sum of the others positions <br>
            # Then prints the contents of the third Position <br>
             <br>
            a = Position(4,2) <br>
            b = Position(1,7) <br>
            c = Position(a.x + b.x, a.y + b.y) <br>
             <br>
            print(str(c.x) + ', ' + str(c.y)) #prints '5, 9' <br>
            </code>

            <p> It is also important to note that you cannot change . </p>
        </div>

        <div class='portion-holder'>
            <h5>Tiles</h5>

            <p> Every single square on the.</p>
            <p> The World also conains a 2d array of Tile objects. Every tile class has these variable.</p>

            <p>
                &emsp;&emsp;&emsp;&emsp;&emsp; <span style='color: white;'>Tile Class</span> <br>
                &emsp;&emsp;&emsp; • tile.walkable [Bool] (True if the tile has no wall, false if it contains a wall) <br>
                &emsp;&emsp;&emsp; • tile.hive [Bool] (True if the tile contains a hive) <br>
                &emsp;&emsp;&emsp; • tile.was_hive [Bool] (True if the tile ever contained a hive) <br>
                &emsp;&emsp;&emsp; • tile.hive_index [Int] (The index (id) of the AI that owns this hive, -1 if this tile is not a hive) <br>
                &emsp;&emsp;&emsp; • tile.food_level [Int] (The 'food level' of the hive on this position, -1 if this tile is not a hive) <br>
                &emsp;&emsp;&emsp; • tile.food [Bool] (True if the tile contains food, false otherwise) <br>
                &emsp;&emsp;&emsp; • tile.bee [Bee Object] (The bee object that is on this tile, None if there is no bee on the tile) <br>
            <p>

            <p> For example: </p>
            <code>
            # This code creates a function that takes in a tile, then prints 'FOOD' if it contains food, and 'HIVE' if it contains a hive<br>
             <br>
            def check_tile(tile): <br>
            &emsp;&emsp;if tile.food: <br>
            &emsp;&emsp;&emsp;&emsp;print('FOOD') <br>
            &emsp;&emsp;if tile.hive: <br>
            &emsp;&emsp;&emsp;&emsp;print('HIVE') <br>
            </code>
        </div>
    </div>

    <?php include $_SESSION['redir'].'scoreboard.php';?>
</body>