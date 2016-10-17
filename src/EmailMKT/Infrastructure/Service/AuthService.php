<?php
namespace EmailMKT\Infrastructure\Service;

use EmailMKT\Domain\Entity\User;
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

    /**
     * Autentica os dados de acesso
     *
     * @param $email
     * @param $password
     *
     * @return bool
     */
    public function authenticate(string $email, string $password) : bool
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

    /**
     * Retorna se está autenticado
     *
     * @return bool
     */
    public function isAuth() : bool
    {
        return ! is_null($this->getUser());
    }

    /**
     * Retorna a instância do usuário se tiver autenticado
     */
    public function getUser()
    {
        return $this->authenticationService->getIdentity();
    }

    /**
     * Logout
     */
    public function destroy()
    {
        $this->authenticationService->clearIdentity();
    }
}