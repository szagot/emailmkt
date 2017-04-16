<?php

namespace EmailMKT\Application\Action\Campaign;

use EmailMKT\Application\Form\CampaignForm;
use EmailMKT\Domain\Persistence\CampaignRepositoryInterface;
use EmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\View\HelperPluginManager;

class CampaignCreatePageAction
{
    /**
     * @var CampaignRepositoryInterface
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
    /**
     * @var CampaignForm
     */
    private $form;

    public function __construct(
        CampaignRepositoryInterface $repository,
        TemplateRendererInterface $template,
        RouterInterface $router,
        CampaignForm $form
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
        $this->form = $form;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Verifica se houve uma postagem
        if ($request->getMethod() == 'POST') {
            // Pega todos os dados da requisição
            $dataRaw = $request->getParsedBody();

            // Validando form
            $this->form->setData($dataRaw);
            if ($this->form->isValid()) {
                // Pega a entidade já com os dados do form hidratados (vide CampaignForm)
                $entity = $this->form->getData();

                // Cria o contato no BD
                $this->repository->create($entity);

                // Atribui uma flash Message
                $flash = $request->getAttribute('flash');
                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, 'Campanha Cadastrada com sucesso');

                // Pega a uri da listagem
                $uri = $this->router->generateUri('campaign.list');

                // Redireciona para a listagem
                return new RedirectResponse($uri);
            }
        }

        return new HtmlResponse($this->template->render('app::campaign/create', [
            'form' => $this->form
        ]));
    }
}
