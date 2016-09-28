<?php
namespace EmailMKT\Domain\Service;

use EmailMKT\Domain\Entity\User;

interface AuthInterface
{
    /**
     * Autentica usuário
     *
     * @param $email
     * @param $password
     *
     * @return boolean
     */
    public function authenticate($email, $password);

    /**
     * Verifica se está autenticado
     *
     * @return boolean
     */
    public function isAuth();

    /**
     * Pega a entidade autenticada
     *
     * @return \EmailMKT\Domain\Entity\User
     */
    public function getUser();

    /**
     * Destrói a autenticação (logout)
     */
    public function destroy();
}