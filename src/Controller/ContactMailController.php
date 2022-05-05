<?php

namespace App\Controller;

use App\Entity\ContactMail;
use App\Form\ContactMailType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactMailController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contactIndex(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $mail = new ContactMail();
        $form = $this->createForm(ContactMailType::class, $mail);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($mail);
            $em->flush();

            $email = (new TemplatedEmail())
            ->from('onverra@gmail.com')
            ->to('onverra@gmail.com')
            ->subject($mail->getSubject())
            ->htmlTemplate('contact_mail/mail.html.twig')
            ->context([ 'contact' => $mail ]);
            $mailer->send($email);

            $form = $this->createForm(ContactMailType::class);
        } 
        return $this->render('contact_mail/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
