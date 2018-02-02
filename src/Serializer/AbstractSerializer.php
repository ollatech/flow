<?php

namespace Olla\Flow\Serializer;

abstract class AbstractSerializer implements SerializerInterface {
	abstract public function normalize($data, string $format, array $context = []);
}