<?php
namespace App\Service;

use App\Repository\UserRepository;
use App\Repository\InstitutionsRepository;

class ChatParticipantResolver
{
    private UserRepository $userRepository;
    private InstitutionsRepository $institutionsRepository;

    public function __construct(UserRepository $userRepository, InstitutionsRepository $institutionsRepository)
    {
        $this->userRepository = $userRepository;
        $this->institutionsRepository = $institutionsRepository;
    }

    /**
     * Résout un participant à partir d'une chaîne de type 'user:5' ou 'institute:3'.
     * Retourne l'objet User ou Institutions correspondant, ou null si non trouvé.
     */
    public function resolve(?string $participant): ?object
    {
        if (!$participant) {
            return null;
        }
        $parts = explode(':', $participant);
        if (count($parts) !== 2) {
            return null;
        }
        [$type, $id] = $parts;
        if ($type === 'user') {
            return $this->userRepository->find($id);
        } elseif ($type === 'institute') {
            return $this->institutionsRepository->find($id);
        }
        return null;
    }
} 