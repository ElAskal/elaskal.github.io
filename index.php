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
    
    require_once __DIR__.'/footer.php';