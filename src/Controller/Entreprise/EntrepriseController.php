<?php

namespace App\Controller\Entreprise;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/entreprise")]
class EntrepriseController extends AbstractController
{
    #[Route("/historique", name: "app_historique")]
    function historique()
    {
        return $this->render("Entreprise/historique.html.twig");
    }

    #[Route("/equipe", name: "app_equipe")]
    public function equipe()
    {
        $teamMembers = [
            [
                'name' => 'Dominique MAUREL',
                'position' => 'à définir',
                'image' => 'dominique.jpg',
                'description' => 'Texte à définir'
            ],
            [
                'name' => 'Quentin FOUSE',
                'position' => 'à définir',
                'image' => 'quentin.jpg',
                'description' => 'Texte à définir'
            ],
            [
                'name' => 'Alexandre DRIESSENS',
                'position' => 'à définir',
                'image' => 'alexandre.jpg',
                'description' => 'Texte à définir'
            ],
            [
                'name' => 'Isabelle DODAT',
                'position' => 'à définir',
                'image' => 'isabelle.jpg',
                'description' => 'Texte à définir'
            ],
            [
                'name' => 'Emmanuelle PINEL',
                'position' => 'à définir',
                'image' => 'emmanuelle.jpg',
                'description' => 'Texte à définir'
            ]
        ];

        return $this->render("Entreprise/equipe.html.twig", [
            'team_members' => $teamMembers
        ]);
    }
    #[Route("/certifications", name: "app_certifications")]
    function certifications()
    {
        return $this->render("Entreprise/certifications.html.twig");
    }
}