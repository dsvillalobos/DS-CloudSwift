<!DOCTYPE html>
<html lang="en-US" translate="no">

<?php

include "./includes/heads/index_head.php";

session_start();

?>

<body class="mb-4">
    <?php include "./includes/headers/index_header.php"; ?>

    <div class="content-container col-md-8 mx-auto">
        <main class="container">
            <div class="illustration-container text-center mb-3">
                <img class="mb-3" src="./public/images/illustrations/sign-up.webp" alt="Sign Up to DS CloudSwift">
                <h3 class="mb-2">Sign Up to DS CloudSwift</h3>
                <p class="text-center small mx-3">Join DS CloudSwift and unlock seamless file, link, and note management.</p>
            </div>
            <div class="mx-3 small d-none" id="errorAlertContainer">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Whoops!</strong> That email address is already taken. Try to <a class="alert-link" href="./index.php">Sign In</a>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="mx-3 small d-none" id="successAlertContainer">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Please proceed to <a class="alert-link" href="./index.php">Sign In</a> to access your account.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <form method="post" autocomplete="off" class="mx-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required maxlength="255" pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" title="Please enter a valid name (letters only, no numbers or special characters)">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" class="form-control" required maxlength="255" pattern="^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$" title="Please enter a valid name (letters only, no numbers or special characters)">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required maxlength="255">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required maxlength="255" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one number, one uppercase letter, one lowercase letter, and be at least 8 characters long">
                </div>
                <div class="mb-3 d-grid gap-2">
                    <input type="submit" name="signUp" value="Sign Up" class="btn btn-primary" required>
                </div>
                <div class="mb-3 text-center small">
                    Already have an account? <a href="./index.php">Sign In</a>.
                </div>
            </form>
        </main>
    </div>

    <?php

    include "./connection/connection.php";

    if (isset($_POST["signUp"])) {
        try {
            $name = $_POST["name"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (Name, LastName, Email, Password) VALUES (:name, :lastName, :email, :password)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":lastName", $lastName);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->execute();

            echo "<script>
                const successAlertContainer = document.getElementById('successAlertContainer');
                successAlertContainer.classList.remove('d-none');
            </script>";
            exit();
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