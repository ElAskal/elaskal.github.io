<?php

    require_once __DIR__.'/init.php';
    require_once __DIR__.'/common.php';
    require_once __DIR__.'/header.php';
    
    function display3rdCategories($categories) {
        echo "<br/>";
        for ($h = 0 ; $h < $categories->num_rows ; $h++) {
            $newRow = $categories->fetch_array(MYSQLI_ASSOC);
            echo "<li><a href=\"?view=".$newRow['id']."\">".$newRow['name']."</a></li>";
        }
    }
    
    function display2ndCategories($categories) {
        for ($j = 0 ; $j < $categories->num_rows ; $j++) {
            $thisRow = $categories->fetch_array(MYSQLI_ASSOC);
            echo "<tr><td>Image</td><td class='catDesc'><a href=\"?view=".$thisRow['id']."\">".$thisRow['name']."</a><br/>".$thisRow['description'];
            $query = "SELECT * FROM ".$GLOBALS['tableCat']." WHERE id IN (SELECT child FROM ".$GLOBALS['tableCatToCat']." WHERE parent = ".$thisRow['id'].")";
            $result3rd = createQuery($query);
            if ($result3rd->num_rows) {
                display3rdCategories($result3rd);
            }   
            echo "</td><td>Dernier message</td></tr>";
        }
    }
    
    function display1stCategories($categories) {
        
        // Add 1st level categories in table 
        for ($i = 0 ; $i < $categories->num_rows ; $i++) {
            // Creates tables for each 1st level categories
            $row = $categories->fetch_array(MYSQLI_ASSOC);
            $name = $row['name'];
            echo "<table class='categories'>
                    <th colspan=\"3\">
                        <a href=\"?view=".$row['id']."\">$name</a>
                    </th>";
            
            // Gets 2nd level categories and add them in a table
            $query = "SELECT * FROM ".$GLOBALS['tableCat']." WHERE id IN (SELECT child FROM ".$GLOBALS['tableCatToCat']." WHERE parent = ".$row['id'].")";
            $result2nd = createQuery($query);
            if ($result2nd->num_rows) {
            display2ndCategories($result2nd);                
            }
            echo "<br/>";
         }
         echo "</table><br/>";
    }
    
    function getAuthorId($topic) {
        $query = "SELECT * FROM " .$GLOBALS['tableMemb']. " WHERE id IN (SELECT author FROM ".$GLOBALS['tableTopToMess']. " WHERE topic = " .$topic. ")";
        $result =  createQuery($query);
        if ($result->num_rows)
        {
            $tab = $result->fetch_array(MYSQLI_ASSOC);
            $author_id = $tab['id'];
            $author_name = $tab['username'];
            return "<a href='" .$GLOBALS['home_url']. "profile.php?user=" .$author_id. "'>" .$author_name. "</a>";
        }
        else {
            return "Invité";
        }
    }
    
    function displayTopics($topics){
        
        echo "<table class='topics'>
                <th></th>
                <th>Titre du sujet</th>
                <th>Auteur</th>
                <th>Dernier message</th>";
        // Max number of topics per page
        $limit = 2;
        if (isset($_GET['page'])) {
            $page = $_GET['page'] - 1; 
        } 
        else {
            $page = 0;
        }
        $start = $page * $limit;
        $rows = $topics->fetch_row();
        for ($i = $start ; $i < $topics->num_rows && $i < ($start + $limit) ; $i++) {
            $topics = $topics->fetch_row($i);
            $tab = $topics->fetch_array(MYSQLI_ASSOC);
            echo "<tr><td>Nouveau message</td>
                        <td class='topTitle'>" .$tab['name']. "</td>
                        <td>" .getAuthorId($tab['id']) ."</td>
                        <td>Last message</td></tr>";
        }
        echo "</table><br>";
    }
    
    echo "<br><span>Welcomme to ".$GLOBALS['appname']."</span><br/>";
    
    $query = "SELECT * FROM ".$GLOBALS['tableCat']." WHERE id ";
    if (isset($_GET['view'])) { 
        $view = sanitizeString($_GET['view']);
        $query = $query."= $view"; 
    }     
    else {
        $query = $query."NOT IN (SELECT child FROM ".$GLOBALS['tableCatToCat'].")";
    }

    $result = createQuery($query);
    if ($result->num_rows)
    {
        display1stCategories($result);
    }
    else
    {
        echo "<p>Nothing to display!</p>";
    }
    if (isset($_GET['view']))
    {
        $view = $_GET['view'];
        $query = "SELECT * FROM " .$GLOBALS['tableTop']." WHERE id IN (SELECT topic FROM " .$GLOBALS['tableCatToTop'] ." WHERE category = " .$view .")";
        $result = createQuery($query);
        if ($result->num_rows)
        {
            displayTopics($result);
        }
    }
    
    require_once __DIR__.'/footer.php';