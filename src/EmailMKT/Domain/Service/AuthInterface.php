<?php
// Indica ao PHP para trabalhar no modo tipado.
// Isto é, quando indicado um tipo de variável ele deve ser obedecido.
declare(strict_types = 1);

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
    public function authenticate(string $email, string $password) : bool;

    /**
     * Verifica se está autenticado
     *
     * @return boolean
     */
    public function isAuth() : bool;

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