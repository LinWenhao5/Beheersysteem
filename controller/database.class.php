<?php
class Connection
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "test";
    private $status = False;
    public $user;

    function __construct() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        if (isset($_GET['Del'])) {
            $this -> del($_GET['Del']);
        }
    }

    function key() {
        $user = $this->get_user();
        $len = count($user) - 1;
        for ($i = 0; $i <= $len; $i++) {
            if ($_SESSION['key'] == $user[$i]['user_key']) {
                $this -> status = True;
                $this -> user = $user[$i]['user'];
            }
        }
        if (!$this->status) {
            header('location:index.php');
            exit;
        }
    }

    function insert_koelkast($User, $Koelkast, $Content, $Artikelnummer, $Prijs, $Energie, $Inhoud, $Reparatie, $Time) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO koelkast (User, Koelkast, Content, Artikelnummer, Prijs, Energie, Inhoud, Reparatie, Time) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("sssssssss", $User, $Koelkast, $Content, $Artikelnummer, $Prijs, $Energie, $Inhoud, $Reparatie, $Time);
        $stmt -> execute();
        $conn -> close();
    }

    function insert_inner_j($k_id, $v_id) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "INSERT INTO inner_j (k_id, v_id) VALUES (?,?)";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("ss", $k_id, $v_id);
        $stmt -> execute();
        $conn -> close();
    }

    function update_data($id, $Koelkast, $Content, $Prijs, $Energie, $Inhoud) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "UPDATE koelkast SET Koelkast=?, Content=?, Prijs=?, Energie=?, Inhoud=? WHERE Artikelnummer=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("ssssss", $Koelkast, $Content, $Prijs, $Energie, $Inhoud, $id);
        $stmt->execute();
        $conn -> close();
    }

    function update_rep_data($id, $content) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "UPDATE koelkast SET Reparatie =? WHERE Artikelnummer=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("ss",$content, $id);
        $stmt->execute();
        $conn -> close();
    }

    function clear_v_data($id) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "DELETE FROM inner_j WHERE k_id='{$id}'";
        $conn -> query($sql);
        $conn -> close();
    }

    function get_koelkast_data($sql) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $result = $conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn -> close();
        return $data;
    }

    function get_one_koelkast($id) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "SELECT * FROM koelkast WHERE Artikelnummer = '{$id}'";
        $result = $conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn -> close();
        return $data;
    }

    function get_all_data() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "SELECT koelkast.koelkast, koelkast.Artikelnummer, verzekering.naam
                FROM koelkast
                INNER JOIN inner_j ON koelkast.Artikelnummer = k_id
                INNER JOIN verzekering ON verzekering.ID = v_id";
        $result = $conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn -> close();
        return $data;
    }

    function get_rep_data() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql = "SELECT * FROM koelkast WHERE NOT Reparatie = 'geen'";
        $result = $conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn -> close();
        return $data;
    }

    function del($ID) {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $sql_koelkast = "DELETE FROM koelkast WHERE Artikelnummer = '{$ID}'";
        $conn -> query($sql_koelkast);
        $sql_inner_j = "DELETE FROM inner_j WHERE K_id = '{$ID}'";
        $conn -> query($sql_inner_j);
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