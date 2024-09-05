<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

/**
 * Class LoginSubscriber.
 */
class LoginSubscriber implements EventSubscriberInterface
{
    /**
     * @param LoginSuccessEvent $event
     * @param UserRepository    $userRepository
     *
     * @return void
     */
    public function onLoginSuccess(LoginSuccessEvent $event, UserRepository $userRepository): void
    {
        $user = $event->getUser();
        if ($user instanceof User) {
            $user->setLastLogin(new \DateTime());
            $userRepository->save($user);
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => 'onLoginSuccess',
        ];
    }
}
