<?php
namespace Olla\Flow;

interface Theme {
	public function render(string $template = null, array $data = []);
}