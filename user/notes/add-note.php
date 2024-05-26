<!DOCTYPE html>
<html lang="en-US" translate="no">

<?php

include "../../includes/heads/sub_head.php";

session_start();

if (empty($_SESSION["userId"])) {
    header("Location: ../../index.php");
}

?>

<body class="mb-4">
    <?php include "../../includes/headers/sub_header.php"; ?>

    <div class="content-container col-md-8 mx-auto">
        <main class="container">
            <div class="illustration-container text-center mb-3">
                <img class="mb-3" src="../../public/images/illustrations/add-note.webp" alt="Add Note">
                <h3 class="mb-2">Add Note</h3>
                <p class="text-center small mx-3">Add notes seamlessly to your cloud repository for quick reference and organization.</p>
            </div>
            <div class="mx-3 small d-none" id="errorAlertContainer">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> DS CloudSwift couldn't add the note.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="mx-3 small d-none" id="successAlertContainer">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> The note has been added successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <form method="post" autocomplete="off" class="mx-3">
                <div class="mb-3">
                    <label for="noteTitle" class="form-label">Note Title:</label>
                    <input type="text" name="noteTitle" id="noteTitle" class="form-control" required maxlength="255">
                </div>
                <div class="mb-3">
                    <label for="noteBody" class="form-label">Note Body:</label>
                    <textarea rows="5" name="noteBody" id="noteBody" class="form-control" required></textarea>
                </div>
                <div class="mb-3 d-grid gap-2">
                    <input type="submit" name="addNote" value="Add Note" class="btn btn-primary">
                </div>
            </form>
        </main>
    </div>

    <?php

    include "../../connection/connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addNote"])) {
        try {
            $noteTitle = $_POST["noteTitle"];
            $noteBody = $_POST["noteBody"];
            $userId = $_SESSION["userId"];

            $query = "INSERT INTO notes (NoteTitle, NoteBody, UserID) VALUES (:noteTitle, :noteBody, :userId)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":noteTitle", $noteTitle);
            $stmt->bindParam(":noteBody", $noteBody);
            $stmt->bindParam("userId", $userId);

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