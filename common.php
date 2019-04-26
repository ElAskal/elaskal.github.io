<?php

function createTable($name, $query)
{
    echo "CREATE TABLE $name($query) CHARSET utf8<br>";
}

function createQuery($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result)
    {
        die($connection->error);
    }
    return $result;
}


function destroySession()
{
    $_SESSION = array();
    
    if (session_id() != '' || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 2592000, '/');
    }
    session_destroy();

}

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    
    return $connection->real_escape_string($var);
}

function encryptPWD($password) 
{
    $password = password_hash($password, PASSWORD_BCRYPT);
    return $password;
}