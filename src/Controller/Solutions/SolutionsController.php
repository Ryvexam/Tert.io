<?php

namespace App\Controller\Solutions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/solutions")]

class SolutionsController extends AbstractController
{
    #[Route("/informatiques-reseaux", name: "app_informatique_reseaux")]
    function infra()
    {
        return $this->render("Solutions/informatique_reseaux.html.twig");
    }
    #[Route("/securite", name: "app_securite")]
    function securite()
    {
        return $this->render("Solutions/securite.html.twig");
    }
    #[Route("/cloud-hybride", name: "app_cloud_hybride")]
    function cloudhybride()
    {
        return $this->render("Solutions/cloud-hybride.html.twig");
    }
    #[Route("/sur-mesure", name: "app_sur_mesure")]
    function surmesure()
    {
        return $this->render("Solutions/sur-mesure.html.twig");
    }
    #[Route("/audit-conseil", name: "app_audit_conseil")]
    function auditconseil()
    {
        return $this->render("Solutions/audit.html.twig");
    }
    #[Route("/solutions-logicielles", name: "app_logicielles")]
    function logicielles()
    {
        return $this->render("Solutions/logiciels.html.twig");
    }
}