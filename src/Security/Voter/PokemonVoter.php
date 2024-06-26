<?php

namespace App\Security\Voter;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PokemonVoter extends Voter
{
    public const EDIT = 'POST_EDIT';
    public const POKEMON_VIEW = 'POKEMON_VIEW';

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::POKEMON_VIEW])
            && $subject instanceof \App\Entity\Pokemon;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {

            case self::EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                return true;
                break;
            case self::POKEMON_VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                if($this->security->isGranted('ROLE_USER')) {return true;}
                break;
        }

        return false;
    }
}
