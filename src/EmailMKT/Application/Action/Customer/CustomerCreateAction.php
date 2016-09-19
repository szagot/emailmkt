<?php

namespace EmailMKT\Application\Action\Customer;

use EmailMKT\Application\Form\CustomerForm;
use EmailMKT\Domain\Entity\Customer;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\View\HelperPluginManager;

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
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var HelperPluginManager
     */
    private $helperManager;

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
        $form = new CustomerForm();

        // Verifica se houve uma postagem
        if ($request->getMethod() == 'POST') {
            // Pega todos os dados da requisição
            $dataRaw = $request->getParsedBody();

            // Tarefa: Verificar se usuário já existe

            // Validando form
            $form->setData($dataRaw);
            if ($form->isValid()) {
                // Pega a entidade já com os dados do form hidratados (vide CustomerForm)
                $entity = $form->getData();

                // Cria o contato no BD
                $this->repository->create($entity);

                // Atribui uma flash Message
                $flash = $request->getAttribute('flash');
                $flash->setMessage('success', 'Contato Cadastrado com sucesso');

                // Pega a uri da listagem
                $uri = $this->router->generateUri('customers.list');

                // Redireciona para a listagem
                return new RedirectResponse($uri);
            }
        }

        return new HtmlResponse($this->template->render('app::customer/create', [
            'form' => $form
        ]));
    }
}
