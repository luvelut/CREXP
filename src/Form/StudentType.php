<?php


namespace App\Form;


use App\Entity\Student;
use App\Entity\Team;
use App\Model\Search\TeamSearch;
use App\Service\Team\SearchProvider;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType

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
            ->add('name', TextType::class, array('label'=>'Nom : '));

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }

}