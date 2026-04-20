<?php
namespace App\Models;


use PDO;


class Usuario {
    private $db;


    public function __construct() {
        $this->db = AccesoDB::getConectar();
    }


    public function validar($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE login = :email and pwd = sha(:pwd) LIMIT 1");
        $stmt->execute(['email' => $email, 'pwd'=>$password]);
        $usuario = $stmt->fetch(PDO::FETCH_OBJ);


        if ($usuario){//} && password_verify($password, $usuario->pwd)) {
            return $usuario;
        }


        return false;
    }
}
?>
