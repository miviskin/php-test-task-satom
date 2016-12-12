<?php

namespace Miviskin\Form;

abstract class AbstractForm
{
    /**
     * @var array
     */
    protected $errors;

    /**
     * Validate form.
     *
     * @return $this
     */
    public function validate()
    {
        $this->errors = [];

        if (!is_array($validators = $this->getValidators())) {
            throw new Exception\FormException(
                sprintf('Validators is not array in %s form.', get_class($this))
            );
        }

        $properties = get_object_vars($this);

        foreach ($validators as $property => $validator) {
            if (array_key_exists($property, $properties)) {
                if ($error = $validator->validate($this->$property)) {
                    $this->errors[$property] = is_array($error) ? $error : [$error];
                }
            }
        }

        return $this;
    }

    /**
     * Check is form valid.
     *
     * @return bool
     */
    public function isValid()
    {
        return !count($this->getErrors());
    }

    /**
     * Get form errors.
     *
     * @return mixed
     */
    public function getErrors()
    {
        if ($this->errors === null) {
            $this->validate();
        }

        return $this->errors;
    }

    /**
     * Get form validators.
     *
     * @return array
     */
    abstract public function getValidators();
}
