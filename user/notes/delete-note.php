<?php

include "../../connection/connection.php";

if (isset($_GET["note_id"])) {
    $noteId = $_GET["note_id"];

    $query = "DELETE FROM notes WHERE NoteID = :noteId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":noteId", $noteId);
    $stmt->execute();
    header("Location: ./notes.php");
    exit();
}
