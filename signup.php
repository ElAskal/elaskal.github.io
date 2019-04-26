<?php

    require_once __DIR__.'/init.php';
    require_once __DIR__.'/common.php';
    require_once __DIR__.'/header.php';
    
    echo "<script type=\"text/javascript\" src=\"/js/signup.js\"> </script>
      <div class='main'><h3>Please enter your details to sign up</h3>";
    
    $error = $mail = $user = $pass = "";
    if (isset($_SESSION['user'])) destroySession();
    if (isset($_POST['user']))
    {
        $mail = sanitizeString($_POST['mail']);
        $user = sanitizeString($_POST['user']);
        $pass = sanitizeString($_POST['pass']);

        if ($user == "" || $pass == "")
            $error = "Not all fields were entered<br><br>";
            else
            {
                $result = createQuery("SELECT * FROM members WHERE username='$user'");
                if ($result->num_rows)
                    $error = "That username already exists<br><br>";
                    else
                    {        
                        $pass = encryptPWD($pass);
                        createQuery("INSERT INTO members VALUES('', '$mail', '$user', '$pass')");
                        die("<h4>Account created</h4>Please Log in.<br><br>");
                    }
            }
    }
    echo <<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Mail</span>
    <input type='text' maxlength='256' name='mail' value='$mail'><br>
    <span class='fieldname'>Username</span>
    <input type='text' maxlength='16' name='user' value='$user'
      onBlur="checkUser(this)"><span id='info'></span><br>
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

