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
        $endereco = new Endereco();
        $endereco->setCep('13930-000');
        $endereco->setCidade('Serra Negra');
        $endereco->setEstado('SP');
        $endereco->setLogradouro('Rua Herminio Alves de Godoi');
        $this->manager->persist($endereco);

        $cliente1 = new Cliente();
        $cliente1->setNome('Daniel Bispo');
        $cliente1->setEmail('szagot@gmail.com');
        $cliente1->setCpf('304.714.108-88');
        $cliente1->setEndereco($endereco);

        $cliente2 = new Cliente();
        $cliente2->setNome('Alini Bispo');
        $cliente2->setEmail('alini_bispo@hotmail.com');
        $cliente2->setEndereco($endereco);

        $this->manager->persist($cliente1);
        $this->manager->persist($cliente2);

        // Atualiza BD
        $this->manager->flush();

        $data = [
            'teste'       => 'Minha primeira aplicação',
            'minhaClasse' => new TesteDoTwig(),
            'clientes'    => $this->manager->getRepository(Cliente::class)->findAll()
        ];

        return new HtmlResponse($this->template->render('app::teste', $data));
    }
}
