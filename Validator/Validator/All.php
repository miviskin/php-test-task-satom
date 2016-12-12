<?php

namespace Miviskin\Validator\Validator;

use Miviskin\Validator\AbstractValidator;

class All extends AbstractValidator
{
    /**
     * @var array
     */
    protected $validators = [];

    /**
     * Validate value.
     *
     * @param mixed $value
     * @return mixed
     */
    public function validate($value)
    {
        $errors = [];

        foreach ($this->validators as $validator) {
            $error = $validator->validate($value);

            if ($error !== null) {
                $errors = array_merge($errors, is_array($error) ? $error : [$error]);
            }
        }

        if (count($errors)) {
            return $errors;
        }
    }

    /**
     * Return required options names.
     *
     * @return array
     */
    public function getRequiredOptions()
    {
        return ['validators'];
    }

    /**
     * Return default option name.
     *
     * @return string
     */
    public function getDefaultOption()
    {
        return 'validators';
    }
}
