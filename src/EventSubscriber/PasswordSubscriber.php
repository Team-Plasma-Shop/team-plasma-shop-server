<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsDoctrineListener(event: Events::prePersist)]
class PasswordSubscriber
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasherInterface){
;
    }
    public function prePersist(LifecycleEventArgs $lifecycleEventArgs): void{
        $user = $lifecycleEventArgs->getObject();
        if(!$user instanceof User){
            return;
        }
        $user->setPassword($this->userPasswordHasherInterface->hashPassword($user, $user->getPassword()));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['hashPassword', EventPriorities::PRE_WRITE],
        ];
    }
}
