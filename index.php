<?php
    require '_app/config.php';
    
    $userEmail = 'lucasss@gmail.com';

    $Delete = new Delete;
    $Delete->getDelete('usuarios',"WHERE user_email=:email", "email={$userEmail}");
    echo '<pre>';
    print_r($Delete);