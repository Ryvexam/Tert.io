<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class LegalController extends AbstractController
{
    #[Route("/mentions-legales", name: "legal_mentions")]
    public function index()
    {
        return $this->render("mentions.html.twig");
    }
}
