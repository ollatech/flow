<?php

namespace Olla\Flow\Security\Guard;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullGuard extends AbstractGuard {
	public function can(string $action, string $resourceClass = null, string $property = null) {
		return true;
	}
}