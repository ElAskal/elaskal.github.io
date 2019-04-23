<?php
    require_once __DIR__.'/init.php';
    require_once __DIR__.'/common.php';

    if (isset($_POST['user'])) {
        $user = sanitizeString($_POST['user']);
        $result = createQuery("SELECT * FROM members WHERE username='$user'");

        if ($result->num_rows) {
            echo  "<span class='taken'>&nbsp;&#x2718; ".
                        'This username is taken</span>';
        } else {
            echo "<span class='available'>&nbsp;&#x2714; ".
                      'This username is available</span>';
        }
    }
