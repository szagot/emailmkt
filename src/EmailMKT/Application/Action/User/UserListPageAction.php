<?php

namespace EmailMKT\Application\Action\User;

use EmailMKT\Domain\Persistence\UserRepositoryInterface;
use EmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class UserListPageAction
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * @var TemplateRendererInterface
     */
    private $template;

    public function __construct(UserRepositoryInterface $repository, TemplateRendererInterface $template)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Pegando campo a ser ordenado e tipo de ordenação
        $orderField = $request->getAttribute('order');
        $orderType = $request->getAttribute('type');

        // Pegando todos os Contatos
        $users = $this->repository->findAll($orderField, $orderType);

        // Pega tipo Mensagem
        $eErro = ! empty($request->getAttribute('flash')->getMessage(FlashMessageInterface::MESSAGE_ERROR));
        $msg = $eErro ?
            $request->getAttribute('flash')->getMessage(FlashMessageInterface::MESSAGE_ERROR) :
            $request->getAttribute('flash')->getMessage(FlashMessageInterface::MESSAGE_SUCCESS);

        $data = [
            'users'    => $users,
            'msg'      => $msg,
            'msgError' => $eErro,
            'order'    => [
                'field' => $orderField,
                'type'  => $orderType,
            ]
        ];

        return new HtmlResponse($this->template->render('app::user/list', $data));
    }
}
