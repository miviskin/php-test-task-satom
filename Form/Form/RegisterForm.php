<?php

namespace Miviskin\Form\Form;

use Miviskin\Form\AbstractForm;
use Miviskin\Validator\Validator;

class RegisterForm extends AbstractForm
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
     * @var string
     */
    protected $age;

    /**
     * @var string
     */
    protected $email;

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
            'age' => new Validator\Type('numeric'),
            'email' => new Validator\Email(),
        ];
    }

    /**
     * Set username.
     *
     * @param string $username
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
     * @param string $password
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

    /**
     * Set age.
     *
     * @param string $age
     * @return $this
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age.
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
