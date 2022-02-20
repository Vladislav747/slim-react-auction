<?php


declare(strict_types=1);

use DI\Container;

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Http\Action\HomeAction;

require __DIR__ . '/../vendor/autoload.php';

$builder = new DI\ContainerBuilder();

$builder->addDefinitions([
  'config' => [
    'debug' => (bool)getenv('APP_DEBUG')
  ],
\Psr\Http\Message\ResponseFactoryInterface::class => DI\get(\Slim\Psr7\Factory\ResponseFactory::class),
//  \App\Http\Action\HomeAction::class => function () {
//    return new \App\Http\Action\HomeAction(new \Slim\Psr7\Factory\ResponseFactory());
//  }
]);

$container = $builder->build();


$app = AppFactory::createFromContainer($container);

$app->addErrorMiddleware((bool)getenv('APP_DEBUG'), true,true);

(require __DIR__.'/../config/routes.php')($app);

$app->run();

//echo '{}';
