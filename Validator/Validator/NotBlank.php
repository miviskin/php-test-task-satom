<?php

namespace Miviskin\Validator\Validator;

use Miviskin\Validator\AbstractValidator;

class NotBlank extends AbstractValidator
{
    /**
     * @var string
     */
    protected $message = 'This value should not be blank.';

    /**
     * Validate value.
     *
     * @param mixed $value
     * @return mixed
     */
    public function validate($value)
    {
        if ($value === false || (empty($value) && $value !== '0')) {
            return $this->message;
        }
    }
}
