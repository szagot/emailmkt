<?php

namespace EmailMKT\Application\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\View\HelperPluginManager;

class TwigMiddleware
{

    /**
     * @var \Twig_Environment
     */
    private $twigEnv;
    /**
     * @var HelperPluginManager
     */
    private $helperManager;

    public function __construct(\Twig_Environment $twigEnv, HelperPluginManager $helperManager)
    {
        $this->twigEnv = $twigEnv;
        $this->helperManager = $helperManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $helperManager = $this->helperManager;

        // Executa quando o Twig não achar uma função chamada no template
        $this->twigEnv->registerUndefinedFunctionCallback(function ($name) use ($helperManager) {
            // Se não criamos a função, retorna falso
            if (! $helperManager->has($name)) {
                return false;
            }

            // É pra executar o método __invoke do objeto (função chamada no twig)
            $callable = [$helperManager->get($name), '__invoke'];
            // É pra permitir o html sem precisar usar '| raw'
            $options = ['is_safe' => ['html']];

            return new \Twig_SimpleFunction(null, $callable, $options);
        });

        return $next($request, $response);
    }
}
