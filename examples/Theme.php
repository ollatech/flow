<?php


class ExampleClass {
	protected $component;
	public function __constract(Component $component) {
		$this->component = $component;
	}
	public function post($args) {
		$data = [];

		return $this
		->theme
		->engine('react')
		->design('default')
		->config([
			'layout' => 'superlayout.html.twig'
			'template' => 'common.html.twig',
			'js' => [
				'js/homepage.js'
			],
			'scss' => [
				'scss/homepage.css'
			]
		])
		->data($data);
	}
}