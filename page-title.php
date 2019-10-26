<div class='page-title'> 
    <span style='float:left'>Capture the Flag: <span style='color:grey'>|</span> <?php echo $_SESSION["titlePath"]; ?></span> 
    <?php
        if (isset($auth) && $auth['success'])
        {
            echo'
            <span style="float:right">
                '.$_SESSION["username"].' - '.$_SESSION["team"].'
            <span style="color:grey"> | </span> 
                <button onclick="location.href=\''.$_SESSION["redir"].'logout.php\'" class="btn">Logout</button>
            </span>';
        }
        else
        {
            echo'
            <span style="float:right">
                <button onclick="location.href=\''.$_SESSION["redir"].'register.php\'" class="btn">Register</button>
                <span style="color:grey"> | </span>
                <button onclick="location.href=\''.$_SESSION["redir"].'login.php\'" class="btn">Login</button>
            </span>';
        }
    ?>
</div>
<div class='page-spacer'></div>