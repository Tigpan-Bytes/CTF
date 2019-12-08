<?php
    session_start();

    include 'func.php';

    if(array_key_exists('join-submit', $_POST))
    {
        if (getSessionVar('join-password') == getSessionVar('join-passwordConfirm'))
        {
            if (strlen(getSessionVar('join-username')) <= 16 && strlen(getSessionVar('join-username')) != 0)
            {
                if (goodAscii(getSessionVar('join-username')) === true)
                {
                    if (strlen(getSessionVar('join-password')) >= 4)
                    {
                        $auth = register(getSessionVar('join-username'), getSessionVar('join-password'), getSessionVar('join-team'), false);
                        if (!$auth['success'])
                        {
                            $err = $auth['err'];
                        }
                        else
                        {
                            header('Location: main.php');
                        }   
                    }
                    else
                    {
                        $err = "Your password must be at least 4 characters long";
                    }  
                }
                else
                {
                    $err = "Username invalid. No special characters aside from _ and -";
                }
            }
            else
            {
                $err = "Max 16 characters for usernames.";
            }           
        }
        else
        {
            $err = "Passwords don't match";
        }
    }
    elseif(array_key_exists('create-submit', $_POST))
    {
        if (!file_exists('../../../__bots__')) {
            mkdir('../../../__bots__', 0777, true);
        }

        if (getSessionVar('create-password') == getSessionVar('create-passwordConfirm'))
        {
            if (strlen(getSessionVar('create-username')) <= 16 && strlen(getSessionVar('create-username')) != 0)
            {
                if (strlen(getSessionVar('create-team')) <= 10  && strlen(getSessionVar('create-team')) != 0)
                {
                    if (goodAscii(getSessionVar('create-username')) === true)
                    {
                        if (goodAscii(getSessionVar('create-team')) === true)
                        {
                            if (strlen(getSessionVar('create-password')) >= 4)
                            {
                                $auth = register(getSessionVar('create-username'), getSessionVar('create-password'), getSessionVar('create-team'), true);
                                if (!$auth['success'])
                                {
                                    $err = $auth['err'];
                                }
                                else
                                {
                                    if (!file_exists('../../../__bots__/'.$auth['team'])) {
                                        mkdir('../../../__bots__/'.$auth['team'], 0777, true);
                                    }
                                    header('Location: main.php');
                                }
                            }
                            else
                            {
                                $err = "Your password must be at least 4 characters long";
                            }  
                        }
                        else
                        {
                            $err = "Teamname invalid. No special characters aside from _ and -";
                        }
                    }
                    else
                    {
                        $err = "Username invalid. No special characters aside from _ and -";
                    }
                }
                else
                {
                    $err = "Max 10 characters for team names.";
                } 
            }
            else
            {
                $err = "Max 16 characters for usernames.";
            } 
        }
        else
        {
            $err = "Passwords don't match";
        }
    }

    $_SESSION['titlePath'] = ' Register';
    $_SESSION['redir'] = '';
?>

<?php include 'head.php';?>

<body>
    <?php include 'page-title.php';?>
    
    <?php
        if(isset($err)) 
        { 
            echo "<p style='text-align: center;'>Error: ".$err."</p>";
        } 
    ?>

    <div class='login-box join-team'>
        <form method="post">
            <h3 style='text-align: center; margin-top: 0px; margin-bottom: 16px;'>Register and Join Team</h3>
            Username: <input type="text" name="join-username" class="login-input"><br>
            <br>
            Password: <input type="password" name="join-password" class="login-input"><br>
            Confirm : <input type="password" name="join-passwordConfirm" class="login-input"><br>
            <br>
            Join Team: <input type="text" name="join-team" class="login-input"><br>
            <input type="submit" name='join-submit' class="login-submit" value="Register - Join Team">
        </form>
    </div>

    <div class='login-box create-team'>
        <form method="post">
        <h3 style='text-align: center; margin-top: 0px; margin-bottom: 16px;'>Register and Create Team</h3>
            Username: <input type="text" name="create-username" class="login-input"><br>
            <br>
            Password: <input type="password" name="create-password" class="login-input"><br>
            Confirm : <input type="password" name="create-passwordConfirm" class="login-input">  <br>
            <br>
            Create Team: <input type="text" name="create-team" class="login-input"><br>
            <input type="submit" name='create-submit' class="login-submit" value="Register - Create Team">
        </form>
    </div>
    <p style='text-align: center;'>Max 16 characters for usernames.<br>Max 10 characters for team names.</p>
</body>
