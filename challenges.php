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
            <tr>
                <td <?php if (strpos($solvedChallenges, 'Bin->ASCII') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/crypto/BinToASCII.php'">
                    Bin->ASCII<br><span class='score'>50</span></td> <!-- convert binary to ascii -->
                <td <?php if (strpos($solvedChallenges, 'Fix my Link') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/forensics/Fix my Link.php'">
                    Fix my Link<br><span class='score'>50</span></td> <!-- look at comment of page to fix button -->
                <td <?php if (strpos($solvedChallenges, 'FlagTree') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/reverse/FlagTree.php'">
                    FlagTree<br><span class='score'>50</span></td> <!-- look through python decision tree -->
            </tr>
            <tr>
                <td <?php if (strpos($solvedChallenges, 'b7 String') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/crypto/b7 String.php'">
                    b7 String<br><span class='score'>100</span></td>
                <td <?php if (strpos($solvedChallenges, 'Runner Cube 4') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/forensics/Runner Cube 4.php'">
                    Runner Cube 4<br><span class='score'>100</span></td>
                <td <?php if (strpos($solvedChallenges, 'Secret Deal') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/reverse/Secret Deal.php'">
                    Secret Deal<br><span class='score'>150</span></td>
            </tr>
            <tr>
                <td <?php if (strpos($solvedChallenges, 'RanchCipher') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/crypto/RanchCipher.php'">
                    RanchCipher<br><span class='score'>150</span></td>
                <td <?php if (strpos($solvedChallenges, 'Gallery') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/forensics/Gallery.php'">
                    Gallery<br><span class='score'>100</span></td>
                <td <?php if (strpos($solvedChallenges, 'Literal Reversal') !== false) { echo "class='complete'"; }?>  onclick="location.href='challenges/reverse/Literal Reversal.php'">
                    Literal Reversal<br><span class='score'>250</span></td>
            </tr>
            <tr>
                <td <?php if (strpos($solvedChallenges, 'Color Math') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/crypto/Color Math.php'">
                    Color Math<br><span class='score'>250</span></td>
                <td <?php if (strpos($solvedChallenges, 'My Little Pwnies') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/forensics/My Little Pwnies.php'">
                    My Little Pwnies<br><span class='score'>200</span></td>
                <td <?php if (strpos($solvedChallenges, 'SaltedCracker') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/reverse/SaltedCracker.php'">
                    SaltedCracker<br><span class='score'>300</span></td>
            </tr>
            <tr>
                <td <?php if (strpos($solvedChallenges, 'PwnaLisa') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/crypto/PwnaLisa.php'">
                    PwnaLisa<br><span class='score'>350</span></td>
                <td <?php if (strpos($solvedChallenges, "The 'Ess Que Elle' Needle Shop") !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/forensics/SQLNeedleShop.php'">
                    The 'Ess Que Elle' Needle Shop<br><span class='score'>400</span></td>
                <td <?php if (strpos($solvedChallenges, 'UltraJSVault') !== false) { echo "class='complete'"; }?> onclick="location.href='challenges/reverse/UltraJSVault.php'">
                    UltraJSVault<br><span class='score'>350</span></td>
            </tr>
        </table>
    </div>

    <?php include 'scoreboard.php';?>
</body>