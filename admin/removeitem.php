<?php
include "header.php";
if($_GET["id"]){
    $query="Delete from items where id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$_GET["id"]);
    if($stmt->execute())
        header("Location:listitems.php");

}
?>