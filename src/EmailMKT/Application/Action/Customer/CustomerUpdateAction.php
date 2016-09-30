<?php

namespace EmailMKT\Application\Action\Customer;

use EmailMKT\Application\Form\CustomerForm;
use EmailMKT\Application\Form\HttpMethodElement;
use EmailMKT\Domain\Entity\Customer;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use EmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CustomerUpdateAction
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
    /**
     * @var CustomerForm
     */
    private $form;

    public function __construct(
        CustomerRepositoryInterface $repository,
        TemplateRendererInterface $template,
        RouterInterface $router,
        CustomerForm $form
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
        $this->form = $form;
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

        // Iniciando formulário e ligando ele com a entidade, acrescentando o campo de metodo
        $this->form->add(new HttpMethodElement(HttpMethodElement::PUT));
        $this->form->bind($entity);

        // Verifica se houve uma postagem
        if ($request->getMethod() == 'PUT') {
            // Pega todos os dados da requisição
            $dataRaw = $request->getParsedBody();

            // Validando form
            $this->form->setData($dataRaw);
            if ($this->form->isValid()) {
                // Pega a entidade já com os dados do form hidratados (vide CustomerForm)
                $entity = $this->form->getData();

                // Atualiza o contato no BD
                $this->repository->update($entity);

                // Atribui uma flash Message
                $flash = $request->getAttribute('flash');
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, 'Contato Alterado com sucesso');

                // Redireciona para a listagem
                return new RedirectResponse($uri);
            }
        }

        return new HtmlResponse($this->template->render('app::customer/update',
            ['form' => $this->form]
        ));
    }
}
