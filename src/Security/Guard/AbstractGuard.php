<?php

namespace Olla\Flow\Security\Guard;

abstract class AbstractGuard implements GuardInterface {
	abstract public function can(string $action, string $resourceClass, string $property);
}