<?php

namespace EmailMKT\Application\Action;

use EmailMKT\Domain\Entity\Customer;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class TestePageAction
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
        // Testando entrada no BD de Contato
        $customer = new Customer();
        $customer
            ->setName('Daniel Bispo')
            ->setEmail('daniel@tmw.com.br');

        $this->repository->create($customer);

        $data = [
            'teste'    => 'Minha primeira aplicação',
            'clientes' => []
        ];

        return new HtmlResponse($this->template->render('app::teste', $data));
    }
}
