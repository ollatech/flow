<?php

namespace Olla\Flow\Security\Gate;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullGate extends AbstractGate {
	public function can(string $resourceClass = null, string $operation = null) {
		return true;
	}
}