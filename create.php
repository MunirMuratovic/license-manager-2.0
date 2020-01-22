<?php

include 'db.php';

    if(isset($_POST['send'])) {
        $name = htmlspecialchars($_POST['name']); //htmlspecchars as simple validator
        $type = htmlspecialchars($_POST['type']);
        $period = htmlspecialchars($_POST['period']);
        $creator = htmlspecialchars($_POST['creator']);

        $sql = "INSERT INTO `licenses` (`id`, `name`, `type`, `period`, `creator`)
        VALUES (NULL, '$name', '$type', '$period', '$creator');";

        $rows = $db->query($sql);

        if($rows) {
            header('location: index.php');
        }
    }
