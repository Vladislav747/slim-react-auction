<?php

declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface;

class Http
{
  public static function json(ResponseInterface $response, $data): ResponseInterface
  {
    $response->getBody()->write(json_encode(new \stdClass(), JSON_THROW_ON_ERROR, 512));
    return $response->withHeader('Content-Type', 'application/json');
  }
}
