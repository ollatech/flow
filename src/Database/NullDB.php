<?php

namespace Olla\Flow\Database;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullDB extends AbstractDB {
	public function getRepository(string $resourceClass) {

	}
	public function addRepository(string $engine, string $resourceClass, string $serviceId) {

	}
}