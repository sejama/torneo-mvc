<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Usuario;
use App\Exception\AppException;
use App\Repository\UsuarioRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrarManager
{

    public function __construct(
        private UsuarioRepository $usuarioRepository,
        private ValidadorManager $validadorManager,
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function registrarUsuario(string $username, string $password): void
    {
        try{
            $this->validadorManager->validarUsuario($username, $password);
    
            if ($this->usuarioRepository->findOneBy(['username' => $username])) {
                throw new AppException('El nombre de usuario ya se encuentra registrado');
            }
            $usuario = new Usuario();
            $usuario->setUsername($username);
            $usuario->setRoles(['ROLE_USER']);
            $usuario->setPassword($this->userPasswordHasher->hashPassword($usuario, $password));
    
            $this->usuarioRepository->guardar($usuario);
        }catch(AppException $e){
            throw $e;
        }
    }
}