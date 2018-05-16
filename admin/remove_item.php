<?php
    $query="Delete from items";
    $stmt=$conn->prepare($query);
    $stmt->execute();
?>