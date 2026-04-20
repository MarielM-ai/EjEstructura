<?php
namespace App\Middleware;


use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slim\Psr7\Response;


class JwtMiddleware {
    public function __invoke($request, $handler) {
        $authHeader = $request->getHeaderLine('Authorization');


        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $response = new Response();
            $response->getBody()->write(json_encode(['error' => 'Token no proporcionado']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }


        try {
            $token = $matches[1];
            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
            $request = $request->withAttribute('jwt', $decoded);
        } catch (\Exception $e) {
            $response = new Response();
            $response->getBody()->write(json_encode(['error' => 'Token inválido']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }


        return $handler->handle($request);
    }
}
?>
