<?php
    function getSessionVar($key)
    {
        if (isset($_POST[$key]))
        {
            return $_POST[$key];
        }
        if (isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        return '';
    }

    function register($un, $pw, $team, $createTeam)
    {
        $un = trim($un);
        $pw = trim($pw);
        $team = trim($team);

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

        if (empty($un) || empty($pw))
        {
            $returnable = ['success'=>FALSE, 'err'=>"Please enter a valid username and password."];
        }
        elseif ($createTeam)
        {
            $pw_param = password_hash($pw, PASSWORD_BCRYPT);
            $stmt = mysqli_prepare($conn, "
            INSERT INTO teams (teamname, members, score, solved) 
            SELECT * FROM (SELECT ? as 'teamname', ? as 'members', 0 as 'score', '' as 'solved') AS tmp
            WHERE NOT EXISTS (
                SELECT teamname FROM teams WHERE teamname=?
            ) AND NOT EXISTS (
                SELECT username FROM users WHERE username=?
            )LIMIT 1");

            $team_un = $un.',';
            mysqli_stmt_bind_param($stmt, "ssss", $team, $team_un, $team, $un);
            mysqli_stmt_execute($stmt);

            if (mysqli_affected_rows($conn) != 0) 
            {
                $stmt = mysqli_prepare($conn, "
                INSERT INTO users (username, pwhash, team) VALUES (?, ?, ?)
                ");

                mysqli_stmt_bind_param($stmt, "sss", $un, $pw_param, $team);
                mysqli_stmt_execute($stmt);

                $_SESSION["username"] = $un;
                $_SESSION["password"] = $pw;
                $_SESSION["team"] = $team;

                $returnable = ['success'=>TRUE, 'err'=>"", 'team'=>$team];
            } 
            else
            {
                $returnable = ['success'=>FALSE, 'err'=>"Invalid Register. Either username is taken, or teamname is taken exist.", 'team'=>FALSE];
            }
        }
        elseif (!$createTeam)
        {
            $pw_param = password_hash($pw, PASSWORD_BCRYPT);
            $stmt = mysqli_prepare($conn, "
            INSERT INTO users (username, pwhash, team) 
            SELECT * FROM (SELECT ? as 'username', ? as 'pwhash', ? as 'team') AS tmp
            WHERE NOT EXISTS (
                SELECT username FROM users WHERE username=?
            ) AND EXISTS (
                SELECT teamname FROM teams WHERE teamname=?
            ) LIMIT 1");

            mysqli_stmt_bind_param($stmt, "sssss", $un, $pw_param, $team, $un, $team);
            mysqli_stmt_execute($stmt);

            if (mysqli_affected_rows($conn) != 0) 
            {
                $_SESSION["username"] = $un;
                $_SESSION["password"] = $pw;
                $_SESSION["team"] = $team;

                $stmt = mysqli_prepare($conn, "UPDATE teams SET members = concat(members, concat(?, ',')) WHERE (teamname = ?)");
                mysqli_stmt_bind_param($stmt, "ss", $un, $team);
                mysqli_stmt_execute($stmt);

                $returnable = ['success'=>TRUE, 'err'=>"", 'team'=>$team];
            } 
            else
            {
                $returnable = ['success'=>FALSE, 'err'=>"Invalid Register. Either username is taken, or team doesn't exist.", 'team'=>FALSE];
            }
        }
        else
        {        
            $returnable = ['success'=>FALSE, 'err'=>"Something went wrong, oops?.", 'team'=>FALSE];
        }

        mysqli_close($conn);
        return $returnable;
    }

    function goodAscii($string)
    {
        for ($i = 0; $i < strlen($string); $i++)
        {
            $val = ord($string[$i]);

            if ($val == 45 || $val == 95) // exceptions for hyphen and undersocre
            {
                continue;
            }
            if ($val < 48 || ($val > 57 && $val < 65) || ($val > 90 && $val < 97) || $val > 122)
            {
                return false;
            }
        }
        return true;
    }

    function isAuthorised($un, $pw, $setsession = FALSE)
    {
        $un = trim($un);
        $pw = trim($pw);

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

        if (empty($un) || empty($pw))
        {
            $returnable = ['success'=>FALSE, 'err'=>"Please enter a valid username and password."];
        }
        elseif ($stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? "))
        {
            //prepared statements protect against sql injections
            $un_param = trim($un);

            mysqli_stmt_bind_param($stmt, "s", $un_param);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) 
            {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($pw, $row['pwhash']))
                {
                    if ($setsession)
                    {
                        $_SESSION["username"] = $un;
                        $_SESSION["password"] = $pw;
                        $_SESSION["team"] = $row['team'];
                    }

                    $returnable = ['success'=>TRUE, 'err'=>"", 'team'=>$row['team']];
                }
                else
                {
                    $returnable = ['success'=>FALSE, 'err'=>"Invalid Login.", 'team'=>FALSE];
                }
            } 
            else
            {
                $returnable = ['success'=>FALSE, 'err'=>"That username doesn't exist.", 'team'=>FALSE];
            }
        }
        else
        {        
            $returnable = ['success'=>FALSE, 'err'=>"Something went wrong, oops?.", 'team'=>FALSE];
        }

        mysqli_close($conn);
        return $returnable;
    }

    function isAdminAuth($un, $pw)
    {
        $un = trim($un);
        $pw = trim($pw);

        if ($un == 'sudoAdmin' && $pw == 'pleaseNoHacking123')
        {
            $_SESSION["username"] = $un;
            $_SESSION["password"] = $pw;
            return true;
        }
        return false;
    }

    function checkFlag($flag, $chname, $points)
    {
        if(array_key_exists('submit', $_POST))
        {
            if ($_POST['flag'] == $flag)
            {
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

                $likechname = '%'.$chname.'%';

                $stmt = mysqli_prepare($conn, "UPDATE teams SET score = score + ? WHERE (teamname = ? AND solved NOT LIKE ?)");
                mysqli_stmt_bind_param($stmt, 'iss', $points, $_SESSION['team'], $likechname);
                
                if (mysqli_stmt_execute($stmt))
                {
                    if (mysqli_affected_rows($conn) == 1)
                    {
                        $stmt = mysqli_prepare($conn, "UPDATE teams SET solved = concat(solved, concat(?, ',')) WHERE (teamname = ? AND solved NOT LIKE ?)");
                        mysqli_stmt_bind_param($stmt, 'sss', $chname, $_SESSION['team'], $likechname);

                        if (mysqli_stmt_execute($stmt))
                        {
                            mysqli_close($conn);
                            return 'success';
                        }
                    }
                }

                mysqli_close($conn);
                return 'error';
            }
            mysqli_close($conn);
            return 'failure';
        }

        return 'null';
    }

    /*
        sql format:

        db: ctf - utf8_unicode_ci
        table: users - 3 cols (username[varchar(32)], pwhash[varchar(128)], team[varchar(16)])

        Tigpan  - password      - h3x0r
        Abar    - nineEleven    - h3x0r
        Tyrone  - arma4         - more1337
        Anurag  - berlin        - more1337

        table: teams - 4 cols (teamname[varchar(10)], members[text], score[int(11)], solved[text], bsb1[TINY INT], bsb2[TINY INT], bsb3[TINY INT])

        h3x0r       - Tigpan,Abar,Kurtz     - 3400  - b7 String,Runner Cube 4,Secret Deal, - 0 - 0 - 0
        more1337    - Tyrone,Anurag,Obama   - 400   - b7 String, - 0 - 0 - 0


        db: needle - utf8_unicode_ci
        table: users - 3 cols (username[text], password[text], role[text])
        John 	harper 	member
        David 	monkey 	member
        Andrew 	dogs 	member
        Daniel 	nohack 	admin
        Zane 	mars 	member
        Mary 	trees 	member
        Carol 	password 	member

        table: products - 3 cols (name[text], price[decimal(10,2)], quantity[int])
        3" Needle 	1.99 	28
        3' Needle 	29.99 	2
        A Gun 	799.99 	2
        Bag o' Needles 	199.99 	6
        Dull Needle 	0.01 	198
        Embroidery 	2.49 	146
        Knitting Needles 	6.99 	54
        Sharp Needle 	9.99 	3
        Steel Needle 	3.89 	28
        Universal 	1.99 	102
        Used Needles 	0.00 	8
        Wooden Needle 	3.89 	19
    */

    /* check list for CTF setup:
        1: make users db
        2: make teams db
        3: make users db [needle]
        4: make products db [needle]
        5: upload bsb ghub
    */
?>