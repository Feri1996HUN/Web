<?php
require "classes/db.php";

// Megnézem, hogy bejelentkezett-e
// Ha nem akkor visszaküldöm az index.php-ra
session_start();

$uzen = "";
$tomb = null;

if (isset($_SESSION["user"])){
    $user = ucfirst($_SESSION["user"]);
}else {
    echo "hIBa";
    //header("location: index.php");
}

// Ellenőrzöm, hogy az odlal a regisztrációs gombbal lett-e elküldve, és akkor dolgozom fel
if (isset($_POST["regisztral"])){
    // Kimentem a küldött adatokat
    $reguser = $_POST["nev"];
    $regpwd = $_POST["pwd"];

    // kapcsolódás az adatbázishoz
    $db = new Dbconnect();
    $db->Connection("iktat");

    // Ellenőrizzük, hogy már létező adatokat visz fel vagy nem
    if ($db->RegisztracioCheck($reguser)){
        $db = null;
        $uzen = "Már regisztráltak ilyen adatokkal!";
    }
    else {
        $db->regisztral($reguser, $regpwd);
        $uzen = "Sikeres regisztráció!";
    }
}
?>



<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iktatás</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/iktat.css">
</head>
<body>
    <div class="container-fluid text-center">
        <!-- Menü --> 
        <div class="jumbotron">    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <!-- A regisztrálás menüpont csak akkor jelenik meg, ha a bejelentkezett felhasználó admin -->
        <?php
            if($_SESSION["admin"] == 1){
                echo '<li class="nav-item active"><a class="nav-link" href="regiszt.php">Regisztrálás</a></li>';
            }
        ?>
      <li class="nav-item">
        <a class="nav-link" href="iktat.php">Iktatás</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="lista.php">Kimutatások</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Kilépés</a>
      </li>
    </ul>
  </div>
</nav>
</div>
<!-- Adatform -->
<form action="" method="post">
            <div class="form-group">
                <label for="nev">Név</label>
                <input type="text" class="form-control" name="nev" id="nev" placeholder="Adja meg a nevet!" minlength="3" required>
            </div>
            <div class="form-group">
                <label for="pwd">Jelszó</label>
                <input type="text" class="form-control" name="pwd" id="pwd" placeholder="Adja meg az jelszót!" minlength="8" required>
            </div>
            <button type="submit" class="btn btn-primary" name="regisztral">Regisztráció</button>
            <div>
                <h3><?php echo $uzen ?><h3>
            </div>
        </form>
        
</body>
</html>