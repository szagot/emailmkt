<?php

namespace EmailMKT\Application\Action\Customer;

use EmailMKT\Domain\Entity\Customer;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerCreateAction
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
        // Verifica se houve uma postagem
        if ($request->getMethod() == 'POST') {
            // Pega todos os dados da requisição
            $data = $request->getParsedBody();

            // Cria a entidade
            // Tarefa: Verificar se usuário já existe
            $entity = new Customer();
            $entity
                ->setName($data[ 'name' ])
                ->setEmail($data[ 'email' ]);

            $this->repository->create($entity);
        }

        return new HtmlResponse($this->template->render('app::customer/create'));
    }
}
