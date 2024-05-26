<!DOCTYPE html>
<html lang="en-US" translate="no">

<?php

include "../includes/heads/user_head.php";

session_start();

if (empty($_SESSION["userId"])) {
    header("Location: ../index.php");
}

?>

<body class="mb-4">
    <?php include "../includes/headers/user_header.php"; ?>

    <?php

    include "../connection/connection.php";

    $userId = $_SESSION["userId"];

    $queryFiles = "SELECT COUNT(FileID) AS Files FROM files_view WHERE UserID = :userId";
    $stmtFiles = $conn->prepare($queryFiles);
    $stmtFiles->bindParam(":userId", $userId);
    $stmtFiles->execute();
    $rowFiles = $stmtFiles->fetch(PDO::FETCH_ASSOC);

    $queryLinks = "SELECT COUNT(LinkID) AS Links FROM links_view WHERE UserID = :userId";
    $stmtLinks = $conn->prepare($queryLinks);
    $stmtLinks->bindParam(":userId", $userId);
    $stmtLinks->execute();
    $rowLinks = $stmtLinks->fetch(PDO::FETCH_ASSOC);

    $queryNotes = "SELECT COUNT(NoteID) AS Notes FROM notes_view WHERE UserID = :userId";
    $stmtNotes = $conn->prepare($queryNotes);
    $stmtNotes->bindParam(":userId", $userId);
    $stmtNotes->execute();
    $rowNotes = $stmtNotes->fetch(PDO::FETCH_ASSOC);

    $countsArray = array(
        "files" => $rowFiles["Files"],
        "links" => $rowLinks["Links"],
        "notes" => $rowNotes["Notes"]
    );

    if ($rowFiles["Files"] > 0) {
        $queryLastFile = "SELECT FileName, Date, Time FROM (SELECT * FROM files_view WHERE UserID = :userId ORDER BY Date DESC, Time DESC LIMIT 1) SUB ORDER BY Date ASC, Time ASC";
        $stmtLastFile = $conn->prepare($queryLastFile);
        $stmtLastFile->bindParam(":userId", $userId);
        $stmtLastFile->execute();
        $rowLastFile = $stmtLastFile->fetch(PDO::FETCH_ASSOC);
    } else {
        $rowLastFile = array(
            "FileName" => "",
            "Date" => "",
            "Time" => ""
        );
    }

    if ($rowLinks["Links"] > 0) {
        $queryLastLink = "SELECT LinkTitle, Date, Time FROM (SELECT * FROM links_view WHERE UserID = :userId ORDER BY Date DESC, Time DESC LIMIT 1) SUB ORDER BY Date ASC, Time ASC";
        $stmtLastLink = $conn->prepare($queryLastLink);
        $stmtLastLink->bindParam(":userId", $userId);
        $stmtLastLink->execute();
        $rowLastLink = $stmtLastLink->fetch(PDO::FETCH_ASSOC);
    } else {
        $rowLastLink = array(
            "LinkTitle" => "",
            "Date" => "",
            "Time" => ""
        );
    }

    if ($rowNotes["Notes"] > 0) {
        $queryLastNote = "SELECT NoteTitle, Date, Time FROM (SELECT * FROM notes_view WHERE UserID = :userId ORDER BY Date DESC, Time DESC LIMIT 1) SUB ORDER BY Date ASC, Time ASC";
        $stmtLastNote = $conn->prepare($queryLastNote);
        $stmtLastNote->bindParam(":userId", $userId);
        $stmtLastNote->execute();
        $rowLastNote = $stmtLastNote->fetch(PDO::FETCH_ASSOC);
    } else {
        $rowLastNote = array(
            "NoteTitle" => "",
            "Date" => "",
            "Time" => ""
        );
    }

    ?>

    <div class="content-container col-md-8 mx-auto">
        <main class="container">
            <div class="text-center mb-4">
                <div class="fs-6">
                    Welcome <span class="h6">
                        <?php echo $_SESSION["name"] . " " . $_SESSION["lastName"] ?>
                    </span>
                </div>
                <div class="small fst-italic">
                    Your Stuff, Everywhere.
                </div>
            </div>
            <div class="row text-center mx-3 mb-4">
                <div class="col text-center border-start">
                    <h6 class="mb-1">Files</h6>
                    <div class="small"><?php echo $rowFiles["Files"] ?></div>
                </div>
                <div class="col text-center border-start">
                    <h6 class="mb-1">Links</h6>
                    <div class="small"><?php echo $rowLinks["Links"] ?></div>
                </div>
                <div class="col text-center border-start border-end">
                    <h6 class="mb-1">Notes</h6>
                    <div class="small"><?php echo $rowNotes["Notes"] ?></div>
                </div>
            </div>
            <div class="mx-3">
                <h6 class="text-center mb-2">Your Storage</h6>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-interval="5000" data-bs-touch="true" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active mb-5">
                            <div>
                                <canvas id="barChartContainer"></canvas>
                            </div>
                        </div>
                        <div class="carousel-item mb-5">
                            <div>
                                <canvas id="doughnutChartContainer"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-3">
                <h6 class="text-center mb-2">Recent Activity</h6>
                <table class="table small rounded-table">
                    <thead>
                        <tr>
                            <th class="table-primary">Name</th>
                            <th class="table-primary">Date</th>
                            <th class="table-primary">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="small"><?php echo $rowLastFile["FileName"]; ?></td>
                            <td class="small"><?php echo $rowLastFile["Date"]; ?></td>
                            <td class="small"><?php echo $rowLastFile["Time"]; ?></td>
                        </tr>
                        <tr>
                            <td class="small"><?php echo $rowLastLink["LinkTitle"]; ?></td>
                            <td class="small"><?php echo $rowLastLink["Date"]; ?></td>
                            <td class="small"><?php echo $rowLastLink["Time"]; ?></td>
                        </tr>
                        <tr>
                            <td class="small"><?php echo $rowLastNote["NoteTitle"]; ?></td>
                            <td class="small"><?php echo $rowLastNote["Date"]; ?></td>
                            <td class="small"><?php echo $rowLastNote["Time"]; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let counts = <?php echo json_encode($countsArray); ?>;
    </script>

    <script src="../public/javascripts/charts.js"></script>

</body>

</html>