<?php
	session_start();

	include 'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));
    
    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > Challenges';
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
                <td onclick="location.href='challenges/b7 String.php'">b7 String<br><span class='score'>100</span></td> <!-- base13 num to string -->
                <td class='complete'>Runner Man Dude Guy<br><span class='score'>50</span></td> <!-- look in javascript for secret username code -->
                <td>Secret Admirer<br><span class='score'>150</span></td> <!-- reverse some quick js to find lovers name -->
            </tr>
            <tr>
                <td>RanchCipher<br><span class='score'>150</span></td> <!-- caesar cypher but every character has a different offset -->
                <td>Gallery<br><span class='score'>100</span></td> <!-- inspect some pngs with notepad to find flag -->
                <td class='complete'>Literal Reversal<br><span class='score'>200</span></td> <!-- python: slightly encrypted flag, that then has substrings of it reversed and moved around -->
            </tr>
            <tr>
                <td class='complete'>2B^!2B ?<br><span class='score'>100</span></td> <!-- To Be xor not to be -->
                <td>My Little Pwnies<br><span class='score'>200</span></td> <!--4 images where corners line up to create qr code -->
                <td class='complete'>Unhash<br><span class='score'>250</span></td> <!-- brute force an xor hash with 2 byte salt -->
            </tr>
            <tr>
                <td>PwnaLisa<br><span class='score'>450</span></td>  <!-- stegenography -->
                <td>The 'Ess Que Elle' Needle Shop<br><span class='score'>450</span></td>  <!-- sql injection to find flag -->
                <td>UltraJSVault<br><span class='score'>400</span></td>  <!--heavily obfuscated javascript to find correct answer JSSafe -->
            </tr>
        </table>
    </div>

    <?php include 'scoreboard.php';?>
</body>