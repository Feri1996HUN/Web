<?php
require "database.php";

// Megnézem, hogy bejelentkezett-e
// Ha nem akkor visszaküldöm az index.php-ra
session_start();
if (isset($_SESSION["user"])){
    $user = ucfirst($_SESSION["user"]);
}else {
    echo "hIBa";
    header("location: index.php");
}

// kapcsolódás az adatbázishoz
$db = new Dbconnect();
$db->Connection("utinaplo");

// A $users tömb feltöltése userekkel
$users = $db->selectUpload();

$userid = $db->nevID($user);

// Adatok beírása az adatbázisba
if (isset($_POST["rogzit"])){
    $datum = $_POST["datum"];
    $honnan = $_POST["honnan"];
    $hova = $_POST["hova"];
    $km = $_POST["km"];

    

    $db->rogzit($datum, $honnan, $hova, $km, $userid);
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
<body>
<div class="container-fluid align-items-center text-center">
        <!-- Menü --> 
        <div class="jumbotron">    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"></a>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link disabled" href="rogzit.php">Rögzítés</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kimut.php">Kimutatások</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Kilépés</a>
      </li>
    </ul>
  </div>
</nav>
</div>
<!-- Adatform -->
<form action="#" method="POST">
<div class="container">
  <div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm">
      <!-- Dátum -->
    <div class="form-group align-items-center text-center">
    <label for="datum">Dátum</label>
    <input type="date" name="datum" class="form-control text-center" id="datum" required value="<?php echo date('Y-m-d'); ?>">
    </div>
    <!-- Honnan -->
    <div class="form-group">
    <label for="targy">Honnan</label>
    <input type="text" name="honnan" class="form-control text-center" id="honnan" minlength="3" required placeholder="Az indulási hely megadása szövegesen">
  </div>
    <!-- Hova -->
    <div class="form-group">
    <label for="comment">Hova</label>
    <input type="text" name="hova" class="form-control text-center" id="hova" minlength="3" required placeholder="Az érkezési hely megadása szövegesen">
  </div>
      <!-- Km -->
      <div class="form-group">
    <label for="comment">Km</label>
    <input type="number" name="km" class="form-control text-center" id="km" required placeholder="A megtett egész km">
  </div>
    <!-- OK gomb -->
<button type="submit" name="rogzit" id="rogzit" class="btn btn-success">Rögzít</button>
    </div>
    <div class="col-sm">
    </div>
  </div>
</div>
    
</form>
    </div>
</body>
</html>