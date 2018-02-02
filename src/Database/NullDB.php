<?php

namespace Olla\Flow\Security\Guard;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullDB extends AbstractDB{
	public function getRepository(string $resourceClass) {
		
	}
}