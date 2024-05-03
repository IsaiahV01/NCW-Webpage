<?php

require_once 'config.php';
session_start();

//Navbar
echo <<<_END

<!doctype html>
<html>
	
	<head>
		<meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/navstyle.css">
        <link rel="stylesheet" href="../css/admin.css">
       
		<title>NCW | Admin Page</title>
	</head>
	
	<body>
        <header class="navbar" style="color: black;">
            <div id="brand"><a href="../index.html">Next Chapter Winery</a></div>
            <nav>
                <ul>
                    <li><a href="calendar.php" style="color: black;">Events</a></li>
                    <li><a href="../webpages/about.html" style="color: black;">About</a></li>
                    <li><div id="account"></div></li>
                    <li id="signOutBtn"><a href="#" id="signOutLink" style="color: black;">Sign Out</a></li>
                    

                    <script type="text/javascript">
                        var contentDiv = document.getElementById("account");
                        var signOutBtn = document.getElementById("signOutBtn");

                        fetch('verifyAuth.php')
                        .then(response => response.json())
                        .then(function(data) {
                            console.log(data);
                            if(data.auth) {
                                contentDiv.innerHTML = "Welcome Back " + data.username;
                                document.getElementById("login").classList.add("hidden");
                                document.getElementById("signup").classList.add("hidden");
                                document.getElementById("signOutBtn").style.display = "inline-block";
                                document.getElementById("signOutBtn").classList.add("revealed");
                            }
                        });

                        signOutBtn.onclick = function() {
                            fetch('signout.php')
                            .then(function() {
                                location.replace("index.html");
                            });
                        }
                    </script>
                    
                </ul>
            </nav>
        </header>
        <h1>------------* IF YOU LEAVE THIS PAGE YOU MUST LOGIN AGAIN TO RETURN TO IT *------------</h1>
_END;

echo "<div class='objects'>";
$conn = new mysqli($hn, $un, $pw, $db);

if($conn -> connect_error) die("Fatal Error on Connection");

//Approve
if (isset($_POST['approve']) && isset($_POST['id'])) {
    $id = get_post($conn, 'id');
    $query = "UPDATE `event` SET `approved` = '1' WHERE `event`.`ID`='$id'";
    $result = $conn->query($query);
    if(!$result) echo "APPROVE FAILED.<br><br>";
}

//Delete
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = get_post($conn, 'id');
    $query = "DELETE FROM event WHERE id='$id'";
    $result = $conn->query($query);
    if(! $result) echo "DELETE FAILED.<br><br>";
}


echo "<br><br>-----UNAPPROVED EVENTS-----<br><br><br><br>";
//Display Requests
    $query = "SELECT * FROM event";
    $result = $conn -> query($query);
    $rows = $result -> num_rows;
for ($n = 0; $n < $rows; $n++) {

    $row = $result -> fetch_array(MYSQLI_ASSOC);
    
    if ($row['approved'] == '0') {
        $id = htmlspecialchars($row['ID']);
        echo 'User: ' . htmlspecialchars($row['username']) . '<br>';
        echo 'Event name: ' . htmlspecialchars($row['eventname']) . '<br>';
        echo 'Description: ' . htmlspecialchars($row['description']) . '<br>';
        echo 'Event type: ' . htmlspecialchars($row['eventType']) . '<br>';
        echo 'Date: ' . htmlspecialchars($row['date']) . '<br>';
        
        if (htmlspecialchars($row['filename'])) {
            $img = $row['filename'];
            echo "<img src='../imgs/userUploads/user/$img'>" . '<br>';
        } else {
            echo 'No Image, stock photo will be used.' . '<br>';
        }

        echo <<<_END
            <form action='admin.php' method='post'>
            <input type='hidden' name='approve' value='yes'>
            <input type='hidden' name='id' value='$id'>
            <input type='submit' value='APPROVE RECORD'>
            </form><br>
            _END;

        echo <<<_END
            <form action='admin.php' method='post'>
            <input type='hidden' name='delete' value='yes'>
            <input type='hidden' name='id' value='$id'>
            <input type='submit' value='DELETE RECORD'>
            </form><br><br><br>
            _END;
        echo "----------------------<br><br>";
    } 
}
    $result -> data_seek(0);
    $result -> close();
    $conn -> close();

    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn -> connect_error) die("Fatal Error on Connection");


    $query = "SELECT * FROM event";
    $result = $conn -> query($query);   
    $rows = $result -> num_rows;

    echo "<br><br><br><br>-----WEDDING EVENTS-----<br><br><br><br>";
for ($m = 0; $m < $rows; $m++) {
    
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    //display approved events, can remove them here
    //Weddings
    if ($row['approved'] == '1' && $row['eventType'] == 'Wedding') {
        $id = htmlspecialchars($row['ID']);
        echo 'User: ' . htmlspecialchars($row['username']) . '<br>';
        echo 'Event name: ' . htmlspecialchars($row['eventname']) . '<br>';
        echo 'Description: ' . htmlspecialchars($row['description']) . '<br>';
        echo 'Event type: ' . htmlspecialchars($row['eventType']) . '<br>';
        echo 'Date: ' . htmlspecialchars($row['date']) . '<br>';
        echo <<<_END
            <form action='admin.php' method='post'>
            <input type='hidden' name='delete' value='yes'>
            <input type='hidden' name='id' value='$id'>
            <input type='submit' value='DELETE RECORD'>
            </form><br><br><br>
            _END;
    } 
}

    $result -> data_seek(0);
    $result -> close();
    $conn -> close();

    $conn = new mysqli($hn, $un, $pw, $db);

if($conn -> connect_error) die("Fatal Error on Connection");
$query = "SELECT * FROM event";
$result = $conn -> query($query);
$rows = $result -> num_rows;

echo "<br><br><br><br>-----WINE TASTING EVENTS-----<br><br><br><br>";
for ($o = 0; $o < $rows; $o++) {

    $row = $result -> fetch_array(MYSQLI_ASSOC);
    //Wine Tasting
    if ($row['approved'] == '1' && $row['eventType'] == 'Wine Tasting') {
        $id = htmlspecialchars($row['ID']);
        echo 'User: ' . htmlspecialchars($row['username']) . '<br>';
        echo 'Event name: ' . htmlspecialchars($row['eventname']) . '<br>';
        echo 'Description: ' . htmlspecialchars($row['description']) . '<br>';
        echo 'Event type: ' . htmlspecialchars($row['eventType']) . '<br>';
        echo 'Date: ' . htmlspecialchars($row['date']) . '<br>';

        echo <<<_END
            <form action='admin.php' method='post'>
            <input type='hidden' name='delete' value='yes'>
            <input type='hidden' name='id' value='$id'>
            <input type='submit' value='DELETE RECORD'>
            </form><br><br><br>
            _END;
    }
}

    $result -> data_seek(0);
    $result -> close();
    $conn -> close();

    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn -> connect_error) die("Fatal Error on Connection");
    
    $query = "SELECT * FROM event";
    $result = $conn -> query($query);
    $rows = $result -> num_rows;


    echo "<br><br><br><br>-----PRIVATE EVENTS-----<br><br><br><br>";
for ($p = 0; $p < $rows; $p++) {

    $row = $result -> fetch_array(MYSQLI_ASSOC);
//Private
    if ($row['approved'] == '1' && $row['eventType'] == 'Private') {
        $id = htmlspecialchars($row['ID']);
        echo 'User: ' . htmlspecialchars($row['username']) . '<br>';
        echo 'Event name: ' . htmlspecialchars($row['eventname']) . '<br>';
        echo 'Description: ' . htmlspecialchars($row['description']) . '<br>';
        echo 'Event type: ' . htmlspecialchars($row['eventType']) . '<br>';
        echo 'Date: ' . htmlspecialchars($row['date']) . '<br>';

        echo <<<_END
            <form action='admin.php' method='post'>
            <input type='hidden' name='delete' value='yes'>
            <input type='hidden' name='id' value='$id'>
            <input type='submit' value='DELETE RECORD'>
            </form><br><br><br>
            _END;
    }
}


    $result -> data_seek(0);
    $result -> close();
    $conn -> close();
echo "</div>";
echo "</body></html>";


function get_post($conn,$var) {
    $var = htmlentities($_POST[$var]);

    return $conn -> real_escape_string($var);
}

?>