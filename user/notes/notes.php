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
                <img class="mb-3" src="../../public/images/illustrations/notes.webp" alt="Notes">
                <h3 class="mb-2">Notes</h3>
                <p class="text-center small mx-3">Your digital notepad awaits! Access and manage all your saved notes effortlessly in one central hub.</p>
            </div>
            <div class="mb-3 mx-3 d-grid gap-2">
                <a class="btn btn-primary text-decoration-none text-light" href="./add-note.php"><i class="fa-solid fa-plus px-1"></i> Add Note</a>
            </div>
            <div class="accordion mx-3" id="accordionExample">

                <?php

                include "../../connection/connection.php";

                $userId = $_SESSION["userId"];

                $query = "SELECT * FROM notes_view WHERE UserID = :userId";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":userId", $userId);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#accordion' . $row["NoteID"] . '"
                                aria-expanded="true"
                                aria-controls="accordion' . $row["NoteID"] . '"
                            >
                                <h6 class="text-dark my-1">' . $row["NoteTitle"] . '</h6>
                            </button>
                        </h2>
                        <div
                            id="accordion' . $row["NoteID"] . '"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample"
                        >
                        <div class="accordion-body py-0">
                            <div class="row text-center mb-3">
                                <div class="col-12">
                                    <h6>Owner:</h6>
                                    <span class="small">' . $row["Name"] . " " . $row["LastName"] . '</span>
                                </div>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <h6>Date:</h6>
                                    <span class="small">' . $row["Date"] . '</span>
                                </div>
                                <div class="col-6">
                                    <h6>Time:</h6>
                                    <span class="small">' . $row["Time"] . '</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6 d-grid gap-2">
                                    <a class="btn btn-info text-decoration-none text-light btn-sm py-1" href="./edit-note.php?note_id=' . $row["NoteID"] . '">
                                        <i class="fa-solid fa-pen-to-square px-1"></i> Edit
                                    </a>
                                </div>
                                <div class="col-6 d-grid gap-2">
                                    <a class="btn btn-danger text-decoration-none text-light btn-sm py-1" href="./delete-note.php?note_id=' . $row["NoteID"] . '">
                                        <i class="fa-solid fa-trash-can px-1"></i> Delete
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-secondary text-decoration-none text-light btn-sm py-1" data-bs-toggle="modal" data-bs-target="#noteModal' . $row["NoteID"] . '">
                                        <i class="fa-solid fa-arrow-up-right-from-square px-1"></i> Open Note
                                    </button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    ';

                    echo '
                    <div class="modal fade" id="noteModal' . $row["NoteID"] . '" tabindex="-1" aria-labelledby="noteModalLabel' . $row["NoteID"] . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="noteModalLabel' . $row["NoteID"] . '">' . $row["NoteTitle"] . '</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="m-0">' . $row["NoteBody"] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }

                ?>

            </div>
        </main>
    </div>
</body>

</html>