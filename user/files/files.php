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
                <img class="mb-3" src="../../public/images/illustrations/files.webp" alt="Files">
                <h3 class="mb-2">Files</h3>
                <p class="text-center small mx-3">Easily access and organize all your uploaded files in one convenient location.</p>
            </div>
            <div class="mb-3 mx-3 d-grid gap-2">
                <a class="btn btn-primary text-decoration-none text-light" href="./add-file.php"><i class="fa-solid fa-plus px-1"></i> Add File</a>
            </div>
            <div class="accordion mx-3" id="accordionExample">

                <?php

                include "../../connection/connection.php";

                $userId = $_SESSION["userId"];

                $query = "SELECT * FROM files_view WHERE UserID = :userId";
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
                                data-bs-target="#accordion' . $row["FileID"] . '"
                                aria-expanded="true"
                                aria-controls="accordion' . $row["FileID"] . '"
                            >
                                <h6 class="text-dark my-1">' . $row["FileName"] . '</h6>
                            </button>
                        </h2>
                        <div
                            id="accordion' . $row["FileID"] . '"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample"
                        >
                        <div class="accordion-body py-0">
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <h6>File Type:</h6>
                                    <span class="small">' . strtoupper($row["FileType"]) . '</span>
                                </div>
                                <div class="col-6">
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
                                    <a class="btn btn-secondary text-decoration-none text-light btn-sm py-1" href="./download-file.php?file_id=' . $row["FileID"] . '">
                                        <i class="fa-solid fa-download px-1"></i> Download
                                    </a>
                                </div>
                                <div class="col-6 d-grid gap-2">
                                    <a class="btn btn-danger text-decoration-none text-light btn-sm py-1" href="./delete-file.php?file_id=' . $row["FileID"] . '">
                                        <i class="fa-solid fa-trash-can px-1"></i> Delete
                                    </a>
                                </div>
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