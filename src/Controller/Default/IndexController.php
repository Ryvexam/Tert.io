<?php

namespace App\Controller\Default;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route("/", name: "app_home")]
    public function index(): Response
    {
        $randomClients = $this->getRandomClients();
        return $this->render("Default/index.html.twig", [
            'randomClients' => $randomClients
        ]);
    }

    private function getRandomClients(): array
    {
        $clientsDirectory = $this->getParameter('kernel.project_dir') . '/public/assets/img/clients/';
        $clientImages = glob($clientsDirectory . '*.png');

        $clientImages = array_map(function($path) {
            return 'assets/img/clients/' . basename($path);
        }, $clientImages);

        shuffle($clientImages);
        return $clientImages;
    }
}