<?php
include "header.php";
if($_GET["id"]){
    $query="delete from items where id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$_GET["id"]);
    $stmt->execute();
}
    echo '<script>window.location.href="listitems.php"</script>';
    header("Location:listitems.php");
?>