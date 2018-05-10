<?php
include "dbconn.php";
if(!isset($_GET["id"]))
    header("Location:billslist.php");

$stmt = $conn->prepare("Update invoice set status=1 where id=?");
$stmt -> bind_param("i",$_GET["id"]);
$stmt->execute();
header("Location:billslist.php");
