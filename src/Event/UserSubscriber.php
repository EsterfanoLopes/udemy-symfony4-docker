<?php
/**
 * Created by PhpStorm.
 * User: esterfano
 * Date: 27/11/18
 * Time: 15:31
 */

namespace App\Event;

use App\Entity\UserPreferences;
use App\Mailer\MailerClass;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{
    /*** @var MailerClass */
    private $mailer;

    /** @var EntityManagerInterface */
    private $entityManager;
    /*** @var string */
    private $defaultLocale;

    public function __construct(MailerClass $mailer, EntityManagerInterface $entityManager, string $defaultLocale)
    {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
        $this->defaultLocale = $defaultLocale;
    }

    public static function getSubscribedEvents()
    {
        return [
            UserRegisterEvent::NAME => 'onUserRegister'
        ];
    }

    public function onUserRegister(UserRegisterEvent $event)
    {
        $preferences = new UserPreferences();
        $preferences->setLocale($this->defaultLocale);

        $user = $event->getRegisteredUser();
        $user->setPreferences($preferences);

        $this->entityManager->flush();

        $this->mailer->sendConfirmationEmail($event->getRegisteredUser());
    }
}