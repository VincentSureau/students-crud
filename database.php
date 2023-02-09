<?php

try
{
    $db = new PDO('mysql:host=localhost;dbname=students_crud;charset=utf8', 'admin', 'adminpwd');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}