<?php
require "database.php";

// Megnézem, hogy bejelentkezett-e
// Ha nem akkor visszaküldöm az index.php-ra
session_start();

$kimutatasra = false;
if (isset($_SESSION["user"])){
    $user = ucfirst($_SESSION["user"]);
}else {
    echo "hIBa";
    header("location: index.php");
}

// kapcsolódás az adatbázishoz
$db = new Dbconnect();
$db->Connection("utinaplo");

// A $users tömb és a többi feltöltése userekkel és a többivel
$users = $db->selectUpload();
$honnantomb = $db->honnanupload();
$hovatomb = $db->hovaupload();

// letöltöm az adatokat
if (isset($_POST["mutasski"])){
    $honnank = $_POST["honnanopcio"];
    $hovak = $_POST["hovaopcio"];

    $kimutatastomb = $db->kimutatas($honnank, $hovak);

    $kimutatasra = true;
}
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Útinapló</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <a class="nav-link" href="rogzit.php">Rögzítés</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="kimut.php">Kimutatások</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Kilépés</a>
      </li>
    </ul>
  </div>
</nav>
</div>

<div class="container">
  <div class="row">
    <div class="col" style="width:22%">
    <form action="#" method="POST">
    <!-- Honnan feltöltés php-ból -->
    <label for="cimzett">Honnan</label>
    <select class="form-control" name="honnanopcio" id="honnanopcio">
        <?php
            foreach ($honnantomb as $key) {
                echo "<option value=$key[ID_ut]>$key[Honnan]</option>";
            }
        ?>
    </select>
</form>
    </div>
    <div class="col">
    <form action="#" method="POST">
    <!-- Hova feltöltés php-ból -->
    <label for="cimzett">Hova</label>
    <select class="form-control" name="hovaopcio" id="hovaopcio">
        <?php
            foreach ($hovatomb as $key) {
                echo "<option value=$key[ID_ut]>$key[Hova]</option>";
            }
        ?>
    </select>
</form>
    </div>
  </div>
    <!-- OK gomb -->
    <button type="submit" name="mutasski" id="mutasski" class="btn btn-success">OK</button>



<!-- Eredmény kiírása -->
<div class="col-12 bg-secondary">
<?php
    if($kimutatasra){
        print("Utinapló");
?>
        <table class="text-left">
            <tr>
                <th>Dátum</th>
                <th>Honnan</th>
                <th>Hova</th>
                <th>km</th>
        <?php
        foreach ($kimutatastomb as $key) {
            print("<tr><td>".$key['Datum']."</td><td>".$key['Honnan']."</td><td>".$key['Hova']."</td><td>".$key['km']."</td></tr>");
        }
    }
        ?>

</div>
</div>

   


</body>
</html>