<?php


namespace App\Form;


use App\Entity\Subject;
use App\Entity\Team;
use App\Entity\User;
use App\Model\Search\TeamSearch;
use App\Service\Team\SearchProvider;
use Doctrine\ORM\EntityRepository;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class SubjectType extends AbstractType
{
    private SearchProvider $provider;

    public function __construct(SearchProvider $provider){
        $this->provider=$provider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('team',EntityType::class, [
                'class'=>Team::class,
                'label'=>'Classe : ',
                'choices' => $this->provider->getTeams(new TeamSearch()),
                'choice_label'=> function ($team) { return $team->getName(); },
                'choice_value'=> function ($entity = null) {return $entity ? $entity->getId() : ''; },

            ])
            ->add('title', TextType::class,array('label'=>'Titre du TP : '))
            ->add('number_values', NumberType::class,array('label'=>'Nombre de valeurs expérimentales : '))
            ->add('comment', TextType::class,array('label'=>'Consignes / Commentaire : '))
            ->add('document_file', FileType::class,array('label'=>'Sujet de TP (PDF) : '));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Subject::class,
        ]);
    }

}