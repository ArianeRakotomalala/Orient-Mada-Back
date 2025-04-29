<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegisterController extends AbstractController{
    #[Route('/api/register', name: 'register', methods: ['POST'])]
    public function register( Request $request ,UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $em): JsonResponse {
        // $data = json_decode($request->getContent(), true);

        $user = new User();
        
        $user->setEmail('arianerakotomalala@gmail.com');
        $user->setRoles(['ROLE_ADMIN']); 
        $pass='ariane1234';
        $user->setPassword(
            $passwordHasher->hashPassword($user, $pass)
        );

        $em->persist($user);
        $em->flush();

        return new JsonResponse(['message' => 'User created with sucess !!!!!!!!'], 201);
    }
}
