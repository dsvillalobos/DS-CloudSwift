<?php

include "../../connection/connection.php";

if (isset($_GET["file_id"])) {
    $fileId = $_GET["file_id"];

    $query = "DELETE FROM files WHERE FileID = :fileId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":fileId", $fileId);
    $stmt->execute();
    header("Location: ./files.php");
    exit();
}
