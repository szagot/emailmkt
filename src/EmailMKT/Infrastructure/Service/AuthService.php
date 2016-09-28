<?php
namespace EmailMKT\Infrastructure\Service;

use EmailMKT\Domain\Service\AuthInterface;
use Zend\Authentication\Adapter\ValidatableAdapterInterface;
use Zend\Authentication\AuthenticationService;

class AuthService implements AuthInterface
{
    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function authenticate($email, $password)
    {
        /**
         * Adaptador de validação de dados
         *
         * @var ValidatableAdapterInterface $adapter
         */
        $adapter = $this->authenticationService->getAdapter();

        // Atribuindo dados passados
        $adapter->setIdentity($email);
        $adapter->setCredential($password);

        // Verificando autenticação
        $result = $this->authenticationService->authenticate();

        // Retornando se foi validado
        return $result->isValid();
    }

    public function isAuth()
    {
        // TODO: Implement isAuth() method.
    }

    public function getUser()
    {
        // TODO: Implement getUser() method.
    }

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }
}