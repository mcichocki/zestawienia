<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{
    /**
     * @Route("/messages/dashboard", name="messages_dashboard")
     */
    public function dashboard()
    {
        return $this->render("wiadomosci/dashboard.html.twig");
    }
}