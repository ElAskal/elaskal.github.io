<?php

require_once __DIR__.'/../init.php';
require_once __DIR__.'/../common.php';
require_once __DIR__.'/../header.php';

$error = $mail = $user = $pass = "";
if (isset($_SESSION['user'])) destroySession();
if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br><br>";
        else
        {
            $result = createQuery("SELECT * FROM members WHERE username='$user'");
            if ($result->num_rows)
            {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                if (password_verify($pass, $row['password']))
                {
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    echo "<span><a href='$home_url'>Vous êtes connecté</a></span>";
                }
                else {
                    echo  $row['password'];
                }
            }
        }
}
echo <<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username</span>
    <input type='text' maxlength='16' name='user' value='$user'><br>
    <span class='fieldname'>Password</span>
    <input type='text' maxlength='16' name='pass'
      value='$pass'><br>
_END;
?>

    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Sign up'>
    </form></div><br>
  </body>
</html>

