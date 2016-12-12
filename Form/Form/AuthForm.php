<?php

namespace Miviskin\Form\Form;

use Miviskin\Form\AbstractForm;
use Miviskin\Validator\Validator;

class AuthForm extends AbstractForm
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * Get form validators.
     *
     * @return array
     */
    public function getValidators()
    {
        return [
            'username' => new Validator\All([
                new Validator\NotBlank(),
                new Validator\Type('string'),
                new Validator\Length(['min' => 3, 'max' => 10])
            ]),
            'password' => new Validator\All([
                new Validator\NotBlank(),
                new Validator\Type('string'),
                new Validator\Length(['min' => 5])
            ]),
        ];
    }

    /**
     * Set username.
     *
     * @param $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
