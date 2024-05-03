<?php

require_once "config.php";

if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli($hn,$un,$pw,$db);

    $query = "SELECT * FROM account WHERE username='$username'";

    $result = $conn->query($query);
    if(! $result) die("Database access failed");

    $loggedSuccess = false;

    foreach($result as $item) {
        if(password_verify($password, $item['password'])) {
            $loggedSuccess = true;
            break;
        }
    }
    

    if($loggedSuccess) {

        session_start();
        $results = mysqli_query($conn, $query);
        $administation = $results->fetch_array(MYSQLI_ASSOC);
        if( $administation['admin'] == '1'){
            $_SESSION['username'] = $username;
            header('location: admin.php');
        } else {
        $_SESSION['username'] = $username;
        header('Location: ../index.html');
        }
    } else {
        header('Location: ../webpages/login.html');
    }
    $conn->close();
}

?>