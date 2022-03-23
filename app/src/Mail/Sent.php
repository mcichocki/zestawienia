<?php

namespace App\Mail;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Sent
{
    private $logger;
    private $mailer;
    private static $sender = "stanmienia.v2@um.warszawa.pl";
    private static $creator = "m.cichocki@um.warszawa.pl";

    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    public function sendMail(): Response
    {
        $email = (new Email())
        ->from(self::$sender)
        ->to(self::$creator)
        ->subject('Test')
        ->text('Sending emails is fun again!')
        ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
        $this->logger->info('Logger, wysyłanie wiadomości');

        return new Response("Wiadomość została wysłana!", 200);
    }

    public function sendWorkerToSupervisor() 
    {
    }

    public function sendSupervisorToManager() 
    {
    }

}