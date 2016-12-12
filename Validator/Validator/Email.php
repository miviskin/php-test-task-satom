<?php

namespace Miviskin\Validator\Validator;

use Miviskin\Validator\AbstractValidator;

class Email extends AbstractValidator
{
    /**
     * @var string
     */
    protected $message = 'This value is not a valid email address.';
    protected $checkHost = false;
    protected $checkMX = false;

    /**
     * Validate value.
     *
     * @param mixed $value
     * @return mixed
     */
    public function validate($value)
    {
        if (null === $value || '' === $value) {
            return;
        }

        $value = (string) $value;

        if (!preg_match('/^.+\@\S+\.\S+$/', $value)) {
            return $this->message;
        }

        $host = substr($value, strrpos($value, '@') + 1);

        // Check for host DNS resource records
        if ($this->checkMX && !$this->checkMX($host)) {
            return $this->message;
        }

        if ($this->checkHost && !$this->checkHost($host)) {
            return $this->message;
        }
    }

    /**
     * Check DNS Records for MX type.
     *
     * @param string $host Host
     *
     * @return bool
     */
    protected function checkMX($host)
    {
        return checkdnsrr($host, 'MX');
    }

    /**
     * Check if one of MX, A or AAAA DNS RR exists.
     *
     * @param string $host Host
     *
     * @return bool
     */
    protected function checkHost($host)
    {
        return $this->checkMX($host) || (checkdnsrr($host, 'A') || checkdnsrr($host, 'AAAA'));
    }
}
