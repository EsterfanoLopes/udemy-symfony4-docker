<?php
/**
 * Created by PhpStorm.
 * User: esterfano
 * Date: 28/11/18
 * Time: 15:01
 */

namespace App\Tests\Mailer;

use App\Entity\User;
use App\Mailer\MailerClass;
use PHPUnit\Framework\TestCase;

class MailerClassTest extends TestCase
{
    public function testConfirmationEmail()
    {
        $user = new User();
        $user->setEmail('john@mail.com');

        $swiftMailer = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $twigMock = $this->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mailer = new MailerClass($swiftMailer, $twigMock, $user->getEmail());
        $mailer->sendConfirmationEmail($user);
    }
}