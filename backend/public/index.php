<?php
require __DIR__ . '/../vendor/autoload.php';


use Slim\Factory\AppFactory;


//agrega bd jwt


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
//


$app = AppFactory::create();


//agrega bd jwt


$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);


//


// Middleware (CORS para comunicación con Vue)
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')//front url
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')//cambia Accept por Authorization
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
});


// Importar rutas
(require __DIR__ . '/../src/Routes/routes.php')($app);


$app->run();
?>


