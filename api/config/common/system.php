<?php
declare(strict_types=1);

use \Psr\Http\Message\ResponseFactoryInterface;

return [
  'config' => [
    'debug' => (bool)getenv('APP_DEBUG')
  ],
  ResponseFactoryInterface::class => DI\get(\Slim\Psr7\Factory\ResponseFactory::class),
//  \App\Http\Action\HomeAction::class => function () {
//    return new \App\Http\Action\HomeAction(new \Slim\Psr7\Factory\ResponseFactory());
//  }
];
