<?php
include "header.php";
if($_GET["id"]){
    $query="Update products set prod_avail=0 where id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$_GET["id"]);
    $stmt->execute();
}
    echo '<script>window.location.href="listproducts.php"</script>';
    header("Location:listproducts.php");
?>