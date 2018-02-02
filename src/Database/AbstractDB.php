<?php

namespace Olla\Flow\Database;

abstract class AbstractDB implements DBInterface {
	abstract public function getRepository(string $resourceClass);
}