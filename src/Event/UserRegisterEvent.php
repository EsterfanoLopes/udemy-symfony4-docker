<?php
/**
 * Created by PhpStorm.
 * User: esterfano
 * Date: 27/11/18
 * Time: 15:25
 */

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserRegisterEvent extends Event
{
    const NAME = 'user.register';
    /**
     * @var User
     */
    private $registeredUser;

    public function __construct(User $registeredUser)
    {
        $this->registeredUser = $registeredUser;
    }
}