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

    createTable('groups',
        'id INT PRIMARY KEY NOT SIGNED AUTO INCREMENT NOT NULL,
        name VARCHAR(32) NOT NULL,
        desc VARCHAR(512),
        staff BOOLEAN NOT NULL');
    
    createTable('categories',
        'id INT NOT SIGNED AUTO INCREMENT NOT NULL,
        name VARCHAR(64) NOT NULL,
        desc VARCHAR(512)');

?>

        <br>...done.
    </body>
</html>
