<?php include 'head.php';?>

<?php
    $servername = "localhost";
    $username = "admin";
    $password = "pleaseNoHacking123";
    $dbname = 'test';

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    $numrows = mysqli_num_rows($result);

    if ($numrows > 0) {
        echo "There are ".$numrows." rows.<br>";
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    /*
    There are 4 rows.
    id: 0 - Name: Obama Care
    id: 1 - Name: Tigpan McCool
    id: 2 - Name: Abar NineEleven
    id: 3 - Name: Anurag Kishore
    */
    
    mysqli_close($conn);
?> 

<body>
	<?php include 'page-title.php';?>

    Welcome <?php echo $_POST["name"]; ?><br>
    Your password is: <?php echo $_POST["password"]; ?>

</body>
