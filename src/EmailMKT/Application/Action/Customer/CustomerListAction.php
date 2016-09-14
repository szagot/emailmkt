<?php

namespace EmailMKT\Application\Action\Customer;

use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerListAction
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * @var TemplateRendererInterface
     */
    private $template;

    public function __construct(CustomerRepositoryInterface $repository, TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Pegando todos os Contatos
        $customers = $this->repository->findAll();

        $data = [
            'customers' => $customers,
            'msg'       => $request->getAttribute('flash')->getMessage('success')
        ];

        return new HtmlResponse($this->template->render('app::customer/list', $data));
    }
}
