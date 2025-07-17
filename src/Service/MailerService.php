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
                Bonjour et bienvenue sur <strong>OrientMada</strong> !<br><br>
                Nous vous remercions pour votre inscription.<br>
                Vous pouvez dès à présent découvrir les formations et opportunités qui vous correspondent.<br><br>
                Pour accéder à votre espace personnel, cliquez sur le lien ci-dessous :<br>
                <a href='http://localhost:5173/login'>Se connecter à mon compte</a><br><br>
                À très bientôt sur OrientMada !<br>
                Cordialement,<br>
                L’équipe OrientMada<br><br>
                &copy; OrientMada 2025. Tous droits réservés.
            ");

        $this->mailer->send($email);
    }
}
