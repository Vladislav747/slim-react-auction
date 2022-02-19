<?php

declare(strict_types=1);

namespace App\Http\Action;

use App\Http;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class HomeAction
{
  public function __invoke(Request $request, Response $response, $args): Response
  {
    return Http::json($response, new \stdClass());
  }
}
