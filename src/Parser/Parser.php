<?php
namespace Olla\Flow\Parser;

use Olla\Flow\ConfigInterface;
use Olla\Flow\Service\ServiceInterface;

class Parser extends AbstractParser
{
	const PROVIDER_NAME = 'parser';
	const DEFAULTT = 'Olla\Flow\Parser\BaseParser';
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
	public function parse(string $value, $rule, bool $fix = false) {
		return $this->get()->validate($value, $rule, $fix);
	}
}