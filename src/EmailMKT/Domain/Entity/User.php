<?php
/**
 * Entidade de Usuário
 */

// Indica ao PHP para trabalhar no modo tipado.
// Isto é, quando indicado um tipo de variável ele deve ser obedecido.
declare(strict_types = 1);

namespace EmailMKT\Domain\Entity;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;

    /** @var string Senha sem criptografar - não será persistido no BD */
    private $plainPassword;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return User
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }


    /**
     * Gera a senha, nova (aleatória) ou apenas criptografa
     * Esse método deve ser chamado via callback antes de se persistir os dados no  BD
     */
    public function generatePassword()
    {
        // Pega a senha digitada ou gera uma senha aleatória
        $password = $this->getPlainPassword() ?? uniqid();

        // Gera a senha criptografado
        $this->setPassword(password_hash($password, PASSWORD_BCRYPT));
    }

}