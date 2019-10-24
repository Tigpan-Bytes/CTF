<?php
    function getSessionVar($key)
    {
        if (isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        if (isset($_POST[$key]))
        {
            return $_POST[$key];
        }
        return '';
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
                    }

                    $returnable = ['success'=>TRUE, 'err'=>""];
                }
                else
                {
                    $returnable = ['success'=>FALSE, 'err'=>"Invalid Login."];
                }
            } 
            else
            {
                $returnable = ['success'=>FALSE, 'err'=>"That username doesn't exist."];
            }
        }
        else
        {        
            $returnable = ['success'=>FALSE, 'err'=>"Something went wrong, oops?."];
        }

        mysqli_close($conn);
        return $returnable;
    }

    /*
        sql format:

        db: ctf - utf8_unicode_ci
        table: users - 4 cols (id[int], username[varchar(32)], pwhash[varchar(128)], team[varchar(16)])

        0 - Tigpan  - password      - h3x0r
        1 - Abar    - nineEleven    - h3x0r
        2 - Tyrone  - arma4         - more1337
        3 - Anurag  - berlin        - more1337
    */
?>