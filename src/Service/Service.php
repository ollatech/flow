<?php
namespace Olla\Flow\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;


class Service implements ServiceInterface
{
	protected $services;
	protected $container;

	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}
	public function get($provider, $serviceId) {
		if(isset($this->services[$provider])) {
			$provider = $this->services[$provider];
		} else {
			throw new \Exception("Service not exist");
		}
		if(isset($provider[$serviceId])) {
			$serviceId = $provider[$serviceId];
		}
		if ($this->container->has($serviceId))
		{
			return $this->container->get($serviceId);
		} 
		throw new \Exception("Service Provider not injected into service container");
	}

	public function addService($provider, $providerId, $serviceId) {
		$this->services[$provider][$providerId] = $serviceId;
	}
}