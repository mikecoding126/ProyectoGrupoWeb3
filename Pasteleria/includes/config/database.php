<?php
    function conectarDB(){
        $db=mysqli_connect('localhost','root','','pasteleriac');
        if(!$db){
            echo "No se conecto";
            exit;
        }
        return $db;
    }

?>
<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pasteleriac"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>