<?php

namespace App\Service;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\User;

class MailerService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function mailBienvenue(User $user): void
    {
        $email = (new Email())
            ->from('orientmada@gmail.com')
            ->to($user->getEmail())
            ->subject('Bienvenue sur OrientMada')
            ->html("
                Bonjour,<br><br>
                Merci de t’être inscrit sur <strong>OrientMada</strong> !<br>
                Découvre maintenant les formations faites pour toi ✨<br><br>
                <a href='http://localhost:5173/login'>Se connecter</a><br><br>
                À bientôt !
            ");

        $this->mailer->send($email);
    }
}
