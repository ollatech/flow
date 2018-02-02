<?php

namespace Olla\Flow\Security\Gate;

abstract class AbstractGate implements GateInterface {
	abstract public function can( string $resourceClass, string $operation);
}