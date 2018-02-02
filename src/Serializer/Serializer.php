<?php
namespace Olla\Flow\Serializer;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

class Serializer extends AbstractSerializer
{
	const PROVIDER_NAME = 'serializer';
	const DEFAULTT = 'Olla\Flow\Serializer\NullSerializer';
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
	public function normalize($data, string $format, array $context = []) {
		return $this->get()->normalize($data, $format, $context);
	}
}