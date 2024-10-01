<?php

declare(strict_types=1);

namespace App\Manager;

use App\Exception\AppException;

class ValidadorManager
{
    public function validarUsuario($username, $password): void
    {
        if (strlen($username) < 4 || strlen($username) > 128) {
            throw new AppException('El nombre de usuario debe tener entre 4 y 128 caracteres');
        }

        if (false !== strpos($username, ' ')) {
            throw new AppException('El Usuario ingresado no puede contener espacios');
        }

        if ($username === $password) {
            throw new AppException('El nombre de usuario y la contraseña no pueden ser iguales');
        }

        if (strlen($password) < 5 || strlen($password) > 255) {
            throw new AppException('La contraseña debe tener entre 5 y 255 caracteres');
        }



    }
}