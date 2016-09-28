<?php
namespace EmailMKT\Infrastructure\Service;

use EmailMKT\Domain\Service\AuthInterface;
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
        // TODO: Implement authenticate() method.
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