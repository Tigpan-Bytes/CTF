<div class='page-title'> 
    <span style='float:left'>Capture the Flag: <span style='color:grey'>|</span> <?php echo $_SESSION["titlePath"]; ?></span> 
    <?php
        if (isset($auth) && $auth['success'])
        {
            echo'
            <span style="float:right">
                '.$_SESSION["username"].'
            <span style="color:grey"> | </span> 
                <button onclick="location.href=\'logout.php\'" class="btn">Logout</button>
            </span>';
        }
        else
        {
            echo'
            <span style="float:right">
                <button onclick="location.href=\'login.php\'" class="btn">Login</button>
            </span>';
        }
    ?>
</div>
<div class='page-spacer'></div>