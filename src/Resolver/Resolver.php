<?php

namespace Olla\Flow\Resolver;

use Olla\Flow\Operation\OperationInterface;
use Olla\Flow\Storage\StorageInterface;
use Olla\Flow\Guard\GuardInterface;
use Olla\Flow\Metadata\MetadataInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class Resolver  {
	protected $container;
	protected $operation;
	protected $guard;
	protected $storage;
	protected $metadata;
	
	public function setContainer(ContainerInterface $container) {
		$previous = $this->container;
		$this->container = $container;
		return $previous;
	}

	public function setOperation(OperationInterface $operation) {
		$previous = $this->operation;
		$this->operation = $operation;
		return $operation;
	}

	public function setMetadata(MetadataInterface $metadata) {
		$previous = $this->metadata;
		$this->metadata = $metadata;
		return $metadata;
	}

	public function setGuard(GuardInterface $guard) {
		$previous = $this->guard;
		$this->guard = $guard;
		return $guard;
	}

	public function setStorage(StorageInterface $storage) {
		$previous = $this->storage;
		$this->porter = $storage;
		return $storage;
	}
}
