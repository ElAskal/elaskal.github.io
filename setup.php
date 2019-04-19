<!DOCTYPE html>
<html>
    <head>
        <title>Setting up database</title>
    </head>
    <body>

        <h3>Setting up...</h3>

<?php
    require_once __DIR__.'/config.php';
    require_once __DIR__.'/init.php';
    require_once __DIR__.'/common.php';
    
    createTable('categories',
        'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(64) NOT NULL,
        description VARCHAR(512)');

?>

        <br>...done.
    </body>
</html>
