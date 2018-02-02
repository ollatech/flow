<?php

namespace Olla\Flow\Parser;

abstract class AbstractParser implements ParserInterface {
	abstract public function parse(string $value, $rule, bool $fix = false); 
}