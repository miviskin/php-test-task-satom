<?php

namespace Miviskin\Validator;

abstract class AbstractValidator
{
    /**
     * AbstractValidator constructor.
     *
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        $knownOptions = get_object_vars($this);
        $requiredOptions = array_flip((array) $this->getRequiredOptions());

        if (is_array($options) && count($options) && is_string(key($options))) {
            foreach ($options as $option => $value) {
                if (array_key_exists($option, $knownOptions)) {
                    $this->$option = $value;
                    unset($requiredOptions[$option]);
                }
            }
        } elseif ($options !== null && !(is_array($options) && count($options) === 0)) {
            $option = $this->getDefaultOption();

            if ($option === null) {
                throw new Exception\ValidatorException(
                    sprintf('Default option is not configured in %s', get_class($this))
                );
            }

            if (array_key_exists($option, $knownOptions)) {
                $this->$option = $options;
                unset($requiredOptions[$option]);
            }
        }

        if (count($requiredOptions)) {
            throw new Exception\MissingOptionsException(
                sprintf('The options "%s" must be set for %s', implode('", "', array_keys($requiredOptions)), get_class($this))
            );
        }
    }

    /**
     * Return required options names.
     *
     * @return array
     */
    public function getRequiredOptions()
    {
        return [];
    }

    /**
     * Return default option name.
     *
     * @return string
     */
    public function getDefaultOption()
    {
    }

    /**
     * Validate value.
     *
     * @param mixed $value
     * @return mixed
     */
    abstract public function validate($value);
}
