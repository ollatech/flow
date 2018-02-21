<?php
namespace Olla\Flow\Components;

use Olla\Flow\Conneg;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;

/**
 * Content Negotiation component
 */
final class ConnegComponent implements Conneg {

	protected $request;
	protected $data;
	
	public function request($request) {
		return $this;

	}

	public function data($data) {
		return $this;
	}

	public function response() {
		return new JsonResponse([]);
	}
}