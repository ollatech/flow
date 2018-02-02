<?php

namespace Olla\Flow\Serializer;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullSerializer extends AbstractSerializer{
	
	public function normalize($data, string $format, array $context = []) {
		return $data;
	}
}