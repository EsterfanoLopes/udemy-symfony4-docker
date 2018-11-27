<?php
/**
 * Created by PhpStorm.
 * User: esterfano
 * Date: 27/11/18
 * Time: 15:31
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            UserRegisterEvent::NAME => 'onUserRegister'
        ];
    }

    public function onUserRegister(UserRegisterEvent $event)
    {

    }
}