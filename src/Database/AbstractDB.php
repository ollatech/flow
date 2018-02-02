<?php

namespace Olla\Flow\Database;

abstract class AbstractDB implements DBInterface {
	abstract public function getRepository(string $resourceClass);
	abstract public function addRepository(string $engine, string $resourceClass, string $serviceId);
}