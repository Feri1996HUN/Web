<?php
require "database.php";

// üzenet változója meg tömb
$uzen = "";
$tomb = null;

// session törlése, ha valahol beragadt a session változó
if (isset($_SESSION["user"])){
    session_destroy();
}

// Ellenőzröm, hogy az oldal a login gombbal lett-e elküldve, és akkor dolgozom fel
if (isset($_POST["login"])){
    // Kimentem a küldött adatokat
    $user = $_POST["nev"];
    $pass = $_POST["pass"];

    // kapcsolódás az adatbázishoz
    $db = new Dbconnect();
    $db->Connection("utinaplo");

    // Ellenőrizzük, hogy az illető jogosult-e a kapcsolódásra
    if ($tomb = $db->LoginCheck($user, $pass)){
        session_start();
        $_SESSION["user"] = $user;
        header("location: rogzit.php");
    }
    else {
        $db = null;
        $uzen = "Hibás bejelentkezési adatok";
    }
}
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Útinapló</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="align-items-center">
<div class="container-fluid text-center">
        <div class="jumbotron">
            <h1>Bejelentkezés</h1>
        </div>
        <form action="" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                <div class="form-group align-items-center text-center">
                <label for="nev">Név</label>
                <input type="text" class="form-control" name="nev" id="nev" placeholder="Név" required>
            </div>
            <div class="form-group align-items-center text-center">
                <label for="pwd">Jelszó</label>
                <input type="text" class="form-control" name="pass" id="pass" placeholder="Jelszó" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">OK</button>
                </div>
                <div class="col-sm">
                </div>
            </div>
            </div>
            
            <div>
                <h3><?php echo $uzen ?><h3>
            </div>
        </form>
    </div>
</body>
</html>