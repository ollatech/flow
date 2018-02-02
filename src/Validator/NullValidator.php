<?php

namespace Olla\Flow\Security\Guard;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullValidator extends AbstractValidator{
	public function getRepository(string $resourceClass) {
		
	}
}