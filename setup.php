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

/*
 createQuery("DROP TABLE categories");
    createQuery("DROP TABLE topics");
    createQuery("DROP TABLE messages");
    createQuery("DROP TABLE members");
    createQuery("DROP TABLE categories_link");
    createQuery("DROP TABLE topics_to_messages");
    createQuery("DROP TABLE category_to_topics"); */
    
    createTable('categories', 
        'id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR (64),
        description VARCHAR(512),
        PRIMARY KEY (id)');
    
    createTable('topics', 
        'id INT UNSIGNED NOT NULL AUTO_INCREMENT, 
        name VARCHAR(64),
        locked BOOLEAN, 
        PRIMARY KEY (id)');
    
    createTable('messages', 
        'id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        date DATETIME,
        content VARCHAR(4096),
        PRIMARY KEY (id)');
    
    createTable('members', 
        'id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        mail VARCHAR(256) NOT NULL, 
        username VARCHAR(32) UNIQUE NOT NULL, 
        password VARCHAR(256) NOT NULL,
        PRIMARY KEY (id)');
    
    createTable('groups', 
         'name VARCHAR(64) NOT NULL, 
         description VARCHAR(256), 
         PRIMARY KEY (name)');
    
    createTable('categories_tree', 
        'parent INT UNSIGNED NOT NULL,
         child INT UNSIGNED NOT NULL,
         FOREIGN KEY (parent) REFERENCES '.$dbname.'.categories(id) ON UPDATE CASCADE,
         FOREIGN KEY (child) REFERENCES '.$dbname.'.categories(id) ON UPDATE CASCADE');
    
    createTable('category_to_topics', 
        'category INT UNSIGNED NOT NULL,
         topic INT UNSIGNED NOT NULL,
         FOREIGN KEY (category) REFERENCES '.$dbname.'.categories(id) ON UPDATE CASCADE,
         FOREIGN KEY (topic) REFERENCES '.$dbname.'.topics(id) ON UPDATE CASCADE');
    
    createTable('topic_to_messages',
        'topic INT UNSIGNED NOT NULL,
         message INT UNSIGNED NOT NULL, 
         author INT UNSIGNED NOT NULL,
         FOREIGN KEY (topic) REFERENCES '.$dbname.'.topics(id) ON UPDATE CASCADE,
         FOREIGN KEY (message) REFERENCES '.$dbname.'.messages(id) ON UPDATE CASCADE,
         FOREIGN KEY (author) REFERENCES '.$dbname. '.members(id)');
    
    createTable('private_messages', 
        'id INT UNSIGNED NOT NULL,
         author INT UNSIGNED NOT NULL, 
         receiver INT UNSIGNED NOT NULL AUTO_INCREMENT,
         FOREIGN KEY (id) REFERENCES '.$dbname. '.messages(id) ON UPDATE CASCADE, 
        FOREIGN KEY (author) REFERENCES '.$dbname. '.members(id) ON UPDATE CASCADE,
        FOREIGN KEY (receiver) REFERENCES '.$dbname. '.members(id) ON UPDATE CASCADE');
    
    createTable('group_membership', 
        'name VARCHAR(64) NOT NULL,
        member INT UNSIGNED NOT NULL, 
        FOREIGN KEY (name) REFERENCES '.$dbname. '.groups(name) ON UPDATE CASCADE,
        FOREIGN KEY (member) REFERENCES '.$dbname. '.members(id) ON UPDATE CASCADE');
?>

        <br>...done.
    </body>
</html>
