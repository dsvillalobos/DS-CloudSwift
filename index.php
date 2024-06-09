<!DOCTYPE html>
<html lang="en-US" translate="no">

<?php

ob_start();

session_start();

include "./includes/heads/index_head.php";

?>

<body class="mb-4">
    <?php include "./includes/headers/index_header.php"; ?>

    <div class="content-container col-md-8 mx-auto">
        <main class="container">
            <div class="illustration-container text-center mb-3">
                <img class="mb-3" src="./public/images/illustrations/sign-in.webp" alt="Sign In to DS CloudSwift">
                <h3 class="mb-2">Sign In to DS CloudSwift</h3>
                <p class="text-center small mx-3">Get started swiftly! Sign in to access your files, links, and notes securely.</p>
            </div>
            <div class="mx-3 small d-none" id="errorAlertContainer">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> Wrong email or password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <form method="post" autocomplete="off" class="mx-3">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required maxlength="255">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required maxlength="255">
                </div>
                <div class="mb-3 d-grid gap-2">
                    <input type="submit" name="signIn" value="Sign In" class="btn btn-primary">
                </div>
                <div class="mb-3 text-center small">
                    Don't have an account yet? <a href="./sign-up.php">Sign Up</a>.
                </div>
            </form>
        </main>
    </div>

    <?php

    include "./connection/connection.php";

    if (isset($_POST["signIn"])) {
        try {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user["Password"])) {
                $_SESSION["userId"] = $user["UserID"];
                $_SESSION["name"] = $user["Name"];
                $_SESSION["lastName"] = $user["LastName"];
                $_SESSION["email"] = $user["Email"];
                header("Location: ./user/home.php");
                exit();
            } else {
                echo "<script>
                    const errorAlertContainer = document.getElementById('errorAlertContainer');
                    errorAlertContainer.classList.remove('d-none');
                </script>";
            }
        } catch (Exception $err) {
            echo "error";
        }
    }

    ob_end_flush();

    ?>

    <script src="./public/javascripts/serviceWorker-register.js"></script>

</body>

</html>