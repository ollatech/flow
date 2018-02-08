<?php
namespace Olla\Flow\Components;

use Olla\Flow\Theme;
use Twig\Environment as TwigEnvironment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;

final class ThemeComponent implements Theme {
	
	protected $templates;
	protected $container;
	protected $twig;
	protected $designs;
	protected $design;
	protected $engine;
	protected $template;
	protected $finder;
	protected $relativeTemplate;

	public function __construct(ContainerInterface $container, TwigEnvironment $twig, Finder $finder) {
		$this->container = $container;
		$this->twig = $twig;
		$this->finder = $finder;

	}
	public function getPath() {
		return $this->container->getParameter('kernel.project_dir').'/design/'.$this->context.'/'.$this->design;
	}

	public function templates() {
		$files = $this->finder->files()->in($this->getPath())->name('*.twig');
		$templates = [];
		foreach ($files as $fullPah => $file) {
			$templates[$file->getRelativePathname()] = $fullPah;
		}
		return $templates;
	}
	
	public function context(string $context) {
		if(isset($this->templates[$context])) {
			$this->context = $context;
			$this->designs = $this->templates[$context];
		} else {
			throw new \Exception(sprintf('%s theme context not available', $context));
		}
		return $this;
	}

	public function design(string $design) {
		$this->design = $design;
		if($this->designs && isset($this->designs[$design])) {
			if(null !== $designService = $this->get($this->designs[$design])) {
				$this->engine = $designService;
			}
		}
		return $this;
	}

	public function template(string $template) {
		$templates = $this->templates();
		if(isset($templates[$template])) {
			$this->template = $templates[$template];
		} else {
			throw new \Exception(sprintf('%s not exist', $template));
		}
		return $this;
	}
	
	public function get(string $serviceId) {
		if($this->container->has($serviceId)) {
			return $this->container->get($serviceId);
		}
		throw new \Exception("Component not found in container");
	}
	public function render(string $template = null, array $data = []) {
		if(!$template) {
			$template = 'app.html.twig';
		}
		$relativeTemplate = $this->context.'/'.$this->design.'/'.$template;
		$theme = sprintf('@theme/%s', $relativeTemplate);
		return $this->engine->render($theme, $data);
	}
	public function addTheme(string $context, string $design, string $serviceId) {
		$this->templates[$context][$design] = $serviceId;
	}
}