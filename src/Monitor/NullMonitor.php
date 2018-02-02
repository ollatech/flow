<?php

namespace Olla\Flow\Security\Guard;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullMonitor extends AbstractMonitor{
	public function getRepository(string $resourceClass) {
		
	}
}