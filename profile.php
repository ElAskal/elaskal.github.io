<?php
    
    require_once __DIR__.'/init.php';
    require_once __DIR__.'/common.php';
    require_once __DIR__.'/header.php';
    
    if (isset($_GET['user'])) {
        $memberID = $_GET['user'];
        $query = "SELECT * FROM members WHERE id = " .$memberID;
        $result = createQuery($query);
        $tab = $result->fetch_array(MYSQLI_ASSOC);
        echo "<table class=\"profil\"><th colspan=\"2\">" .$tab['username']. "</th>
                <tr><td class=\"profilAvatar\"><img src=\"avatars/" .$tab['username']. ".jpg\" alt=\"\" /></td>
                <td><ul><li>Mail : " .$tab['mail']. "</li></ul></table>";
    }
    else {
        echo "ERROR";
    }