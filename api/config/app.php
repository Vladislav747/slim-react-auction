<?php

declare(strict_types=1);

use Slim\App;
use \Psr\Container\ContainerInterface;
use  \Slim\Factory\AppFactory;

return static function (ContainerInterface $container):App {
  $app = AppFactory::createFromContainer($container);
  (require __DIR__.'/middleware.php')($app);
  (require __DIR__.'/routes.php')($app);
  return $app;
};
