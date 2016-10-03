<?php

namespace EmailMKT\Application\Middleware;

use EmailMKT\Domain\Service\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

class AuthenticationMiddleware
{

    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var AuthInterface
     */
    private $authService;

    public function __construct(RouterInterface $router, AuthInterface $authService)
    {
        $this->router = $router;
        $this->authService = $authService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Se não estiver autenticado, manda para o login
        if (! $this->authService->isAuth()) {
            $uri = $this->router->generateUri('auth.login');

            return new RedirectResponse($uri);
        }

        // Caso esteja autenticado, passa pro proximo middleware
        return $next($request, $response);
    }

}
