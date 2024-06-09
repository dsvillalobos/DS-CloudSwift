<!DOCTYPE html>
<html lang="en-US" translate="no">

<?php

session_start();

include "../../includes/heads/sub_head.php";

if (empty($_SESSION["userId"])) {
    header("Location: ../../index.php");
}

?>

<body class="mb-4">
    <?php include "../../includes/headers/sub_header.php"; ?>

    <div class="content-container col-md-8 mx-auto">
        <main class="container">
            <div class="illustration-container text-center mb-3">
                <img class="mb-3" src="../../public/images/illustrations/add-file.webp" alt="Add File">
                <h3 class="mb-2">Add File</h3>
                <p class="text-center small mx-3">Easily upload and organize your files hassle-free. Add files to your cloud with a breeze!</p>
            </div>
            <div class="mx-3 small d-none" id="errorAlertContainer">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> DS CloudSwift couldn't add the file.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="mx-3 small d-none" id="successAlertContainer">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> The file has been added successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <form method="post" autocomplete="off" class="mx-3" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fileName" class="form-label">File Name:</label>
                    <input type="text" name="fileName" id="fileName" class="form-control" required maxlength="255">
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File:</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <div class="mb-3 d-grid gap-2">
                    <input type="submit" name="addFile" value="Add File" class="btn btn-primary">
                </div>
            </form>
        </main>
    </div>

    <?php

    include "../../connection/connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addFile"]) && isset($_FILES["file"])) {
        try {
            $fileName = $_POST["fileName"];
            $fileTmpName = $_FILES["file"]["tmp_name"];
            $file = file_get_contents($fileTmpName);
            $fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $userId = $_SESSION["userId"];

            $query = "INSERT INTO files (FileName, File, FileType, UserID) VALUES (:fileName, :file, :fileType, :userId)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":fileName", $fileName);
            $stmt->bindParam(":file", $file, PDO::PARAM_LOB);
            $stmt->bindParam("fileType", $fileType);
            $stmt->bindParam(":userId", $userId);

            if ($stmt->execute()) {
                echo "<script>
                    const successAlertContainer = document.getElementById('successAlertContainer');
                    successAlertContainer.classList.remove('d-none');
                </script>";
            } else {
                echo "<script>
                    const errorAlertContainer = document.getElementById('errorAlertContainer');
                    errorAlertContainer.classList.remove('d-none');
                </script>";
            }
        } catch (Exception $err) {
            echo "<script>
                const errorAlertContainer = document.getElementById('errorAlertContainer');
                errorAlertContainer.classList.remove('d-none');
            </script>";
        }
    }

    ?>

</body>

</html>