<?php


class LoginFlow {

	protected $component;

	public function __constract(Component $component) {
		$this->component = $component;
	}

	public function validate($inputs) {
		return $this;
	}

	public function check(user) {

	}

	public function login($args) {
		$status = $this->component('auth')
		->provider('fos_user')
		->login($args);
	}
	public function collection($args) {
		$repository = $this->component('repository')
		->provider('orm')
		->class($class);
		$repository->find();
	}
}