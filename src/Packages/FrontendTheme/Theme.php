<?php
namespace Olla\Flow\Packages\FrontendTheme;

use Olla\Flow\Theme as ThemeInterface;
use Twig\Environment as TwigEnvironment;
use Symfony\Component\HttpFoundation\Response;

final class Theme implements ThemeInterface
{
	public function __construct(TwigEnvironment $twig) {
		$this->twig = $twig;
	}
	public function config(array $config = []) {
		return $this;
	}
	public function render(string $template = null, array $data = []) {
		$response = $data;
		return Response::create($this->twig->render($template,$response));
	}
}
