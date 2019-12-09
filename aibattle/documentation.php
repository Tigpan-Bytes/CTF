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
        <div class='underline'>
            <h5>Getting Started</h5>

            <p>&emsp;&emsp; To get started writing an AI for Bee Swarm Battle first go back to the AI Battle section of this webpage to 'Download AI Kit',
                this will navigate you to a public github repository. Download it.
            </p>
            <p>&emsp;&emsp; When it is downloaded you <span style='color: white;'>first must install the Python module pygame</span>, you can do this in thonny easily by 
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
            <p>&emsp;&emsp;<span style='color: white;'>Make absolutly certain that when you create and upload bots that you change the TEAM variable (3rd line), if you don't
                your team will not get points for winning.</span></p>
        </div>

        <div class='underline'>
            <h5>Position</h5>

            <p> The position of everything in Bee Swarm Battle is stored using the Position type. It has these variables and constuctors. </p>

            <p>
                &emsp;&emsp;&emsp;&emsp;&emsp; <span style='color: white; font-size: 24px;'>Position</span> <br>
                &emsp;&emsp;&emsp; • position.x [Int] (The x coordinate) <br>
                &emsp;&emsp;&emsp; • position.y [Int] (The y coordinate) <br>
                &emsp;&emsp;&emsp; • CONSTRUCTOR: position = Position(x,y) (creates a new position variable with the variables x and y) <br>
            <p>

            <p> For example: </p>
            <code>
            <span style='color: #666;'># This code creates 2 different positition variable <br>
            # Then creates a third one with the sum of the others positions <br>
            # Then prints the contents of the third Position</span> <br>
             <br>
            a = Position(4,2) <br>
            b = Position(1,7) <br>
            c = Position(a.x + b.x, a.y + b.y) <br>
             <br>
            print(str(c.x) + ', ' + str(c.y)) <span style='color: #666;'>#prints '5, 9'</span> <br>
            </code>

            <p> It is also important to note that Position is immutable (it is a NamedTuple (don't worry if you don't know what this means)), this means you cannot change parts of it without changing all of it. Example: </p>
            <code>
            a = Position(some_x, some_y) <br>
             <br>
            a.x = 5 <span style='color: #666;'># THIS WILL ERROR</span> <br>
            a = Position(5, a.y) <span style='color: #666;'># This is correct and will not error</span><br>
            </code>
        </div>

        <div class='underline'>
            <h5>Tiles</h5>

            <p> &emsp;&emsp;Every single square on the map has a Tile object associated with it.</p>
            <p> &emsp;&emsp;The World object (explained later) also conains a 2d array of Tile objects. Every tile class has these variable.</p>

            <p>
                &emsp;&emsp;&emsp;&emsp;&emsp; <span style='color: white; font-size: 24px;'>Tile Class</span> <br>
                &emsp;&emsp;&emsp; • tile.walkable [Bool] (True if the tile has no wall, false if it contains a wall) <br>
                &emsp;&emsp;&emsp; • tile.hive [Bool] (True if the tile contains a hive) <br>
                &emsp;&emsp;&emsp; • tile.was_hive [Bool] (True if the tile ever contained a hive) <br>
                &emsp;&emsp;&emsp; • tile.hive_index [Int] (The index (id) of the AI that owns this hive, -1 if this tile is not a hive) <br>
                &emsp;&emsp;&emsp; • tile.food_level [Int] (The 'food level' of the hive on this position, -1 if this tile is not a hive) <br>
                &emsp;&emsp;&emsp; • tile.food [Bool] (True if the tile contains food, false otherwise) <br>
                &emsp;&emsp;&emsp; • tile.bee [Bee Object] (The bee object that is on this tile, None if there is no bee on the tile) <br>
            <p>

            <p> &emsp;&emsp;For example: </p>
            <code>
            <span style='color: #666;'># This code creates a function that takes in a tile, then prints 'FOOD' if it contains food, and 'HIVE' if it contains a hive</span><br>
             <br>
            def check_tile(tile): <br>
            &emsp;&emsp;if tile.food: <br>
            &emsp;&emsp;&emsp;&emsp;print('FOOD') <br>
            &emsp;&emsp;if tile.hive: <br>
            &emsp;&emsp;&emsp;&emsp;print('HIVE') <br>
            </code>

            <p> &emsp;&emsp;You can create new instances of tile but there is no reason to. If you want to you can dig around in the class_data file to find it. </p>
        </div>

        <div class='underline'>
            <h5>World</h5>

            <p> &emsp;&emsp;Every AI is also given a World object shortly after being created. This world object contains all the data for the map.
            The World also conains a 2d array of Tile objects. Every World class has these variable.</p>

            <p>
                &emsp;&emsp;&emsp;&emsp;&emsp; <span style='color: white; font-size: 24px;'>World Class</span> <br>
                &emsp;&emsp;&emsp; • world.width [Int] (The width of the world (x size)) <br>
                &emsp;&emsp;&emsp; • world.height [Int] (The height of the world (y size)) <br>
                &emsp;&emsp;&emsp; • world.half_width [Int] (Half of the width of the world) <br>
                &emsp;&emsp;&emsp; • world.half_height [Int] (Half of the height of the world) <br>
                &emsp;&emsp;&emsp; • world.tiles [2d array of Tiles] (The tiles for every map) <br>
            <p>

            <p> &emsp;&emsp;In addition to those variable the World also has many useful built in functions to help you:</p>
            
        </div>
        <div class='underline'>

            <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 24px;'><span style='color: white;'>world.get_tile</span>(<span style='color: white;'>x</span> [Int], 
                <span style='color: white;'>y</span> [Int])</span></p>
            <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 20px; color: white;'>world.get_tile(x, y)</span></p>

            <p> &emsp;&emsp;This function returns the tile object at the x, y coordinates specified. You could directly access world.tiles[x][y], but this is easier and more fool proof.</p>
            <code>
            <span style='color: #666;'># This code checks if the tile to the north of a bee contains food and prints 'FOOD TO NORTH' if it does</span><br>
             <br>
            class AI: <br>
            <br>
            &emsp;&emsp;... <span style='color: #666;'># other code goes here, such as __init__ and do_turn</span> <br>
            <br>
            &emsp;&emsp;def check_north_of_bee(self, bee): <br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># You need include self as a parameter for all functions in your AI</span> <br>
            &emsp;&emsp;&emsp;&emsp;tile = self.world.get_tile(bee.x, bee.y + 1) <br>
            &emsp;&emsp;&emsp;&emsp;if tile.food: <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;print('FOOD TO NORTH') <br>
            </code>

        </div>
        <div class='underline'>

            <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 24px;'><span style='color: white;'>world.get_x_in_range</span>(<span style='color: white;'>start</span> [Position], 
                <span style='color: white;'>target_func</span> [Function], 
                <span style='color: white;'>max_distance</span> [Int],
                <span style='color: white;'>sort_func</span> [Function (Optional: Default = None)])</span></p>
                <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 20px; color: white;'>world.get_x_in_range(start, target_func, max_distance, sort_func=None)</span></p>

            <p> &emsp;&emsp;This function is an easy way to get a list of all the things that meet the target criteria in a certain range. 
                For example if you run get_x_in_range with a range of 3, you will access the exact same tiles as the range of an attacking bee.</p>
            <p> &emsp;&emsp;All target functions (for every function that uses them) must have 2 parameters (other than self), position, then distance. Position
                is the Position variable of the tile being checked and distance is the distance to the start.</p>
            <code>
            <span style='color: #666;'># get_sorted_walls returns a list of all walls within a range of 5 to a bee, then sorts then by their distance to the bee (closest first)</span><br>
             <br>
            class AI: <br>
            <br>
            &emsp;&emsp;... <span style='color: #666;'># other code goes here, such as __init__ and do_turn</span> <br>
            <br>
            &emsp;&emsp;def is_cell_walled(self, position, distance): <br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># Target and sort functions must have 2 parametes, position then distance</span> <br>
            &emsp;&emsp;&emsp;&emsp;return not self.world.get_tile(position.x, position.y).walkable <span style='color: #666;'># All not walkable tiles are walled</span> <br>
            <br>
            &emsp;&emsp;def sort_walls(self, position, distance): <span style='color: #666;'># Even sort functions must have position then distance</span> <br>
            &emsp;&emsp;&emsp;&emsp;return distance <span style='color: #666;'># The sort algorithim sorts lowest to highest (lowest is index 0)</span> <br>
            <br>
            &emsp;&emsp;def get_sorted_walls(self, bee): <span style='color: #666;'># You need include self as a parameter for all functions in your AI</span> <br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># You don't need to call the parameters of the target and sort functions, <br>
            &emsp;&emsp;&emsp;&emsp;# get_x_in_range does that on its own.</span> <br>
            &emsp;&emsp;&emsp;&emsp;return self.world.get_x_in_range(bee.position, self.is_cell_walled, 5, self.sort_walls) <br>
            </code>

        </div>
        <div class='underline'>

            <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 24px;'><span style='color: white;'>world.breadth_path</span>(<span style='color: white;'>start</span> [Position or Position Array], 
                <span style='color: white;'>max_distance</span> [Int (Optional: Default = Infinity)])</span></p>
                <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 20px; color: white;'>world.breadth_path(start, max_distance=Infinity)</span></p>

            <p> &emsp;&emsp;breadth_path creates a map of all the cardinal directions (N, S, E, W) needed to reach the start(s) in the fastest time. Example: breadth_path was used to create a list of directions to the target (T), and it avoids walls (X).</p>
            <code>
            <span style='color: #666;'>XXX</span>SSSSSSSS <br>
            <span style='color: #666;'>XX</span>EEEEEEESS <br>
            EENEN<span style='color: #666;'>XXX</span>SSS <br>
            <span style='color: #666;'>X</span>EEN<span style='color: #666;'>XX</span>EEE<span style='color: white;'>T</span>W <br>
            <span style='color: #666;'>X</span>NN<span style='color: #666;'>XXXXXXX</span>N <br>
            <span style='color: #666;'>XX</span>ES<span style='color: #666;'>XXXX</span>EEN <br>
            <span style='color: #666;'>XXX</span>EEEEEENN <br>
            <p> &emsp;&emsp;breadth_path will return an object called a <a href="https://www.w3schools.com/python/python_dictionaries.asp">Dictionary</a>. </p>
            
            <code>
            <span style='color: #666;'># move_bee_toward_five sets the action of the given bee to move toward the Position(5,5) using breadth_path</span><br>
            <br>
            class AI: <br>
            <br>
            &emsp;&emsp;... <span style='color: #666;'># other code goes here, such as __init__ and do_turn</span> <br>
            <br>
            &emsp;&emsp;def move_bee_toward_five(self, bee): <span style='color: #666;'># You need include self as a parameter for all functions in your AI</span><br>
            <br>
            &emsp;&emsp;&emsp;&emsp;path = self.world.breadth_path(Position(5,5))<br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># In practice it would be better to store this 'path' in your AI as a self variable, <br>
            &emsp;&emsp;&emsp;&emsp;# because you shouldn't have to run this function every time. Instead you can <br>
            &emsp;&emsp;&emsp;&emsp;# run it once for every time this function is called because the path never changes.</span> <br>
            <br>
            &emsp;&emsp;&emsp;&emsp;bee.action = 'M ' + path[bee.position]<br>
            </code>
            
        </div>
        <div class='underline'>

            <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 24px;'><span style='color: white;'>world.breadth_search</span>(<span style='color: white;'>start</span> [Position], 
                <span style='color: white;'>target_func</span> [Function], 
                <span style='color: white;'>max_distance</span> [Int (Optional: Default = Infinity)],
                <span style='color: white;'>get_all_options</span> [Bool (Optional: Default = False)])</span></p>
                <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 20px; color: white;'>world.breadth_search(start, target_func, max_distance=Infinity, get_all_options=False)</span></p>

            <p> &emsp;&emsp;breadth_search will start at the start position and find the closest tile that meets the target_func criteria. It also moves around walls. 
                breadth_search returns a MovePosition class.</p>

            <p>
                &emsp;&emsp;&emsp;&emsp;&emsp; <span style='color: white; font-size: 24px;'>MovePosition Class</span> <br>
                &emsp;&emsp;&emsp; • world.x [Int] (The x corrdinate of the target tile) <br>
                &emsp;&emsp;&emsp; • world.y [Int] (The y corrdinate of the target tile) <br>
                &emsp;&emsp;&emsp; • world.direction [Int] (The path needed to reach the target, ex. 'SSSEEESESEEEEEEENENNNNNWNWNW') <br>
            <p>

            <p> &emsp;&emsp;If you enable get_all_options then instead of stopping at the first tile that meets the criteria it will return them all.</p>
            
            <code>
            # move_bee_home sets the action of the given bee to move toward the nearest friendly hive<br>
            <br>
            class AI: <br>
            <br>
            &emsp;&emsp;... <span style='color: #666;'># other code goes here, such as __init__ and do_turn</span> <br>
            <br>
            &emsp;&emsp;def is_tile_home(self, position, distance): <br>
            &emsp;&emsp;&emsp;&emsp;tile = self.world.get_tile(position.x, position.y) <br>
            &emsp;&emsp;&emsp;&emsp;return tile.hive and tile.hive_index == self.index <br>
            <br>
            &emsp;&emsp;def move_bee_home(self, bee): <span style='color: #666;'># You need include self as a parameter for all functions in your AI</span><br>
            <br>
            &emsp;&emsp;&emsp;&emsp;path = self.world.breadth_search(bee.position, self.is_tile_home)<br>
            <br>
            &emsp;&emsp;&emsp;&emsp;bee.action = 'M ' + path.direction[0]<br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># Uses the first direction in the list to move</span>
            </code>
            
        </div>
        <div class='underline'>

            <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 24px;'><span style='color: white;'>world.depth_search</span>(<span style='color: white;'>start</span> [Position], 
                <span style='color: white;'>target</span> [Position], 
                <span style='color: white;'>max_distance</span> [Int (Optional: Default = Infinity)])</span></p>
                <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 20px; color: white;'>world.depth_search(start, target, max_distance=5318008)</span></p>

            <p> &emsp;&emsp;depth_search is much MUCH faster than breadth_search, however it requires that you know the exact position of the
             target; because of this it is rarely used.</p>

            <p> &emsp;&emsp;depth_search returns a MovePosition class much like breadth_search.</p>
            
            <code>
            <span style='color: #666;'># move_bee_ten sets the action of the given bee to move toward the position (10,10)</span><br>
            <br>
            class AI: <br>
            <br>
            &emsp;&emsp;... <span style='color: #666;'># other code goes here, such as __init__ and do_turn</span> <br>
            <br>
            &emsp;&emsp;def move_bee_ten(self, bee): <span style='color: #666;'># You need include self as a parameter for all functions in your AI</span><br>
            <br>
            &emsp;&emsp;&emsp;&emsp;path = self.world.depth_search(bee.position, Position(10, 10))<br>
            <br>
            &emsp;&emsp;&emsp;&emsp;bee.action = 'M ' + path.direction[0]<br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># Uses the first direction in the list to move</span> <br>
            </code>
            
        </div>
        <div class='underline'>

            <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 24px;'><span style='color: white;'>world.directed_breadth_search</span>(<span style='color: white;'>start</span> [Position], 
                <span style='color: white;'>wall_func</span> [Function], 
                <span style='color: white;'>target_func</span> [Function], 
                <span style='color: white;'>max_distance</span> [Int (Optional: Default = Infinity)],
                <span style='color: white;'>get_all_options</span> [Bool (Optional: Default = False)])</span></p>
                <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 20px; color: white;'>world.directed_breadth_search(start, wall_func, target_func, max_distance=Infinity, get_all_options=False)</span></p>

            <p> &emsp;&emsp;directed_breadth_search functions incredibly similarly to breadth_search, the only difference is instead of using
                if that tile.walkable to determine if a cell can be walked through, you can use anything else you want. This is helpful if you
                want to avoid bumping into friendly units.</p>

            <code>
            <span style='color: #666;'># move_bee_home_avoid sets the action of the given bee to move toward the nearest friendly hive while avoiding all food</span><br>
            <br>
            class AI: <br>
            <br>
            &emsp;&emsp;... <span style='color: #666;'># other code goes here, such as __init__ and do_turn</span> <br>
            <br>
            &emsp;&emsp;def is_tile_home(self, position, distance): <br>
            &emsp;&emsp;&emsp;&emsp;tile = self.world.get_tile(position.x, position.y) <br>
            &emsp;&emsp;&emsp;&emsp;return tile.hive and tile.hive_index == self.index <br>
            <br>
            &emsp;&emsp;def is_tile_food(self, position, distance): <br>
            &emsp;&emsp;&emsp;&emsp;tile = self.world.get_tile(position.x, position.y) <br>
            &emsp;&emsp;&emsp;&emsp;return not tile.walkable and not.tile.food <br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># Should return true if you should search through it</span> <br>
            <br>
            &emsp;&emsp;def move_bee_home(self, bee): <span style='color: #666;'># You need include self as a parameter for all functions in your AI</span><br>
            <br>
            &emsp;&emsp;&emsp;&emsp;path = self.world.directed_breadth_search(bee.position, self.is_tile_food, self.is_tile_home)<br>
            <br>
            &emsp;&emsp;&emsp;&emsp;bee.action = 'M ' + path.direction[0]<br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># Uses the first direction in the list to move</span>
            </code>
            
        </div>
        <div class='underline'>

            <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 24px;'><span style='color: white;'>world.directed_depth_search</span>(<span style='color: white;'>start</span> [Position], 
                <span style='color: white;'>wall_func</span> [Function], 
                <span style='color: white;'>target</span> [Position], 
                <span style='color: white;'>max_distance</span> [Int (Optional: Default = Infinity)])</span></p>
                <p> &emsp;&emsp;&emsp;&emsp;<span style='font-size: 20px; color: white;'>world.directed_depth_search(start, wall_func, target, max_distance=5318008)</span></p>

            <p> &emsp;&emsp;directed_depth_search also functions in the same way as directed_breadth_search.</p>
            
            <code>
            <span style='color: #666;'># move_bee_ten_avoid sets the action of the given bee to move toward the position (10,10) while avoiding food</span><br>
            <br>
            class AI: <br>
            <br>
            &emsp;&emsp;... <span style='color: #666;'># other code goes here, such as __init__ and do_turn</span> <br>
            <br>
            &emsp;&emsp;def is_tile_food(self, position, distance): <br>
            &emsp;&emsp;&emsp;&emsp;return self.world.get_tile(position.x, position.y).food <br>
            <br>
            &emsp;&emsp;def move_bee_ten(self, bee): <span style='color: #666;'># You need include self as a parameter for all functions in your AI</span><br>
            <br>
            &emsp;&emsp;&emsp;&emsp;path = self.world.directed_depth_search(bee.position, self.is_tile_food, Position(10, 10))<br>
            <br>
            &emsp;&emsp;&emsp;&emsp;bee.action = 'M ' + path.direction[0]<br>
            &emsp;&emsp;&emsp;&emsp;<span style='color: #666;'># Uses the first direction in the list to move</span>
            </code>
            
        </div>
        <div class='underline'>
            <h5>Afterword</h5>

            <p>&emsp;&emsp; There are more functions and built-in classes for you to use, try reading some of the code to find them. <span style='color: white;'>Good Luck!</span></p>
        </div>
    </div>

    <?php include $_SESSION['redir'].'scoreboard.php';?>
</body>