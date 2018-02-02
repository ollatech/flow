<?php

namespace Olla\Flow\Security\Credential;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

final class Credential extends AbstractCredential {
	const PROVIDER_NAME = 'credential';
	const DEFAULTT = 'Olla\Flow\Security\Credential\NullCredential';
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
	public function getUser() {
		return $this->get()->getUser();
	}
}