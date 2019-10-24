<span class='page-title'> 
    <span style='float:left'>Capture the Flag: <span style='color:grey'>|</span> Jeopardy > Crypto</span> 
    <?php
        if (isset($auth) && $auth['success'])
        {
            echo'
            <span style="float:right">
                '.$_SESSION["username"].'
            <span style="color:grey"> | </span> 
                <button onclick="redir();" class="btn">Logout</button>
            </span>

            <script type="text/javascript">
            function redir() {
                window.location = "./logout.php";
              }
            </script>';
            
        }
        else
        {
            echo'
            <span style="float:right">
                <button onclick="location.href="logout.php"" class="btn">Login</button>
            </span>';
        }
    ?>
</span>
<div class='page-spacer'></div>