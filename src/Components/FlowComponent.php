<?php

namespace Olla\Flow;

use Symfony\Component\DependencyInjection\ContainerInterface;

final class AnnotedFlow implements Flow {
	
	protected $components;
	protected $container;

	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}

	private function component($name) {
		if(isset($this->components[$name])) {
			return $this->components[$name];
		}
		throw new \Exception("Component not injected");
	}
	
	public function has($name) {
		$component = $this->component($name);
		if($this->container->has($component)) {
			return true;
		}
	}

	public function get($name) {
		$component = $this->component($name);
		if($this->container->has($component)) {
			return $this->container->get($component);
		}
		throw new \Exception("Component not found in container");
	}

	public function addComponent($name, $component) {
		$this->components[$name] = $component;
	}
}
