<?php
require "classes/db.php";

// üzenet változója meg tömb
$uzen = "";
$tomb = null;

// session törlése, ha valahol beragadt a session változó
if (isset($_SESSION["user"])){
    session_destroy();
}

// Ellenőzröm, hogy az odlal a login gombbal lett-e elküldve, és akkor dolgozom fel
if (isset($_POST["login"])){
    // Kimentem a küldött adatokat
    $user = $_POST["nev"];
    $pwd = $_POST["pwd"];

    // kapcsolódás az adatbázishoz
    $db = new Dbconnect();
    $db->Connection("iktat");

    // Ellenőrizzük, hogy az illető jogosult-e a kapcsolódásra
    if ($tomb = $db->LoginCheck($user, $pwd)){
        session_start();
        $_SESSION["user"] = $user;
        $_SESSION["admin"] = $tomb[0]["admin"];

        header("location: iktat.php");
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
    <title>Iktató rendszer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/iktat.css">
</head>
<body>
    <div class="container-fluid text-center">
        <div class="jumbotron">
            <h1>Iktató rendszer</h1>
            <p>Adja meg a nevét és a jelszavát</p>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="nev">Név</label>
                <input type="text" class="form-control" name="nev" id="nev" placeholder="Adja meg a nevét!" minlength="3" required>
            </div>
            <div class="form-group">
                <label for="pwd">Jelszó</label>
                <input type="text" class="form-control" name="pwd" id="pwd" placeholder="Jelszó" minlength="8" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">OK</button>
            <div>
                <h3><?php echo $uzen ?><h3>
            </div>
        </form>
    </div>
</body>
</html>