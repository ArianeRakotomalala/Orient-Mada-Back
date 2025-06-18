<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

class JWTLoginSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $data = $event->getData();

        if ($user instanceof User) {
            $data['user'] = [
                'id'=>$user->getId(),
                'email' => $user->getUserIdentifier(),
                'roles' => $user->getRoles(),
                'telephone' => $user->getTelephone(),
                // 'userProfils' => $user->getUserProfils()?->getId(),
            ];
        }

        $event->setData($data);
    }
}
