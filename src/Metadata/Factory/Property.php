<?php

namespace Olla\Flow\Metadata\Factory;

final class Property implements FactoryInterface {

	public function create(array $annotation = [], array $payload = []) {
		$data = [];
		$data += $annotation;
		
		return $data;
	}
}
