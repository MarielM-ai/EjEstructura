<?php
namespace App\Controllers;


use App\Models\Usuario;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class AtenticacionController {
    public function login(Request $request, Response $response) {
        $data = (array)$request->getParsedBody();
        $login = $data['login'] ?? '';
        $password = $data['pwd'] ?? '';


        $userModel = new Usuario();
        $user = $userModel->validar($login, $password);


        if (!$user) {
            $response->getBody()->write(json_encode(['error' => 'Usuario o contraseña incorrectos']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }


        $token = JWT::encode(
            ['correo' => $user->mail, 'login' => $user->login, 'exp' => time() + 3600],
            $_ENV['JWT_SECRET'],
            'HS256'
        );


        $response->getBody()->write(json_encode(['token' => $token, 'login' => $user->mail]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
?>
