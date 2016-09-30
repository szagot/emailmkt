<?php

namespace EmailMKT\Application\Action;

use EmailMKT\Domain\Service\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

class LogoutAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var AuthInterface
     */
    private $authService;

    public function __construct(
        RouterInterface $router,
        AuthInterface $authService
    ) {
        $this->router = $router;
        $this->authService = $authService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->authService->destroy();
        // Pega a uri da listagem
        $uri = $this->router->generateUri('auth.login');

        // Redireciona para o login
        return new RedirectResponse($uri);

    }
}
