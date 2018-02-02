<?php

namespace Olla\Flow\Validator;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class NullValidator extends AbstractValidator{
	public function validate(string $value, $rule, bool $fix = false) {
		return true;
	}
}