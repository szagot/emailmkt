<?php

namespace EmailMKT\Application\Action;

use EmailMKT\Application\Form\LoginForm;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class LoginPageAction
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
     * @var LoginForm
     */
    private $form;

    public function __construct(
        CustomerRepositoryInterface $repository,
        TemplateRendererInterface $template,
        LoginForm $form
    ) {
        $this->template = $template;
        $this->repository = $repository;
        $this->form = $form;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Teve postagem?
        if ($request->getMethod() == 'POST') {
            $dataRaw = $request->getParsedBody();
            $this->form->setData($dataRaw);

            // Form válido?
            if ($this->form->isValid()) {

            }
        }

        return new HtmlResponse($this->template->render('app::login', [
            'form' => $this->form
        ]));
    }
}
