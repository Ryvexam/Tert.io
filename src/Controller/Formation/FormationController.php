<?php

namespace App\Controller\Formation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/formations")]
class FormationController extends AbstractController
{

    #[Route("/accueil", name: "app_formations")]
    function formations()
    {
        return $this->render("Formation/formations.html.twig");
    }
    #[Route("/organisme-formations", name: "app_organisme_formations")]
    function orgaformations()
    {
        return $this->render("Formation/organisme.html.twig");
    }
    #[Route("/moyens-et-methode", name: "app_moyensetmethodes")]
    function moyensetmethode()
    {
        return $this->render("Formation/moyensetmethodes.html.twig");
    }
    #[Route("/nos-resultats", name: "app_nosresultat")]
    function resultats()
    {
        return $this->render("Formation/nosresultats.html.twig");
    }


    // Bureautique
    #[Route("/bureautique/traitement-texte-base", name: "app_bureautiques_traitement_texte_base")]
    function traitementTexteBase()
    {
        return $this->render("Formation/Bureautique/traitement_texte_base.html.twig");
    }

    #[Route("/bureautique/traitement-texte-perfectionnement", name: "app_bureautiques_traitement_texte_perfectionnement")]
    function traitementTextePerfectionnement()
    {
        return $this->render("Formation/Bureautique/traitement_texte_perfectionnement.html.twig");
    }

    #[Route("/bureautique/traitement-texte-fusion-publipostage", name: "app_bureautiques_traitement_texte_fusion_publipostage")]
    function traitementTexteFusionPublipostage()
    {
        return $this->render("Formation/Bureautique/traitement_texte_fusion_publipostage.html.twig");
    }

    #[Route("/bureautique/powerpoint", name: "app_bureautiques_powerpoint")]
    function powerpoint()
    {
        return $this->render("Formation/Bureautique/powerpoint.html.twig");
    }

    #[Route("/bureautique/navigation-internet-messagerie", name: "app_bureautiques_navigation_internet_messagerie")]
    function navigationInternetMessagerie()
    {
        return $this->render("Formation/Bureautique/navigation_internet_messagerie.html.twig");
    }

    #[Route("/bureautique/outlook", name: "app_bureautiques_outlook")]
    function outlook()
    {
        return $this->render("Formation/Bureautique/outlook.html.twig");
    }

    #[Route("/bureautique/microsoft-365", name: "app_bureautiques_microsoft_365")]
    function microsoft365()
    {
        return $this->render("Formation/Bureautique/microsoft_365.html.twig");
    }

    #[Route("/bureautique/teams", name: "app_bureautiques_teams")]
    function teams()
    {
        return $this->render("Formation/Bureautique/teams.html.twig");
    }

    #[Route("/bureautique/excel-base", name: "app_bureautiques_excel_base")]
    function excelBase()
    {
        return $this->render("Formation/Bureautique/excel_base.html.twig");
    }

    #[Route("/bureautique/excel-perfectionnement", name: "app_bureautiques_excel_perfectionnement")]
    function excelPerfectionnement()
    {
        return $this->render("Formation/Bureautique/excel_perfectionnement.html.twig");
    }

    #[Route("/bureautique/excel-expert", name: "app_bureautiques_excel_expert")]
    function excelExpert()
    {
        return $this->render("Formation/Bureautique/excel_expert.html.twig");
    }

    #[Route("/bureautique/excel-macros-vba", name: "app_bureautiques_excel_macros_vba")]
    function excelMacrosVba()
    {
        return $this->render("Formation/Bureautique/excel_macros_vba.html.twig");
    }

    // Débutants
    #[Route("/debutants/windows", name: "app_debutants_windows")]
    function windows()
    {
        return $this->render("Formation/Debutants/windows.html.twig");
    }

    #[Route("/debutants/digital-citizen", name: "app_debutants_digital_citizen")]
    function digitalCitizen()
    {
        return $this->render("Formation/Debutants/digital_citizen.html.twig");
    }

    // Gestion de données
    #[Route("/gestion-donnees/excel-tcd", name: "app_gestion_donnees_excel_tcd")]
    function excelTcd()
    {
        return $this->render("Formation/GestionDeDonnees/excel_tcd.html.twig");
    }

    #[Route("/gestion-donnees/excel-power-query1", name: "app_gestion_donnees_excel_power_query1")]
    function excelPowerQuery1()
    {
        return $this->render("Formation/GestionDeDonnees/excel_power_query1.html.twig");
    }

    #[Route("/gestion-donnees/excel-power-pivot", name: "app_gestion_donnees_excel_power_pivot")]
    function excelPowerPivot()
    {
        return $this->render("Formation/GestionDeDonnees/excel_power_pivot.html.twig");
    }

    #[Route("/gestion-donnees/powerbi", name: "app_gestion_donnees_powerbi")]
    function powerBi()
    {
        return $this->render("Formation/GestionDeDonnees/powerbi.html.twig");
    }

    #[Route("/gestion-donnees/access-base", name: "app_gestion_donnees_access_base")]
    function accessBase()
    {
        return $this->render("Formation/GestionDeDonnees/access_base.html.twig");
    }

    #[Route("/gestion-donnees/access-perfectionnement", name: "app_gestion_donnees_access_perfectionnement")]
    function accessPerfectionnement()
    {
        return $this->render("Formation/GestionDeDonnees/access_perfectionnement.html.twig");
    }

    // Logiciels
    #[Route("/logiciels/gestion-commerciale", name: "app_logiciels_gestion_commerciale")]
    function gestionCommerciale()
    {
        return $this->render("Formation/Logiciels/gestion_commerciale.html.twig");
    }

    #[Route("/logiciels/comptabilite", name: "app_logiciels_comptabilite")]
    function comptabilite()
    {
        return $this->render("Formation/Logiciels/comptabilite.html.twig");
    }
}