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
            ->add('entreprise', TextType::class, [
                'required' => false
            ])
            ->add('email', EmailType::class)
            ->add('telephone', TelType::class)
            ->add('demande', TextareaType::class)
            ->add('recaptcha', ReCaptchaType::class)
            ->getForm();

        $message = null;
        $status = 'error';

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                try {
                    $email = (new TemplatedEmail())
                        ->from($this->params->get('app.sender_mail'))
                        ->to($this->params->get('app.contact_mail'))
                        ->subject('Contact')
                        ->htmlTemplate('emails/contact.html.twig')
                        ->context(['form' => $data]);

                    $mailer->send($email);

                    $message = 'Votre message a été envoyé avec succès.';
                    $status = 'success';
                } catch (\Exception $e) {
                    $this->logger->error('Error sending email: ' . $e->getMessage());
                    $message = 'Une erreur est survenue lors de l\'envoi du message.';
                }
            } else {
                $message = 'Le formulaire contient des erreurs.';
            }
        }

        $renderedForm = $this->renderView("Default/contact.html.twig", [
            'form' => $form->createView(),
            'message' => $message ? ['type' => $status, 'message' => $message] : null,
        ]);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'status' => $status,
                'message' => $message,
                'formHtml' => $renderedForm
            ]);
        }

        return new Response($renderedForm);
    }
}