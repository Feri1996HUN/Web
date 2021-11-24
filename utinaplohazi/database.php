<?php
class Dbconnect{

    // Belső változók
    protected $host;
    protected $user;
    protected $pass;
    protected $con;  // Kapcsolati string

    function __construct(){
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
    }

    function Connection($dbname){
        try {
            $this->con = new PDO("mysql:host=$this->host; dbname=$dbname", $this->user, $this->pass); // pdo első paramétere az adatbázis neve
            $this->con->exec("set names 'utf8'");
        } catch (PDOException $e) {
            die("<h1>Adatbázis kapcsolódási hiba!</h1>");
        }
    }


    function LoginCheck($user, $pass){
        $tomb = null;   //eredmény tömb

        $res = $this->con->prepare("SELECT `Nev`, `Jelszo` FROM `users` WHERE nev = ? AND jelszo = ?");
        $res->bindparam(1, $user);
        $res->bindparam(2, $pass);
        $res->execute();

        // Az eredmény halmazt kimentjük a tömbbe
        while ($row = $res->fetch()) {
            $tomb[] = $row;
        }
        
        return $tomb;
    }

    function selectUpload(){
        $tomb = null;
    
        $res = $this->con->prepare("SELECT nev, ID_user FROM users");
        $res->execute();
    
        // Az eredmény halmazt kimentjük a tömbbe
        while ($row = $res->fetch()) {
            $tomb[] = $row;
        }
    }
    function rogzit($datum, $honnan, $hova, $km, $userid){
        $res = $this->con->prepare("INSERT INTO `utak` (`Datum`, `Honnan`, `Hova`, `km`, `ID_user`) VALUES (:datum,:honnan,:hova,:km,:userid)");

        $res->bindparam("datum", $datum);
        $res->bindparam("honnan", $honnan);
        $res->bindparam("hova", $hova);
        $res->bindparam("km", $km);
        $res->bindparam("userid", $userid);

        $res->execute();
    }

    function honnanupload(){
        $tomb = null;
    
        $res = $this->con->prepare("SELECT DISTINCT Honnan FROM utak");
        $res->execute();
    
        // Az eredmény halmazt kimentjük a tömbbe
        while ($row = $res->fetch()) {
            $tomb[] = $row;
        }

        return $tomb;
    }

    function hovaupload(){
        $tomb = null;
    
        $res = $this->con->prepare("SELECT DISTINCT Hova FROM utak");
        $res->execute();
    
        // Az eredmény halmazt kimentjük a tömbbe
        while ($row = $res->fetch()) {
            $tomb[] = $row;
        }
        return $tomb;
    }

    function kimutatas($honnank, $hovak, $id){
        $tomb = null; 
        $res = $this->con->prepare("SELECT `Datum`, `Honnan`, `Hova`, `km` FROM `utak` WHERE (Honnan LIKE :honnan OR Hova LIKE :hova) AND ID_user = :id");

        $honnank .= "%";
        $hovak .= "%";
        $res->bindparam("honnan", $honnank);
        $res->bindparam("hova", $hovak);
        $res->bindparam("id", $id);
        $res->execute();

    // Az eredmény halmazt kimentjük a tömbbe
    while ($row = $res->fetch()) {
    $tomb[] = $row;
    }
    
    return $tomb;
    }

    function nevID($user){
        $tomb = null;
        $res = $this->con->prepare("SELECT `ID_user` FROM `users` WHERE Nev = :user");
        $res->bindparam("user", $user);
        $res->execute();

    // Az eredmény halmazt kimentjük a tömbbe
    while ($row = $res->fetch()) {
    $tomb[] = $row;
    }

    return $tomb[0]["ID_user"];

    }
    
}
?>