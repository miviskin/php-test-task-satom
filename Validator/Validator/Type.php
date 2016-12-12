<?php

namespace Miviskin\Validator\Validator;

use Miviskin\Validator\AbstractValidator;

class Type extends AbstractValidator
{
    /**
     * @var string
     */
    protected $message = 'Invalid value type.';

    /**
     * @var string
     */
    protected $type;

    /**
     * Validate value.
     *
     * @param mixed $value
     * @return mixed
     */
    public function validate($value)
    {
        if ($value === null) {
            return;
        }

        $type = strtolower($this->type) == 'boolean' ? 'bool' : $this->type;
        $isFunction = 'is_' . $type;
        $ctypeFunction = 'ctype_' . $type;

        if (function_exists($isFunction) && $isFunction($value)) {
            return;
        } elseif (function_exists($ctypeFunction) && $ctypeFunction($value)) {
            return;
        } elseif ($value instanceof $this->type) {
            return;
        }

        return $this->message;
    }

    /**
     * Return required options names.
     *
     * @return array
     */
    public function getRequiredOptions()
    {
        return ['type'];
    }

    /**
     * Return default option name.
     *
     * @return string
     */
    public function getDefaultOption()
    {
        return 'type';
    }
}
