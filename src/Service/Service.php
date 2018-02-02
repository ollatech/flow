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
	public function get($service) {
		if(isset($this->services[$service])) {
			$serviceId = $this->services[$service];
		} else {
			throw new \Exception("Service not exist");
		}
		if ($this->container->has($serviceId))
		{
			return $this->container->get($serviceId);
		} 
		return null;
	}

	public function addService($provider, $providerId, $serviceId) {
		$this->services[$name] = $serviceId;
	}
}