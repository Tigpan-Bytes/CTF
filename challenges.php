<?php
	session_start();

	include 'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));
    
    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > Challenges';
    $solvedChallenges = '';

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

    if ($stmt = mysqli_prepare($conn, "SELECT solved FROM teams WHERE teamname = ? "))
    {
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['team']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) 
        {
            $solvedChallenges = mysqli_fetch_assoc($result)['solved'];
        }
    }
?>

<?php include 'head.php';?>

<body>
    <?php include 'page-title.php';?>
    
    <div class='main-holder'>
        <div class='page-spacer' style='height:50px;'></div>
        <table>
            <tr>
                <th>Crypto</th>
                <th>Forensics</th>
                <th>Reverse</th>
            </tr>
            <tr>  <!-- Must REMOVE ALL COMMENTS LATER -->
                <td <?php if (strpos($solvedChallenges, 'b7 String') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/b7 String.php'">
                    b7 String<br><span class='score'>100</span></td> <!-- base13 num to string -->
                <td <?php if (strpos($solvedChallenges, 'Runner Cube 4') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/Runner Cube 4.php'">
                    Runner Cube 4<br><span class='score'>100</span></td> <!-- look in javascript for secret username code -->
                <td <?php if (strpos($solvedChallenges, 'Secret Deal') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/Secret Deal.php'">
                    Secret Deal<br><span class='score'>150</span></td> <!-- reverse some quick js to find lovers name -->
            </tr>
            <tr>
                <td <?php if (strpos($solvedChallenges, 'RanchCipher') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/RanchCipher.php'">
                    RanchCipher<br><span class='score'>150</span></td> <!-- caesar cypher but every character has a different offset -->
                <td <?php if (strpos($solvedChallenges, 'Gallery') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/Gallery.php'">
                    Gallery<br><span class='score'>100</span></td> <!-- inspect some pngs with notepad to find parts of flag -->
                <td <?php if (strpos($solvedChallenges, 'Literal Reversal') !== false) { echo "class='complete'"; }?>  onclick="location.href='challenges/Literal Reversal.php'">
                    Literal Reversal<br><span class='score'>250</span></td> <!-- python: slightly encrypted flag, that then has substrings of it reversed and moved around -->
            </tr>
            <tr>
                <td <?php if (strpos($solvedChallenges, 'Colour Math') !== false) { echo "class='complete'"; }?>>
                    Colour Math<br><span class='score'>300</span></td> <!-- IRNAM final puzzle with rgb values -->
                <td <?php if (strpos($solvedChallenges, 'My Little Pwnies') !== false) { echo "class='complete'"; }?>>
                    My Little Pwnies<br><span class='score'>200</span></td> <!--4 images where corners line up to create qr code -->
                <td <?php if (strpos($solvedChallenges, 'Unhash') !== false) { echo "class='complete'"; }?>>
                    Unhash<br><span class='score'>300</span></td> <!-- brute force an xor hash with 2 byte salt -->
            </tr>
            <tr>
                <td <?php if (strpos($solvedChallenges, 'PwnaLisa') !== false) { echo "class='complete'"; }?>>
                    PwnaLisa<br><span class='score'>400</span></td>  <!-- stegenography -->
                <td <?php if (strpos($solvedChallenges, "The 'Ess Que Elle' Needle Shop") !== false) { echo "class='complete'"; }?>>
                    The 'Ess Que Elle' Needle Shop<br><span class='score'>450</span></td>  <!-- sql injection to find flag -->
                <td <?php if (strpos($solvedChallenges, 'UltraJSVault') !== false) { echo "class='complete'"; }?>>
                    UltraJSVault<br><span class='score'>400</span></td>  <!--heavily obfuscated javascript to find correct answer JSSafe -->
            </tr>
        </table>
    </div>

    <?php include 'scoreboard.php';?>
</body>