<!DOCTYPE html>
<html lang="en-US" translate="no">

<?php

session_start();

include "../includes/heads/user_head.php";

if (empty($_SESSION["userId"])) {
    header("Location: ../index.php");
}

?>

<body class="mb-4">
    <?php include "../includes/headers/user_header.php"; ?>

    <div class="content-container col-md-8 mx-auto">
        <main class="container">
            <div class="illustration-container text-center mb-3">
                <img class="mb-3" src="../public/images/illustrations/about.webp" alt="About DS CloudSwift">
                <h3 class="mb-2">About DS CloudSwift</h3>
                <p class="text-center small mx-3">Discover the essence of DS CloudSwift.</p>
            </div>
            <ul class="list-group list-group-flush mx-3 rounded">
                <li class="list-group-item">
                    <span class="fw-bold">Created by</span> @dsvillalobos
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Version</span> 1.0.7
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Help & Privacy</span>
                    <ul>
                        <li class="mb-1">
                            <a class="text-dark" href="#">Help Center</a>
                        </li>
                        <li>
                            <a class="text-dark" href="#">Data Security</a>
                        </li>
                    </ul>
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Follow Me</span>
                    <a class="text-dark mx-2 fs-5" target="_blank" href="https://www.instagram.com/dsvillalobosss/"><i class="fa-brands fa-instagram"></i></a>
                    <a class="text-dark mx-2 fs-5" target="_blank" href="https://twitter.com/dsvillalobosss"><i class="fa-brands fa-x-twitter"></i></a>
                    <a class="text-dark mx-2 fs-5" target="_blank" href="https://www.threads.net/@dsvillalobosss"><i class="fa-brands fa-threads"></i></a>
                    <a class="text-dark mx-2 fs-5" target="_blank" href="https://github.com/dsvillalobos"><i class="fa-brands fa-github"></i></a>
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Copyright</span> © 2024 dsvillalobos.
                </li>
            </ul>
        </main>
    </div>
</body>

</html>