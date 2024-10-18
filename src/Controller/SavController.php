<?php
// src/Controller/ContactController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SavController extends AbstractController
{
    #[Route("/sav", name: "app_sav")]
    public function index(): Response
    {
        return $this->render("Default/sav.html.twig");
    }

    #[Route("/submit-sav", name: "submit_sav", methods: ["POST"])]
    public function submitContact(Request $request, MailerInterface $mailer): Response
    {
        $data = json_decode($request->getContent(), true);

        // Validation côté serveur
        if (!$this->validateData($data)) {
            return $this->json(['message' => 'Données invalides'], Response::HTTP_BAD_REQUEST);
        }

        // Email à maximevery@ryveweb.fr
        $emailToAdmin = (new Email())
            ->from('formulaire@ryveweb.fr')
            ->to('maximevery@ryveweb.fr')
            ->subject($data['subject'] . ' - ' . $data['name'])
            ->text($this->renderView('emails/contact.txt.twig', $data))
            ->html($this->renderView('emails/contact.html.twig', $data));

        // Email de confirmation à l'expéditeur
        $emailToSender = (new Email())
            ->from('formulaire@ryveweb.fr')
            ->to($data['email'])
            ->subject('Confirmation de votre message - ' . $data['subject'])
            ->text($this->renderView('emails/confirmation.txt.twig', $data))
            ->html($this->renderView('emails/confirmation.html.twig', $data));

        try {
            $mailer->send($emailToAdmin);
            $mailer->send($emailToSender);
            return $this->json(['message' => 'Message envoyé avec succès. Un email de confirmation vous a été envoyé.']);
        } catch (\Exception $e) {
            return $this->json(['message' => 'Erreur lors de l\'envoi du message'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function validateData(array $data): bool
    {
        $requiredFields = ['name', 'email', 'subject', 'message'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (!empty($data['phone']) && !preg_match('/^[0-9]{10}$/', $data['phone'])) {
            return false;
        }

        return true;
    }
}