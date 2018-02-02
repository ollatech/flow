<?php

namespace Olla\Flow\Security\Guard;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullSerializer extends AbstractSerializer{
	public function getRepository(string $resourceClass) {
		
	}
}