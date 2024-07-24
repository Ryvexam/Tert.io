<?php

namespace App\Controller\Formation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/ICDL-PCIE")]
class ICDLController extends AbstractController
{
    #[Route("/presentation", name: "app_icdl_presentation")]
    function icdl_presentation()
    {
        return $this->render("Formation/icdl_presentation.html.twig");
    }
    #[Route("/modules", name: "app_icdl_modules")]
    function icdl_modules()
    {
        return $this->render("Formation/icdl_modules.html.twig");
    }
    #[Route("/inscriptions", name: "app_icdl_inscriptions")]
    function icdl_inscriptions()
    {
        return $this->render("Formation/icdl_inscriptions.html.twig");
    }

    #[Route("/resultats", name: "app_icdl_resultats")]
    function icdl_resultats()
    {
        return $this->render("Formation/icdl_resultats.html.twig");
    }
}
