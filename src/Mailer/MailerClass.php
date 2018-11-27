<?php
/**
 * Created by PhpStorm.
 * User: esterfano
 * Date: 27/11/18
 * Time: 16:37
 */

namespace App\Mailer;

use App\Entity\User;

class MailerClass
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /** @var string  */
    private $mailFrom;

    public function __construct(\Swift_Mailer $swift_Mailer, \Twig_Environment $twig_Environment, string $mailFrom)
    {
        $this->mailer = $swift_Mailer;
        $this->twig = $twig_Environment;
        $this->mailFrom = $mailFrom;
    }

    public function sendConfirmationEmail(User $user)
    {
        $body = $this->twig->render('email/registration.html.twig', [
            'user' => $user
        ]);

        $message = (new \Swift_Message())
            ->setSubject("Welcome to the micro-post app!")
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}