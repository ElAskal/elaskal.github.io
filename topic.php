<?php

    require_once __DIR__.'/init.php';
    require_once __DIR__.'/common.php';
    require_once __DIR__.'/header.php';

    function displayMessages($messages)
    {
        $limit = $GLOBALS['messagesPerPage'];
        if (isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        else
        {
            $page = 1;
        }
        $start = ($page - 1) * $limit;
        $messages->data_seek($start);
        for ($i = 0; $i < $limit && $i < $messages->num_rows ; $i++)
        {
            $row = $messages->fetch_array(MYSQLI_ASSOC);
            $query = "SELECT username FROM " .$GLOBALS['tableMemb']. " WHERE id IN 
                        (SELECT author FROM " .$GLOBALS['tableTopToMess']. " WHERE message = " .$row['id']. ")";
            $result = createQuery($query);
            $tab = $result->fetch_array(MYSQLI_ASSOC);
            $username = $tab['username'];
            echo "<tr><td class=\"author\">" .$username. "<br><img src=\"" .__DIR__. "/avatar/" .$username. ".jpg\" alt=\"\" /></td>
                  <td>" .$row['content']. "</td></tr><tr><td></td><td></td></tr>";
        }
    }
    
    if (isset($_GET['view']))
    {
        $topic = $_GET['view'];
        $query = "SELECT * FROM " .$GLOBALS['tableTop']. " WHERE id = " .$topic;
        $result = createQuery($query);
        $tab = $result->fetch_array(MYSQLI_ASSOC);
        echo "<table class=\"topicview\"><th colspan=\"2\">" .$tab['name']. "</th>";
        $query = "SELECT * FROM " .$GLOBALS['tableMess']. " WHERE id IN 
                    (SELECT message FROM ".$GLOBALS['tableTopToMess']. " WHERE topic = " .$topic. ")";
        $messages = createQuery($query);
        displayMessages($messages);
        echo "</table>";
    }
    else {
        echo "ERREUR";
    }