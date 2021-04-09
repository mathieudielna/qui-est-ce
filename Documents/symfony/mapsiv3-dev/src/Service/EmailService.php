<?php
namespace App\Service;
use Symfony\Component\Templating\EngineInterface;

class EmailService
{
    private $templating;

    public function __construct(EngineInterface $templating, \Swift_Mailer $mailer)
    {
        $this->templating = $templating;
        $this->mailer = $mailer;
    }

    public function sendEmail($prenom, $designation, $email, $etat, $slug, $id, $entite, $type, $customer, $domid)
    {
        $message = (new \Swift_Message('Mapsi > Un demande nécessite votre attention'))
            ->setFrom('nice.robot@app-mapsi.fr')
            ->setTo($email)
            ->setBody(
                $this->templating->render(
                    'email/mailaction.html.twig',
                    array(  'prenom' => $prenom, 
                            'designation' => $designation, 
                            'etat' => $etat,
                            'slug' => $slug,
                            'id' => $id,
                            'entite' => $entite,
                            'type' => $type,
                            'customer' => $customer,
                            'domid' => $domid,)
                ),
                'text/html'
            )
            ->setCharset('utf-8');

            $this->mailer->send($message);

        return true;
    }
}