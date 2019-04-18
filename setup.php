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
        'name VARCHAR(16) NOT NULL,
        desc VARCHAR(16),
        INDEX(user(6))');

?>

        <br>...done.
    </body>
</html>
