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
                <img class="mb-3" src="../../public/images/illustrations/add-link.webp" alt="Add Link">
                <h3 class="mb-2">Add Link</h3>
                <p class="text-center small mx-3">Add links effortlessly to your collection for easy access anytime, anywhere.</p>
            </div>
            <div class="mx-3 small d-none" id="errorAlertContainer">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> DS CloudSwift couldn't add the link.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="mx-3 small d-none" id="successAlertContainer">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> The link has been added successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <form method="post" autocomplete="off" class="mx-3">
                <div class="mb-3">
                    <label for="linkTitle" class="form-label">Link Title:</label>
                    <input type="text" name="linkTitle" id="linkTitle" class="form-control" required maxlength="255">
                </div>
                <div class="mb-3">
                    <label for="linkAddress" class="form-label">Link Address:</label>
                    <input type="text" name="linkAddress" id="linkAddress" class="form-control" required pattern="https?://.+" title="Please enter a valid URL starting with http:// or https://">
                </div>
                <div class="mb-3 d-grid gap-2">
                    <input type="submit" name="addLink" value="Add Link" class="btn btn-primary">
                </div>
            </form>
        </main>
    </div>

    <?php

    include "../../connection/connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addLink"])) {
        try {
            $linkTitle = $_POST["linkTitle"];
            $linkAddress = $_POST["linkAddress"];
            $userId = $_SESSION["userId"];

            $query = "INSERT INTO links (LinkTitle, LinkAddress, UserID) VALUES (:linkTitle, :linkAddress, :userId)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":linkTitle", $linkTitle);
            $stmt->bindParam("linkAddress", $linkAddress);
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