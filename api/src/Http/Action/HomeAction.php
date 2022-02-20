<?php

declare(strict_types=1);

namespace App\Http\Action;

use App\Http\JsonResponse;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use stdClass;

class HomeAction implements RequestHandlerInterface
{

  private ResponseFactoryInterface $factory;

  public function __construct(ResponseFactoryInterface $factory){
    $this->factory = $factory;
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
//    $response = $this->factory->createResponse();
//    $response->getBody()->write(json_encode(new \stdClass(), JSON_THROW_ON_ERROR, 512));
//    return $response->withHeader('Content-Type', 'application/json');
    return new JsonResponse([]);
  }


//  public function __invoke(Request $request, Response $response, $args): Response
//  {
//    $response->getBody()->write(json_encode(new \stdClass(), JSON_THROW_ON_ERROR, 512));
//    return $response->withHeader('Content-Type', 'application/json');
//  }
}
