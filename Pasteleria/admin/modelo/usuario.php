<?php
class Usuario {
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $email;
    protected $password;
    protected $tipo_usuario;

    public function __construct($id, $nombre, $apellido, $email, $password, $tipo_usuario) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->password = $password;
        $this->tipo_usuario = $tipo_usuario;
    }

    public function registrarUsuario($nombre, $apellido, $email, $password, $tipo_usuario) {
        require_once '../../includes/config/database.php';
        $db = conectarDB();
        $pashash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios (nombre, apellido, email, password, tipo_usuario, estado) VALUES ('$nombre', '$apellido', '$email', '$pashash', '$tipo_usuario', 'activo')";
        return $db->query($query);
    }

    public function listaUsuarios() {
        require_once '../../includes/config/database.php';
        $db = conectarDB();
        $query = "SELECT id, nombre, apellido, email, tipo_usuario 
                  FROM usuarios 
                  WHERE estado='activo' 
                  ORDER BY id";
        return $db->query($query);
    }

    public function eliminarUsuario($id) {
        require_once '../../includes/config/database.php';
        $db = conectarDB();
        $query = "UPDATE usuarios SET estado='inactivo' WHERE id='$id'";
        return $db->query($query);
    }

    public function buscarUsuario($cod) {
        require_once '../../includes/config/database.php';
        $db = conectarDB();
        $res = $db->query("SELECT * FROM usuarios WHERE id='$cod' AND estado='activo'");
        return $res;
    }

    public function modificarUsuario($cod, $password) {
        require_once '../../includes/config/database.php';
        $db = conectarDB();
        $pashash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET password='$pashash' WHERE id='$cod'";
        return $db->query($query);
    }
}
?>