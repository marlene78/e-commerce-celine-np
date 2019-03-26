<?php
/**
 * Created by PhpStorm.
 * User: marlene
 * Date: 2019-03-17
 * Time: 08:35
 */

namespace App\Notifications;



use App\Entity\Contact;
use Swift_Mailer;
use Twig\Environment;

class ContactNotification
{


    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $environment;

    public function __construct(Swift_Mailer $mailer, Environment $environment)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public function  notify(Contact $contact)
    {
        $message = (new \Swift_Message('Sujet:'.' '.$contact->getSujet()))
                   ->setFrom('noreponse@celinenp.fr')
                   ->setTo('contact@marlenelingisi.fr')
                   ->setReplyTo($contact->getEmail())
                   ->setBody($this->environment->render('emails/contact.html.twig',[
                       'contact'=>$contact
                   ]), 'text/html');
        $this->mailer->send($message);
    }


}
