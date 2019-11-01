<?php
	session_start();

    $_SESSION['redir'] = '../../';

	include $_SESSION['redir'].'func.php'; 
    
    $auth = isAuthorised(getSessionVar('username'), getSessionVar('password'));

    if (!$auth['success'])
    {
        header('Location: index.php');
    }
    else
    {
        $flagResult = checkFlag('shawcenter', 'Unhash', 300);
    }

    $_SESSION['titlePath'] = '<button onclick="location.href=\'main.php\'" class="btn">Main</button> > 
    <button onclick="location.href=\''.$_SESSION['redir'].'challenges.php\'" class="btn">Challenges</button> >
    Secret Deal';
?>

<?php include $_SESSION['redir'].'head.php';?>

<body>
    <?php include $_SESSION['redir'].'page-title.php';?>
    
    <div class='challenge-holder'>
        <div class='portion-holder'>
            <div class='underline'>
                <h3 style='text-align:center;'>Unhash</h3>
                <p style='text-align:center;'>Reverse • 300 points</p>
            </div>

            <div class='underline'>
                <p>&emsp;&emsp;"Hey buddy, I need your help, I got the presidents password but its hashed. I got his hashed password
                and the c++ program that was used to encrypt the password.
                 <a href="<?php echo $_SESSION['redir']?>challenge-site/Secret-Deal.py" download>Here</a> is the program, and the hash 
                is 'OBBBDSJHDJHSFJJW'. I know that his password only uses lowercase letters and nothing else, but I don't know the length.
                If I were you I would consider using some brute force to break it." - Unknown.</p>
            </div>

            <!--
                #include <iostream>
#include <string>

using namespace std;

string expandString(string str, int length) 
{
  if (length <= str.size()) 
  {
      return str.substr(0, length);
  }
  
  while (str.size() * 2 <= length) 
  {
    str += str;
  }
  if (str.size() < length) 
  {
    str += str.substr(0, length - str.size());
  }
  return str;
}

int main()
{
    string str ("I like to code in C");
    cout<<ExpandString(str, 100)<<"\n";

    return 0;
}
-->

            <form method="post">
                <input placeholder='Flag' class='flag-input' name='flag'> 
                <input type="submit" class='flag-submit' value='Submit Flag' name='submit'>
            </form>

            <?php
                if ($flagResult == 'success') 
                { 
                    echo "<div class='success'>Flag successful! You earned 150 points for your team!</div>";
                }
                elseif ($flagResult == 'error')
                {
                    echo "<div class='error'>Flag successful but your team has already hacked this challenge.</div>";
                }
                elseif ($flagResult == 'failure') 
                { 
                    echo "<div class='failure'>Flag failed. Try again.</div>";
                } 
            ?>
        </div>
    </div>
</body>