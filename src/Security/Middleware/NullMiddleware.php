<?php

namespace Olla\Flow\Security\Middleware;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullMiddleware extends AbstractMiddleware {
	public function can(string $resourceClass = null, string $operation = null) {
		return true;
	}
}