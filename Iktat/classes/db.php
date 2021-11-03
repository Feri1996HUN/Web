<?php
class Dbconnect{

    // Belső változók
    protected $host;
    protected $user;
    protected $pwd;
    protected $con;  // Kapcsolati string

    function __construct(){
        $this->host = "localhost";
        $this->user = "root";
        $this->pwd = "";
    }

    function Connection($dbname){
        try {
            $this->con = new PDO("mysql:host=$this->host; dbname=$dbname", $this->user, $this->pwd); // pdo első paramétere az adatbázis neve
            $this->con->exec("set names 'utf8'");
        } catch (PDOException $e) {
            die("<h1>Adatbázis kapcsolódási hiba!</h1>");
        }
    }

    function LoginCheck($user, $pwd){
        $tomb = null;   //eredmény tömb

        $res = $this->con->prepare("SELECT `nev`, `jelszo`, `admin` FROM `users` WHERE nev = ? AND jelszo = ?");
        $res->bindparam(1, $user);
        $res->bindparam(2, $pwd);
        $res->execute();

        // Az eredmény halmazt kimentjük a tömbbe
        while ($row = $res->fetch()) {
            $tomb[] = $row;
        }
        
        return $tomb;
    }
}
?>