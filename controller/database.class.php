<?php
class Connection
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "test";

    function __construct() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        if (isset($_GET['Del'])) {
            $this -> del($_GET['Del']);
        }
    }

    function insert($User, $Koelkast, $Content, $Artikelnummer, $Prijs, $Energie, $Inhoud, $Time) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO koelkast (User, Koelkast, Content, Artikelnummer, Prijs, Energie, Inhoud, Time) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("ssssssss", $User, $Koelkast, $Content, $Artikelnummer, $Prijs, $Energie, $Inhoud, $Time);
        $stmt -> execute();
        $conn -> close();
    }

    function get_data() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "SELECT * FROM koelkast";
        $result = $conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn -> close();
        return $data;
    }

    function clear_data() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "TRUNCATE TABLE koelkast";
        $conn -> query($sql);
        $conn -> close();
    }

    function del($ID) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "DELETE FROM koelkast WHERE ID = {$ID}";
        $conn -> query($sql);
        $conn -> close();
    }

    function get_user() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn -> close();
        return $data;
    }

    function update_key($user, $key) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "UPDATE user SET user_key= '{$key}' WHERE user= '{$user}'";
        $conn->query($sql);
        $conn -> close();
    }

}
?>