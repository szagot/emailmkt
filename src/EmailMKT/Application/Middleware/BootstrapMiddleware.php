<?php

namespace EmailMKT\Application\Middleware;

use EmailMKT\Domain\Service\BootstrapInterface;
use EmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BootstrapMiddleware
{

    /**
     * @var BootstrapInterface
     */
    private $bootstrap;
    /**
     * @var FlashMessageInterface
     */
    private $flash;

    public function __construct(BootstrapInterface $bootstrap, FlashMessageInterface $flash)
    {
        $this->bootstrap = $bootstrap;
        $this->flash = $flash;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->bootstrap->create();

        $request = $this
            // Enganando o sistema, para o caso de a requisição vir de um form
            ->spoofingMethod($request)
            // Passando a instância do flash message via atributo,
            // já que será usado em toda a aplicação
            ->withAttribute('flash', $this->flash);

        return $next($request, $response);
    }

    /**
     * Diferentemente de um API, um método http request vindo de um form só funciona com GET ou POST
     * Use esse método para pegar o campo '_method' do form a fim de saber qual o rel método usado
     *
     * @param ServerRequestInterface $request
     *
     * @return ServerRequestInterface
     */
    protected function spoofingMethod(ServerRequestInterface $request)
    {
        // Pega os dados da requisição
        $data = $request->getParsedBody();
        // Verifica se existe o campo _method
        $method = isset($data[ '_method' ]) ? strtoupper($data[ '_method' ]) : null;
        // Verifica se é um método válido
        if (in_array($method, ['PUT', 'DELETE'])) {
            // Muda o método e retorna a requisição
            return $request->withMethod($method);
        }

        // Apenas retorna a requisição
        return $request;
    }
}
