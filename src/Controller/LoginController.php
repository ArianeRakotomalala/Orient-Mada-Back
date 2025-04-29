<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface as JWTManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class LoginController extends AbstractController
{
    private $jwtManager;
    private $passwordHasher;
    private $entityManager;

    //Injection de dépendance
    //on injecte le service JWTManager, UserPasswordHasherInterface et EntityManagerInterface pour gérer le JWT,
    // le hachage de mot de passe et la gestion des entités
    //au lieu d'ecrire le code de chaque service dans le controller, on les injecte
    //cela permet de rendre le code plus propre et plus facile à maintenir
    public function __construct(JWTManager $jwtManager, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        $this->jwtManager = $jwtManager;
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }
    //ENDPOINT POUR LA CONNEXION 
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login()
    {
        $credentials = [
            'email' => 'arianerakotomalala@gmail.com',
            'password' => 'ariane1234',
        ];

        if (empty($credentials['email']) || empty($credentials['password'])) {
            return new JsonResponse(['message' => 'Email or password missing'], 400);
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $credentials['email']]);

        if (!$user) {
            return new JsonResponse(['message' => 'Invalid email or password'], 401);
        }

        if (!$this->passwordHasher->isPasswordValid($user, $credentials['password'])) {
            return new JsonResponse(['message' => 'Invalid email or password'], 401);
        }

        $token = $this->jwtManager->create($user);

        return new JsonResponse(['token' => $token], 200);
    }
}
