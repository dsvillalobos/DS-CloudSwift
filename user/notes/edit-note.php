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

    <?php

    include "../../connection/connection.php";

    if (isset($_GET["note_id"])) {
        $noteId = $_GET["note_id"];
        $query = "SELECT * FROM notes WHERE NoteID = :noteId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":noteId", $noteId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    ?>

    <div class="content-container col-md-8 mx-auto">
        <main class="container">
            <div class="illustration-container text-center mb-3">
                <img class="mb-3" src="../../public/images/illustrations/edit-note.webp" alt="Edit Note">
                <h3 class="mb-2">Edit Note</h3>
                <p class="text-center small mx-3">Edit your notes effortlessly to keep your thoughts organized and refined.</p>
            </div>
            <div class="mx-3 small d-none" id="errorAlertContainer">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> DS CloudSwift couldn't edit the note.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="mx-3 small d-none" id="successAlertContainer">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> The note has been edited successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <form method="post" autocomplete="off" class="mx-3">
                <div class="mb-3">
                    <label for="noteTitle" class="form-label">Note Title:</label>
                    <input type="text" name="noteTitle" id="noteTitle" class="form-control" required maxlength="255" value="<?php echo isset($_POST['noteTitle']) ? htmlspecialchars($_POST['noteTitle']) : $row['NoteTitle']; ?>">
                </div>
                <div class="mb-3">
                    <label for="noteBody" class="form-label">Note Body:</label>
                    <textarea rows="5" name="noteBody" id="noteBody" class="form-control" required><?php echo isset($_POST['noteBody']) ? htmlspecialchars($_POST['noteBody']) : $row['NoteBody']; ?></textarea>
                </div>
                <div class="mb-3 d-grid gap-2">
                    <input type="submit" name="editNote" value="Edit Note" class="btn btn-primary">
                </div>
            </form>
        </main>
    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editNote"])) {
        try {
            $noteTitle = $_POST["noteTitle"];
            $noteBody = $_POST["noteBody"];
            $userId = $_SESSION["userId"];

            $query = "UPDATE notes SET NoteTitle = :noteTitle, NoteBody = :noteBody WHERE NoteID = :noteId";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":noteTitle", $noteTitle);
            $stmt->bindParam(":noteBody", $noteBody);
            $stmt->bindParam(":noteId", $noteId);

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