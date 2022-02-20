<?php

declare(strict_types=1);

use DI\Container;

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Http\Action\HomeAction;

require __DIR__ . '/../vendor/autoload.php';

$builder = new DI\ContainerBuilder();

$builder->addDefinitions(require __DIR__ . '/../config/dependencies.php');

$container = $builder->build();


$app = AppFactory::createFromContainer($container);

(require __DIR__.'/../config/middleware.php')($app);
(require __DIR__.'/../config/routes.php')($app);

$app->run();

//echo '{}';
