<?php

namespace Olla\Flow\Validator;

abstract class AbstractValidator implements ValidatorInterface {
	abstract public function validate(string $value, $rule, bool $fix = false); 
}