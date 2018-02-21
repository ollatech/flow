<?php
namespace Olla\Flow\Components;

use Olla\Flow\Repository;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class RepositoryComponent implements Repository {

	protected $repositories;
	protected $container;
	protected $engine;

	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}

	private function repositories() {
		if(isset($this->repositories[$this->engine])) {
			return  $this->repositories[$this->engine];
		} else {
			return [];
		}
	}
	
	public function has($resourceClass) {
		$repositories = $this->repositories($resourceClass);
		if($this->container->has($component)) {
			return true;
		}
	}

	public function get(string $resourceClass) {
		$this->engine = $this->container->getParameter('olla.storage');
		$repositories = $this->repositories();
		//rolling up, check if any compatible
		foreach ($repositories as $key => $repoID) {
			if(null !== $repository = $this->service($repoID)) {
				if($repository->supports($resourceClass)) {
					return $repository;
				}
			}
		}
		//nothing compatible, use default
		$repositories = $this->container->getParameter('olla.storages');
		if(isset($repositories[$this->engine])) {
			if(null !== $repository = $this->service($repositories[$this->engine])) {
				return $repository->setClass($resourceClass);
			}
		}
		throw new \Exception("Component not found in container");
	}

	private function service($serviceId) {
		if($this->container->has($serviceId)) {
			return $this->container->get($serviceId);
		}
	}

	public function engine(string $engine) {
		$this->engine = $engine;
		return $this;
	}

	public function addRepository(string $engine, string $containerId) {
		$this->repositories[$engine][] = $containerId;
	}
}