<?php

namespace PsrImplement\PSR15;

use Laminas\Diactoros\ServerRequestFactory;
use PsrImplement\PSR15\Middlewares\Bar;
use PsrImplement\PSR15\Middlewares\Foo;

require __DIR__ . '/../../vendor/autoload.php';

$queue[] = new Bar();
$queue[] = new Foo();

$request = (new ServerRequestFactory())->fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$requestHandler = new RequestHandler($queue);

$response = $requestHandler->handle($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();



