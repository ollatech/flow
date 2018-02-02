<?php
namespace Olla\Flow\Operation;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

class Operation extends AbstractOperation
{
	const PROVIDER_NAME = 'operation';
	const DEFAULTT = 'Olla\Flow\Operation\NullOperation';

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

	public function execute(string $resourceClass, array $dataRequest, array $options = []) {
		return $this->get()->execute($resourceClass, $dataRequest, $options);
	}
}