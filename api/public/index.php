<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (\http\Client\Request $request. \http\Client\Response $respomse, $args){
  $respomse->getBody()->write('{}');
  return $respomse->withHeader('Content-Type', 'application/json');
});

$app->run();
