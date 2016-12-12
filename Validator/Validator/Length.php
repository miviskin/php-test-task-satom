<?php

namespace Miviskin\Validator\Validator;

use Miviskin\Validator\AbstractValidator;
use Miviskin\Validator\Exception;

class Length extends AbstractValidator
{
    /**
     * @var string
     */
    protected $charsetMessage = 'This value does not match the expected charset.';
    protected $maxMessage = 'This value is too long.';
    protected $minMessage = 'This value is too short.';
    protected $charset = 'UTF-8';
    protected $max;
    protected $min;

    /**
     * Length constructor.
     *
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        if ($options !== null && !is_array($options)) {
            $options = [
                'min' => $options,
                'max' => $options,
            ];
        }

        parent::__construct($options);

        if ($this->min === null && $this->max === null) {
            throw new Exception\MissingOptionsException(
                sprintf('Either option "min" or "max" must be given for constraint %s', get_class($this))
            );
        }
    }

    /**
     * Validate value.
     *
     * @param mixed $value
     * @return mixed
     */
    public function validate($value)
    {
        if ($value === null || $value === '') {
            return;
        }

        $value = (string) $value;

        if (mb_check_encoding($value, $this->charset)) {
            $length = mb_strlen($value, $this->charset);
        } else {
            return $this->charsetMessage;
        }

        if ($this->max !== null && $length > $this->max) {
            return $this->maxMessage;
        }

        if ($this->min !== null && $length < $this->min) {
            return $this->minMessage;
        }
    }
}
