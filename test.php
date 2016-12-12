<?php

namespace Miviskin;

use Miviskin\Form\Form;

require_once __DIR__.'/vendor/autoload.php';

echo PHP_EOL, 'Validate AuthForm', PHP_EOL;

$authForm = (new Form\AuthForm)
    ->setPassword('testPassword')
    ->setUsername('Username');

if ($authForm->isValid()) {
    echo 'AuthForm is valid.', PHP_EOL;
} else {
    foreach ($authForm->getErrors() as $property => $errors) {
        echo $property, ':', implode('; ', $errors), PHP_EOL;
    }
}

echo PHP_EOL, 'Validate RegisterForm', PHP_EOL;

$registerForm = (new Form\RegisterForm)
    ->setPassword('testPassword')
    ->setUsername('Username')
    ->setEmail('mail@mail.ru')
    ->setAge(30);

if ($registerForm->isValid()) {
    echo 'RegisterForm is valid.', PHP_EOL;
} else {
    foreach ($registerForm->getErrors() as $property => $errors) {
        echo $property, ':', implode('; ', $errors), PHP_EOL;
    }
}

echo PHP_EOL;
