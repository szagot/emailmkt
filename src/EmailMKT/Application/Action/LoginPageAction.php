<?php

namespace EmailMKT\Application\Action;

use EmailMKT\Application\Form\LoginForm;
use EmailMKT\Domain\Service\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginPageAction
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var TemplateRendererInterface
     */
    private $template;
    /**
     * @var LoginForm
     */
    private $form;
    /**
     * @var AuthInterface
     */
    private $authService;

    public function __construct(
        RouterInterface $router,
        TemplateRendererInterface $template,
        LoginForm $form,
        AuthInterface $authService
    ) {
        $this->template = $template;
        $this->router = $router;
        $this->form = $form;
        $this->authService = $authService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $templateData = [
            'form' => $this->form
        ];

        // Teve postagem?
        if ($request->getMethod() == 'POST') {
            $dataRaw = $request->getParsedBody();
            $this->form->setData($dataRaw);

            // Form válido?
            if ($this->form->isValid()) {
                $user = $this->form->getData();

                // Está autenticado?
                if ($this->authService->authenticate($user[ 'email' ], $user[ 'password' ])) {
                    // Pega a uri da listagem
                    $uri = $this->router->generateUri('customers.list');

                    // Redireciona para a listagem
                    return new RedirectResponse($uri);
                }

                $templateData['msg'] = 'Usuário e/ou senha inválidos';
                $templateData['msgError'] = true;
            }
        }

        return new HtmlResponse($this->template->render('app::login', $templateData));
    }
}
