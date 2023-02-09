<?php

require_once "database.php";

$id = $_GET["id"] ?? null;

if(!empty($id)) {
    $sql = "DELETE FROM `students` WHERE `students`.`id` = $id;";
        
    $studentStatement = $db->prepare($sql);
    $studentStatement->execute();
}

header('Location: index.php');
exit;