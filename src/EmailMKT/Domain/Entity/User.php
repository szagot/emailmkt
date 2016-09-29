<?php
/**
 * Entidade de Usuário
 */

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
     * @param mixed $name
     *
     * @return User
     */
    public function setName($name)
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
     * @param mixed $email
     *
     * @return User
     */
    public function setEmail($email)
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
     * @param mixed $password
     *
     * @return User
     */
    public function setPassword($password)
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
        $password = $this->getPlainPassword() ? $this->getPlainPassword() : uniqid();

        // Gera a senha criptografado
        $this->setPassword(password_hash($password, PASSWORD_BCRYPT));
    }

}