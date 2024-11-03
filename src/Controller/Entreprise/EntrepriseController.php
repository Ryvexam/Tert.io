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
                'position' => 'Gérant et fondateur de l’entreprise',
                'image' => 'dominique.webp',
                'description' => 'Dans l’entreprise depuis 1996'
            ],
            [
                'name' => 'Quentin FOUSE',
                'position' => 'Responsable technique, associé',
                'image' => 'quentin.webp',
                'description' => 'Dans l’entreprise depuis 2014'
            ],
            [
                'name' => 'Alexandre DRIESSENS',
                'position' => 'Technicien de maintenance informatique',
                'image' => 'alexandre.webp',
                'description' => 'Dans l’entreprise depuis 2022'
            ],
            [
                'name' => 'Emmanuelle PINEL',
                'position' => 'Assistante',
                'image' => 'emmanuelle.webp',
                'description' => 'Dans l’entreprise depuis 2019'
            ],
            [
                'name' => 'Isabelle DODAT',
                'position' => 'Formatrice et référente sur les logiciels SAGE et EBP',
                'image' => 'isabelle.webp',
                'description' => 'Dans l’entreprise depuis 2021'
            ],
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