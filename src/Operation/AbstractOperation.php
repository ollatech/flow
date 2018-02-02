<?php

namespace Olla\Flow\Operation;

abstract class AbstractOperation implements OperationInterface {
	abstract public function execute(string $resourceClass, array $dataRequest, array $option = []);
}