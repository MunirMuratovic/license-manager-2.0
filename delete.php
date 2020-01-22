<?php 

include 'db.php';

$id = (int)$_GET['id']; //cast to int is simple validation

$sql = "DELETE FROM `licenses` WHERE id = '$id'";
$result = $db->query($sql);

if($result){

    header('location: index.php');

};
