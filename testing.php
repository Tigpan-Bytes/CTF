<?php include 'head.php';?>

<?php
    $servername = "localhost";
    $username = "username";
    $password = "password";

    echo $username;
    echo $password;
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Create database
    $sql = "CREATE DATABASE myDB";
    if (mysqli_query($conn, $sql)) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?> 

<body>
	<?php include 'page-title.php';?>

    Welcome <?php echo $_POST["name"]; ?><br>
    Your password is: <?php echo $_POST["password"]; ?>

</body>
