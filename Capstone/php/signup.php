<?php

require_once("config.php");

if (isset($_POST["first"]) && isset($_POST["last"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirmPass"])) {

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die("Fatal error on connect 7");

    $first = mysqli_real_escape_string($conn, $_POST["first"]);
    $last = mysqli_real_escape_string($conn, $_POST["last"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, password_hash($_POST["password"],PASSWORD_DEFAULT));
    $confirmPass = mysqli_real_escape_string($conn, password_hash($_POST["confirmPass"],PASSWORD_DEFAULT));
    $id = NULL;
    $admin = 0;

    if ($_POST["password"] == $_POST["confirmPass"]) {
        $stmt = $conn->prepare("INSERT INTO account (ID, first, last, username, email, password, admin) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssi", $id, $first, $last, $username, $email, $password, $admin);

        if ($stmt->execute()) {
            header('location: ../webpages/login.html');
            exit();
        } else {
            echo '<script>alert("Error: Username or Email Already Exists. Please refresh and try again.")</script>';
            sleep(5);
      
        }

        $stmt->close();
    } else {
        echo "Passwords do not match up";
    }

    $conn->close();
}

?>