<?php

namespace Olla\Flow\Security\Guard;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class Guard extends AbstractGuard {
	const PROVIDER_NAME = 'guard';
	const DEFAULTT = 'Olla\Flow\Security\Guard\NullGuard';
	protected $config;
	protected $service;
	protected $provider;

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
	public function can(string $action, string $resourceClass = null, string $property = null) {
		return $this->get()->can($action, $resourceClass, $property);
	}
}