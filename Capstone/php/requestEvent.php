<?php 

require_once("config.php");

session_start();

if (isset($_POST["username"]) && isset($_POST["eventname"]) && isset($_POST["description"]) && isset($_POST["eventType"]) && isset($_POST["date"]) && isset($_FILES["filename"])) {

    if($_FILES) {
        $tmpName = $_FILES['filename']['name'];
        $destination = '../imgs/userUploads/user/' . $_FILES['filename']['name'];

        switch($_FILES['filename']['type']) {
            case 'image/jpeg': $ext = 'jpg'; break;
            case 'image/gif':  $ext = 'gif'; break;
            case 'image/png':  $ext = 'png'; break;
            case 'image/tiff': $ext = 'tif'; break;
            default:           $ext = '';    break;
        }
            move_uploaded_file($_FILES['filename']['tmp_name'], $destination);
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die ("Fatal error on conn");

            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $eventname = mysqli_real_escape_string($conn, $_POST['eventname']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $eventType = mysqli_real_escape_string($conn, $_POST['eventType']);
            $date = mysqli_real_escape_string($conn, $_POST['date']);
            
            $filename = mysqli_real_escape_string($conn, $_FILES['filename']['name']);
            $id = NULL;

            $var = "SELECT * FROM account WHERE username = '$username'";
            $result = $conn -> query($var);
            $rows = $result -> num_rows;
            $row = $result -> fetch_assoc();
            $accountID = $row['ID'];
            
            
            
            

            if($_POST['username'] == $_SESSION['username']) {
                $stmt = $conn->prepare("INSERT INTO event (`ID`, `username`, `accountID`, `eventname`, `description`, `eventType`, `date`, `filename`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isisssss", $id, $username, $accountID, $eventname, $description,  $eventType, $date, $filename);

                if($stmt->execute()) {
                    header("Location: calendar.php");
                    exit();
                } else  {
                    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
                }
                
            } 

        
    } 
    $conn->close();
} 

?>