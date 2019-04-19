<?php

    require_once __DIR__.'/init.php';
    require_once __DIR__.'/common.php';
    require_once __DIR__.'/header.php';
    
    echo "<br><span>Welcomme to $appname</span><br/>";
    
    if (isset($_GET['view'])) { 
        $view = $_GET('view');
        $query = "SELECT * FROM categories WHERE name LIKE $view"; 
    } 
    else { 
        $query = "SELECT * FROM categories"; 
    }
    

    $result = createQuery($query);
    if ($result->num_rows)
    {
        for ($i = 0 ; $i < $result->num_rows ; $i++)
        {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $name = $row['name'];
            echo "<table style=\"border:1px solid black;\"><thead><th>$name</th></thead></table><br/>";
        }
    }
    else 
    {
        echo "<p>Nothing to display!</p>";
    }
    
    require_once __DIR__.'/footer.php';