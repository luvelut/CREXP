<?php


namespace App\Form\Search;


use App\Model\Search\ExerciseSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>false,
                'required'=>false,
                'attr'=> [
                    'placeholder' => 'Rechercher'
                ]
            ])
            ->add('isCheck',CheckboxType::class,[
                'label'=>'Voir seulement les exercices à faire',
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>ExerciseSearch::class
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}