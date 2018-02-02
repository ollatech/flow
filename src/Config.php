<?php

namespace Olla\Flow;

final class Config implements ConfigInterface{
	const DEFAULT_CONFIGS = [];
	protected $configs;
	
	public function __construct(array $configs = []) {
		$this->configs = array_merge(self::DEFAULT_CONFIGS, $configs);
	}
	public function get($config, $default = null) {
		if(isset($this->configs[$config])) {
			return $this->configs[$config];
		}
		return $default;
	}
	public function all() {
		return $this->configs;
	}
	public function add($name, $value) {
		$this->configs[$name] = $value;
	}
}
