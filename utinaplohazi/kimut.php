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
$id = $db->nevID($user);

// letöltöm az adatokat
if (isset($_POST["mutasski"])){

  $honnank = $_POST["honnanopcio"];
    $hovak = $_POST["hovaopcio"];
    $kimutatastomb = $db->kimutatas($honnank, $hovak, $id);
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
    <label for="honnanopcio">Honnan</label>
    <select class="form-control" name="honnanopcio" id="honnanopcio">
              <option value="">Válasszon várost!</option>
        <?php
            foreach ($honnantomb as $key) {
                echo "<option value=$key[Honnan]>$key[Honnan]</option>";
            }
        ?>
    </select>

    </div>
    <div class="col">
    <!-- Hova feltöltés php-ból -->
    <label for="hovaopcio">Hova</label>
    <select class="form-control" name="hovaopcio" id="hovaopcio">
              <option value="">Válasszon várost!</option>
        <?php
            foreach ($hovatomb as $key) {
                echo "<option value=$key[Hova]>$key[Hova]</option>";
            }
        ?>
    </select>

    </div>
  </div>
    <!-- OK gomb -->
    <button type="submit" name="mutasski" id="mutasski" class="btn btn-success">Kimutat</button>
    </form>


<!-- Eredmény kiírása -->
<div class="col-12 bg-secondary">
<?php
    if($kimutatasra){
        
       
        if (is_null($kimutatastomb)){
          echo "Nincs ilyen utinapló!";
        }
        else {
          print("Utinapló");

       echo '<table class="text-center align-items-center">
       <tr>
           <th>Dátum</th>
           <th>Honnan</th>
           <th>Hova </th>
           <th>km</th>' ;
        foreach ($kimutatastomb as $key) {
            print("<tr><td>".$key['Datum']."</td><td>".$key['Honnan']."</td><td>".$key['Hova']."</td><td>".$key['km']."</td></tr>");
        }
      }
    }
        ?>
        </table>
</div>
</div>
</body>
</html>