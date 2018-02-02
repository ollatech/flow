<?php

namespace Olla\Flow\Security\Guard;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullOperation extends AbstractOperation{
	public function getRepository(string $resourceClass) {
		
	}
}