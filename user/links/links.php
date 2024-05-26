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
                <img class="mb-3" src="../../public/images/illustrations/links.webp" alt="Links">
                <h3 class="mb-2">Links</h3>
                <p class="text-center small mx-3">Browse your saved links with ease. Access your collection of URLs quickly and conveniently.</p>
            </div>
            <div class="mb-3 mx-3 d-grid gap-2">
                <a class="btn btn-primary text-decoration-none text-light" href="./add-link.php"><i class="fa-solid fa-plus px-1"></i> Add Link</a>
            </div>
            <div class="accordion mx-3" id="accordionExample">

                <?php

                include "../../connection/connection.php";

                $userId = $_SESSION["userId"];

                $query = "SELECT * FROM links_view WHERE UserID = :userId";
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
                                data-bs-target="#accordion' . $row["LinkID"] . '"
                                aria-expanded="true"
                                aria-controls="accordion' . $row["LinkID"] . '"
                            >
                                <h6 class="text-dark my-1">' . $row["LinkTitle"] . '</h6>
                            </button>
                        </h2>
                        <div
                            id="accordion' . $row["LinkID"] . '"
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
                                    <a class="btn btn-info text-decoration-none text-light btn-sm py-1" href="./edit-link.php?link_id=' . $row["LinkID"] . '">
                                        <i class="fa-solid fa-pen-to-square px-1"></i> Edit
                                    </a>
                                </div>
                                <div class="col-6 d-grid gap-2">
                                    <a class="btn btn-danger text-decoration-none text-light btn-sm py-1" href="./delete-link.php?link_id=' . $row["LinkID"] . '">
                                        <i class="fa-solid fa-trash-can px-1"></i> Delete
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 d-grid gap-2">
                                    <a class="btn btn-secondary text-decoration-none text-light btn-sm py-1" target="_blank" href="' . $row["LinkAddress"] . '">
                                        <i class="fa-solid fa-arrow-up-right-from-square px-1"></i> Open Link
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