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

        # SwiftMailer mock tests
        $swiftMailerMock = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();
        $swiftMailerMock->expects($this->once())
            ->method('send')
            ->with($this->callback(function($subject) {
                $messageString = (string)$subject;

                return strpos($messageString, "From: me@from.me") !== false
                    && strpos($messageString, "Content-Type: text/html; charset=utf-8") !== false
                    && strpos($messageString, "Subject: Welcome to the micro-post app!") !== false
                    && strpos($messageString, "To: john@mail.com") !== false
                    && strpos($messageString, "This is a message body") !== false;
            }));

        # Twig mock tests
        $twigMock = $this->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->getMock();
        $twigMock->expects($this->once())
            ->method('render')
            ->with('email/registration.html.twig',
                [
                    'user' => $user,
                ]
            )->willReturn('This is a message body');

        $mailer = new MailerClass($swiftMailerMock, $twigMock, "me@from.me");
        $mailer->sendConfirmationEmail($user);
    }
}