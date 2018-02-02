<?php

namespace Olla\Flow\Security\Gate;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class Gate extends AbstractGate {
	const PROVIDER_NAME = 'middleware';
	const DEFAULTT = 'Olla\Flow\Security\Gate\NullGate';
	protected $config;
	protected $service;
	protected $middleware;

	public function __construct(ConfigInterface $config, ServiceInterface $service) {
		$this->config = $config;
		$this->service = $service;
	}
	public function get() {
		$provider = $this->provider;
		if(!$provider && null !== $configured = $this->config->get('storage_default')) {
			$provider = $configured;
		}
		if(!$provider) {
			$provider = self::DEFAULTT;
		}
		return $this->service->get(self::PROVIDER_NAME, $provider);
	}
	public function provider(string $provider = null) {
		if($provider) {
			$this->provider = $provider;
		}
		return $this;
	}
	public function can(string $resourceClass = null, string $operation = null) {
		return $service->get()->can($resourceClass, $operation);
	}
}