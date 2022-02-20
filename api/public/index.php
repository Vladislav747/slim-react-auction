<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Http\Action\HomeAction;
use \Psr\Container\ContainerInterface;

require __DIR__ . '/../vendor/autoload.php';

/* @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

/* @var App $app */
$app = (require  __DIR__.'/../config/app.php')($container);

$app->run();
