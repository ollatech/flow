<?php

namespace Olla\Flow\Serializer;

abstract class AbstractSerializer implements SerializerInterface {
	abstract public function execute(string $resourceClass, array $dataRequest, array $option = []);
}