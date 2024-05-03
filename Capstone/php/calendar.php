<?php

require_once('config.php');
session_start();

echo <<<_END

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/calstyle.css">
    <title>NCW | Event Calendar</title>
</head>
<body>
  <header class="navbar">
    <div id="brand"><a href="../index.html">Next Chapter Winery</a></div>
    <nav>
        <ul>
            <li><a href="calendar.php">Events</a></li>
            <li><a href="../webpages/about.html">About</a></li>
            <li id="login"><a href="../webpages/login.html">Login</a></li>
            <li id="signup"><a href="../webpages/signup.html">Sign-Up</a></li>
            <li><div id="account"></div></li>
            <li id="signOutBtn"><a href="#" id="signOutLink">Sign Out</a></li>


            <script src="../javascripts/authPages.js"></script>
            
        </ul>
    </nav>
</header>
    <div class="page">
    <section class="parallax-container">
        <div id="inside">
        <h1>Event Calendar</h1>
        <p>
          See about page on how to plan your event!
        </p>
    </div>
      </section>
  
      <section class="buffer"></section>
  
      <section class="parallax-container parallax-container2">
_END;

$conn = new mysqli($hn, $un, $pw, $db);

if($conn -> connect_error) die("Fatal Error on Connection");

$query = "SELECT * FROM event";
$result = $conn -> query($query);
if (!$result) echo "No Events";

$rows = $result -> num_rows;
for ($m = 0; $m < $rows; $m++) {

    $row = $result -> fetch_array(MYSQLI_ASSOC);

    if ($row['approved'] == '1' && $row['eventType'] == 'Wedding') {
        $id = htmlspecialchars($row['ID']);
        echo "<div class='card'>";
        if (empty($row['filename'])) {
            echo <<<_END
                <style>
                .card-img$m {
                    background: url('../imgs/userUploads/stock/stockWedding.jpg');
                    width: 100%;
                    height: 250px;
                    border-radius: 0.3em;
                    background-position: center;
                    background-size: cover;
                }
                
                </style>
            _END;
            echo "<div class='card-img$m'><h2></h2></div>";        
        } else {
            $img = $row['filename'];
            echo <<<_END
                <style>
                .card-img$m {
                    background: url('../imgs/userUploads/user/$img');
                    width: 100%;
                    height: 250px;
                    border-radius: 0.3em;
                    background-position: center center;
                    background-size: cover;
                }
                
                </style>
            _END;
            echo "<div class='card-img$m'></div>";
        }
    echo "<h3>" .  htmlspecialchars($row['eventname']) . "</h3>";
    echo "<p>" . htmlspecialchars(stripslashes($row['description'])) . "</p>";

    echo "<a href='#'>". htmlspecialchars($row['date']). "</a>";
    echo "</div>";

    }
}

$result -> data_seek(0);
$result -> close();
$conn -> close();

echo <<<_END
</section>
  
      <section class="buffer"><a href="#" id="backToTop">Back to Top</a></section>


      <section class="parallax-container parallax-container3">
_END;

$conn = new mysqli($hn, $un, $pw, $db);

if($conn -> connect_error) die("Fatal Error on Connection");

$query = "SELECT * FROM event";
$result = $conn -> query($query);
if (!$result) echo "No Events";

$rows = $result -> num_rows;
for ($o = 0; $o < $rows; $o++) {

    $row = $result -> fetch_array(MYSQLI_ASSOC);

    if ($row['approved'] == '1' && $row['eventType'] == 'Wine Tasting') {
        $id = htmlspecialchars($row['ID']);
        echo "<div class='card'>";
        if (empty($row['filename'])) {
            echo <<<_END
                <style>
                .card-img$o {
                    background: url('../imgs/userUploads/stock/stockWine.jpg');
                    width: 100%;
                    height: 250px;
                    border-radius: 0.3em;
                    background-position: center;
                    background-size: cover;
                }
                </style>
            _END;
            echo "<div class='card-img$o'><h2></h2></div>";        
        } else {
            $img = $row['filename'];
            echo <<<_END
                <style>
                .card-img$o {
                    background: url('../imgs/userUploads/user/$img');
                    width: 100%;
                    height: 250px;
                    border-radius: 0.3em;
                    background-position: center;
                    background-size: cover;
                }
                </style>
            _END;
            echo "<div class='card-img$o'><h2></h2></div>";
        }
    echo "<h3>" .  htmlspecialchars($row['eventname']) . "</h3>";
    echo "<p>" . htmlspecialchars(stripslashes($row['description'])) . "</p>";

    echo "<a href='#'>". htmlspecialchars($row['date']). "</a>";
    echo "</div>";

    }
}

$result -> data_seek(0);
$result -> close();
$conn -> close();

echo <<<_END
</section>

      <section class="buffer"><a href="#" id="backToTop">Back to Top</a></section>


      <section class="parallax-container parallax-container4">
_END;

$conn = new mysqli($hn, $un, $pw, $db);

if($conn -> connect_error) die("Fatal Error on Connection");

$query = "SELECT * FROM event";
$result = $conn -> query($query);
if (!$result) echo "No Events";

$rows = $result -> num_rows;
for ($p = 0; $p < $rows; $p++) {

    $row = $result -> fetch_array(MYSQLI_ASSOC);

    if ($row['approved'] == '1' && $row['eventType'] == 'Private') {
        $id = htmlspecialchars($row['ID']);
        echo "<div class='card'>";
        if (empty($row['filename'])) {
            echo <<<_END
                <style>
                .card-img$p {
                    background: url('../imgs/userUploads/stock/stockPrivate.jpg');
                    width: 100%;
                    height: 250px;
                    border-radius: 0.3em;
                    background-position: center;
                    background-size: cover;
                }
                </style>
            _END;
            echo "<div class='card-img$p'><h2></h2></div>";        
        } else {
            $img = $row['filename'];
            echo <<<_END
                <style>
                .card-img$p {
                    background: url('../imgs/userUploads/user/$img');
                    width: 100%;
                    height: 250px;
                    border-radius: 0.3em;
                    background-position: center;
                    background-size: cover;
                }
                </style>
            _END;
            echo "<div class='card-img$p'><h2></h2></div>";
        }
    echo "<h3>" .  htmlspecialchars($row['eventname']) . "</h3>";
    echo "<p>" . htmlspecialchars(stripslashes($row['description'])) . "</p>";

    echo "<a href='#'>". htmlspecialchars($row['date']). "</a>";
    echo "</div>";

    }
}

$result -> data_seek(0);
$result -> close();
$conn -> close();

echo <<<_END
</section>

      <section class="buffer"><a href="#" id="backToTop">Back to Top</a></section>

    </div>

</body>
</html>
_END;

?>