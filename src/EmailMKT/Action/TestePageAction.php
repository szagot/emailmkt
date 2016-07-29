<?php

namespace EmailMKT\Action;

use EmailMKT\TesteDoTwig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TestePageAction
{
    private $router;

    private $template;

    public function __construct(Template\TemplateRendererInterface $template = null)
    {
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $data = [
            'teste' => 'Minha primeira aplicação',
            'minhaClasse' => new TesteDoTwig()
        ];

        return new HtmlResponse($this->template->render('app::teste', $data));
    }
}
