<?php

namespace App\Controller;

use App\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            $message = (new \Swift_Message('Contact Form!'))
               ->setFrom($contactFormData['email'])
               ->setTo('marincomics@gmail.com')
               ->setBody(
                   $contactFormData['message'],
                   'text/plain'
               );

           $mailer->send($message);

           $this->addFlash('success', 'Thank you for your message. It has been sent successfully!');

           return $this->redirectToRoute('contact');
        }

        $currentshoppingcart = NULL;
        return $this->render('contact/index.html.twig', [
            'contactform' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }
}