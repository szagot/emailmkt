<?php

namespace EmailMKT\Action;

use Doctrine\ORM\EntityManager;
use EmailMKT\Entity\Cliente;
use EmailMKT\Entity\Endereco;
use EmailMKT\TesteDoTwig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TestePageAction
{
    private $template;
    private $manager;

    public function __construct(EntityManager $manager, Template\TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->manager = $manager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Testando banco de dados
        $cliente = new Cliente();
        $cliente->setNome('Daniel Bispo');
        $cliente->setEmail('szagot@gmail.com');
        $cliente->setCpf('304.714.108-88');
        $this->manager->persist($cliente);

        $endereco1 = (new Endereco())->setCliente($cliente);
        $endereco1->setCep('13930-000');
        $endereco1->setCidade('Serra Negra');
        $endereco1->setEstado('SP');
        $endereco1->setLogradouro('Rua Herminio Alves de Godoi');
        $this->manager->persist($endereco1);

        $endereco2 = (new Endereco())->setCliente($cliente);
        $endereco2->setCep('05271-160');
        $endereco2->setCidade('São Paulo');
        $endereco2->setEstado('SP');
        $endereco2->setLogradouro('Rua Floriano Alves da Costa');
        $endereco1->setCliente($cliente);
        $this->manager->persist($endereco2);

        // Atualiza BD
        $this->manager->flush();
        // Atualiza Cliente
        $this->manager->refresh($cliente);

        $data = [
            'teste'       => 'Minha primeira aplicação',
            'minhaClasse' => new TesteDoTwig(),
            'clientes'    => $this->manager->getRepository(Cliente::class)->findAll()
        ];

        return new HtmlResponse($this->template->render('app::teste', $data));
    }
}
