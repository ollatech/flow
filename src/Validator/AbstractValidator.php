<?php

namespace Olla\Flow\Validator;

abstract class AbstractValidator implements ValidatorInterface {
	abstract public function execute(string $resourceClass, array $dataRequest, array $option = []);
}