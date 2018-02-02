<?php

namespace Olla\Flow\Security\Middleware;

abstract class AbstractMiddleware implements MiddlewareInterface {
	abstract public function can( string $resourceClass, string $operation);
}