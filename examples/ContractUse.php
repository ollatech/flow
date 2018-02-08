<?php


class ExampleClass {
	protected $component;
	public function __constract(Component $component) {
		$this->component = $component;
	}
	public function login($args) {
		$status = $this->component('auth')
		->provider('fos_user')
		->login($args);
	}
}