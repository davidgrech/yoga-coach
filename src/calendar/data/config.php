<?php

    $dsn = "mysql:host=dgrech01.lampt.eeecs.qub.ac.uk;dbname=dgrech01";
    $username = "dgrech01";
    $password = "Z7rcMmQGJ4Xj5Bl7";
    
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

?>
