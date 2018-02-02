<?php

namespace Olla\Flow\Security\Credential;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullCredential extends AbstractCredential {
	public function can(string $action, string $resourceClass = null, string $property = null) {
		return true;
	}
}