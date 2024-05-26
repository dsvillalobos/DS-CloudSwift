<?php

include "../../connection/connection.php";

if (isset($_GET["file_id"])) {
    $fileId = $_GET["file_id"];

    $query = "SELECT * FROM files_view WHERE FileID = :fileId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":fileId", $fileId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($row["File"])) {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($fileInfo, "data:application/octet-stream;base64," . base64_encode($row["File"]));
        finfo_close($fileInfo);

        header("Content-Description: File Transfer");
        header("Content-Type: " . $mime);
        header("Content-Disposition: attachment; filename=\"" . basename($row["FileName"] . "." . $row["FileType"]) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");
        header("Content-Length: " . strlen($row["File"]));

        echo $row["File"];
        exit();
    }
}
