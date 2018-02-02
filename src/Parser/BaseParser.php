<?php

namespace Olla\Flow\Parser;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class BaseParser extends AbstractParser{
	public function parse(string $value, $rule, bool $fix = false) {
		return true;
	}
}