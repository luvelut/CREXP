<?php


namespace App\Form;


use App\Entity\Exercise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        for($i = 0; $i < $options['label']; $i++){
            dump('on créer un champ');
            $builder->add('response', TextType::class, ['label' => 'Valeurs : ']);
        }
        /*
        $builder
            ->add('response', TextType::class, ['label' => 'Valeurs : ']);*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }

}