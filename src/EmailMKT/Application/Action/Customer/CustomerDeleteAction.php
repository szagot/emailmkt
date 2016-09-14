<?php

namespace EmailMKT\Application\Action\Customer;

use EmailMKT\Domain\Entity\Customer;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerDeleteAction
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * @var TemplateRendererInterface
     */
    private $template;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(
        CustomerRepositoryInterface $repository,
        TemplateRendererInterface $template,
        RouterInterface $router
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Pega id
        $id = $request->getAttribute('id');

        /** @var Customer $entity */
        $entity = $this->repository->find($id);

        // Pega a uri da listagem
        $uri = $this->router->generateUri('customers.list');

        // Verifica se o contato existe
        if (! $entity) {
            // Redireciona para a listagem
            return new RedirectResponse($uri);
        }

        // Verifica se houve uma postagem
        if ($request->getMethod() == 'POST') {
            // Pega todos os dados da requisição
            $data = $request->getParsedBody();

            $entity
                ->setName($data[ 'name' ])
                ->setEmail($data[ 'email' ]);

            $this->repository->remove($entity);

            // Atribui uma flash Message
            $flash = $request->getAttribute('flash');
            $flash->setMessage('success', 'Contato apagado com sucesso');

            // Redireciona para a listagem
            return new RedirectResponse($uri);
        }

        return new HtmlResponse($this->template->render('app::customer/delete',
            ['customer' => $entity]
        ));
    }
}
