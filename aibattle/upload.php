<?php
    session_start();
    
    $_SESSION['redir'] = '../';

	include $_SESSION['redir'].'func.php';
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\''.$_SESSION['redir'].'main.php\'" class="btn">Main</button> >
    <button onclick="location.href=\'aibattle.php\'" class="btn">AI Battle</button> >
    Upload';

    $targetDir = "../../../__bots__/".$auth['team']."/";

    $message = 0;
    $files = glob($targetDir.'*'); // get all file names

    if(isset($_POST["submit_bot"]))
    {
        $targetFile = $targetDir.basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $fileType = $_FILES['fileToUpload']['type'];

        if($fileType === 'text/plain') 
        {
            foreach($files as $file)
            { // iterate files
                if(is_file($file))
                {
                    unlink($file); // delete file
                }
            }
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) 
            {
                $message = 1;
            } 
            else 
            {
                $message = 2;
            }
        } 
        else 
        {
            $message = 3;
            $uploadOk = 0;
        }
    }
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>

    <?php include $_SESSION['redir'].'scoreboard.php';?>
    
    <div class='login-box login'>
        <form method="post" enctype="multipart/form-data">
            Select AI to upload (your_bot.py):<br>
            <input type="file" class="login-submit" style='width: 320px; padding-left: 2px; padding-top: 2px; height: 34px; text-align: left;' name="fileToUpload" id="fileToUpload"><br>
            <input type="submit" value="Upload AI" class="login-submit" name="submit_bot">
        </form>
    </div>

    <?php
        $did = TRUE;
        foreach($files as $file)
        { // iterate files
            if(is_file($file))
            {
                echo "<p style='text-align: center;'>Current AI: ".basename($file).".</p>";
                $did = FALSE;
            }
        }

        if ($message == 1)
        {
            if ($did)
            {
                echo "<p style='text-align: center;'>Current AI: ".basename( $_FILES["fileToUpload"]["name"]).".</p>";
            }
            echo "<div class='success'>The file ".basename( $_FILES["fileToUpload"]["name"])." has been uploaded.</div>";
        }
        elseif ($message == 2) 
        { 
            echo "<div class='failure'>Sorry, there was an error uploading your file. Please try again as your previous bot has been removed.</div>";
        } 
        elseif ($message == 3) 
        { 
            echo "<div class='failure'>File is not a .py.</div>";
        } 
    ?>
</body>