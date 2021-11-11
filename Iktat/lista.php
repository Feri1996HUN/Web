<?php
require "classes/db.php";

// Megnézem, hogy bejelentkezett-e
// Ha nem akkor visszaküldöm az index.php-ra
session_start();

$listara = false;


if (isset($_SESSION["user"])){
    $user = ucfirst($_SESSION["user"]);
}else {
    echo "hIBa";
    //header("location: index.php");
}

// kapcsolódás az adatbázishoz
$db = new Dbconnect();
$db->Connection("iktat");

// A $users tömb feltöltése userekkel
$users = $db->selectUpload();

// letöltöm az adatokat
if (isset($_POST["lista"])){
    $userid = $_POST["cimzett"];
    $dattol = $_POST["datumtol"];
    $datig = $_POST["datumig"];

    $levelek = $db->lista($userid, $dattol, $datig);

    $listara = true;
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
        <a class="nav-link disabled" href="lista.php">Kimutatások</a>
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

    <!-- Címzett feltöltés php-ból -->
    <label for="cimzett">Címzett kijelölése</label>
    <select class="form-control" name="cimzett" id="cimzett">
        <?php
            foreach ($users as $key) {
                echo "<option value=$key[ID_user]>$key[nev]</option>";
            }
        ?>
    </select>
        <!-- Dátumtól -->
        <div class="form-group">
    <label for="datumtol">Dátumtól</label>
    <input type="date" name="datumtol" class="form-control" id="datumtol" required>
  </div>
      <!-- Dátumig -->
      <div class="form-group">
    <label for="datumig">Dátumig</label>
    <input type="date" name="datumig" class="form-control" id="datumig" required>
  </div>
    <!-- OK gomb -->
<button type="submit" name="lista" id="lista" class="btn btn-success">Lista</button>
</form>
<!-- Eredmény kiírása -->
<div class="col-12 bg-secondary">
<?php
    if($listara){
        print($user." levelei");
?>
        <table class="text-left">
            <tr>
                <th>Dátum</th>
                <th>Tárgy</th>
                <th>Leírás</th>
        <?php
        foreach ($levelek as $key) {
            print("<tr><td>".$key['erkezett']."</td><td>".$key['targy']."</td><td>".$key['leiras']."</td></tr>");
        }
    }
        ?>

</div>
</div>
</body>
</html>