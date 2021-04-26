<?php


namespace App\Listener;


use App\Entity\Exercise;
use Doctrine\Persistence\Event\LifecycleEventArgs;


class ExerciseListener
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer=$mailer;
    }

    public function postUpdate(Exercise $exercise,LifecycleEventArgs $event){


        //On envoie le mail si le changement est : changement de 'state'
        $changeArray = $event->getEntityManager()->getUnitOfWork()->getEntityChangeSet($event->getObject());
        if($changeArray['state'][0]===Exercise::ATTENTE && $changeArray['state'][1]===Exercise::OK_ELEVE){

            $message = (new \Swift_Message('Compte-rendu à valider'))
                // On attribue l'expéditeur
                ->setFrom('appli.compte.rendu@gmail.com')

                // On attribue le destinataire
                //->setTo('christophevelut@wanadoo.fr')

                ->setTo('applicompterendu@gmail.com')

                // On crée le texte avec la vue
                ->setBody('Un nouveau compte rendu est en ligne ! Rendez vous sur le site pour le valider.');

            $this->mailer->send($message);

        }
    }

}