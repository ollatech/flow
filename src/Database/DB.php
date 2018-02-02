<?php
namespace Olla\Flow\Database;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

class DB extends AbstractDB
{
	const PROVIDER_NAME = 'storage';
	const DEFAULTT = 'Olla\Flow\Database\NullDB';

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
	public function getRepository(string $resourceClass) {
		return $this->get()->getRepository($resourceClass);
	}
}