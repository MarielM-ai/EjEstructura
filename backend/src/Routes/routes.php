<?php
use Slim\App;
use App\Controllers\HomeController;
use App\Controllers\AtenticacionController;
use App\Middleware\JwtMiddleware;
return function (App $app) {
    $app->get('/api/saludo', HomeController::class . ':saludo');
    


    $app->post('/api/login', [AtenticacionController::class, 'login']);


    $app->get('/api/protegida', function ($request, $response) {
        $jwt = $request->getAttribute('jwt');
        $response->getBody()->write(json_encode(['mensaje' => 'Acceso permitido', 'usuario' => $jwt]));
        return $response->withHeader('Content-Type', 'application/json');
    })->add(new JwtMiddleware());
    
};


?>
