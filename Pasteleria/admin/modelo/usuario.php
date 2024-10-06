<?php
    class Usuario{
        protected $id;
        protected $contraseña;
        protected $email;

        public function __construct($id,$contraseña,$email){
            $this -> id = $id;
            $this -> contraseña = $contraseña;
            $this->email = $email;
        }
        public function registrarUsuario($pa,$em){
            require '../../includes/config/database.php';
            $db = conectarDB();
            $db->query("INSERT INTO usuariosd (pasword, email, estado) VALUES ('$pa', '$em','Activo')");
            return $db;
        }
        public function registrarUsuarioAdmin($pa,$em){
            require '../../includes/config/database.php';
            $db = conectarDB();
            $db->query("INSERT INTO usuariosc (pasword, email, estado) VALUES ('$pa', '$em','Activo')");
            return $db;
        }
        public function listaUsuario(){
            include_once("conexion.php");
            $db = new Conexion();
            $res = $db->query("SELECT * FROM usuariosc WHERE estado='Activo'");
            return $res;
        }
        public function eliUsuario($cod){
            require '../../includes/config/database.php';
            $db = conectarDB();
            $db->query("UPDATE usuariosc SET estado='Inactivo' WHERE idUsuario='$cod'");
            return $db;
        }
        public function buscarUsuario($cod){
            require '../../includes/config/database.php';
            $db = conectarDB();
            $res = $db->query("SELECT * FROM usuariosc WHERE idUsuario='$cod' and estado='Activo'");
            return $res;
        }
        public function modificarUsuario($cod,$p){
            //require '../../includes/config/database.php';
            $db = conectarDB();
            $db->query("UPDATE usuariosd SET pasword='$p' WHERE idUsuario='$cod'");
            return $db;
        }
    }
?>