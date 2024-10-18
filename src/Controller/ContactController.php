<?php
// src/Controller/ContactController.php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class ContactController extends AbstractController
{
    private $logger;
    private $params;

    public function __construct(LoggerInterface $logger, ParameterBagInterface $params)
    {
        $this->logger = $logger;
        $this->params = $params;
    }

    #[Route("/contact", name: "app_contact", methods: ["GET", "POST"])]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createFormBuilder()
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('entreprise', TextType::class)
            ->add('email', EmailType::class)
            ->add('telephone', TelType::class)
            ->add('demande', TextareaType::class)
            ->add('recaptcha', ReCaptchaType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $email = (new TemplatedEmail())
                        ->from($this->params->get('app.sender_mail'))
                        ->to($this->params->get('app.contact_mail'))
                        ->subject('Nouvelle demande de contact')
                        ->htmlTemplate('emails/contact.html.twig')
                        ->context(['form' => $data]);

                    $mailer->send($email);

                    if ($request->isXmlHttpRequest()) {
                        return new JsonResponse(['status' => 'success', 'message' => 'Votre message a été envoyé avec succès.']);
                    }

                    $this->addFlash('success', 'Votre message a été envoyé avec succès.');
                    return $this->redirectToRoute('app_contact');
                } catch (\Exception $e) {
                    $this->logger->error('Error sending email: ' . $e->getMessage());

                    if ($request->isXmlHttpRequest()) {
                        return new JsonResponse(['status' => 'error', 'message' => 'Une erreur est survenue lors de l\'envoi du message.'], 500);
                    }

                    $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi du message.');
                }
            } else {
                if ($request->isXmlHttpRequest()) {
                    $errors = [];
                    foreach ($form->getErrors(true) as $error) {
                        $errors[] = $error->getMessage();
                    }
                    return new JsonResponse([
                        'status' => 'error',
                        'message' => 'Le formulaire contient des erreurs.',
                        'errors' => $errors
                    ], 400);
                }
            }
        }

        return $this->render("Default/contact.html.twig", [
            'form' => $form->createView(),
        ]);
    }
}