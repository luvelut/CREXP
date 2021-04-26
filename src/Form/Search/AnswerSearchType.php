<?php


namespace App\Form\Search;


use App\Model\Search\ExerciseSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>false,
                'required'=>false,
                'attr'=> [
                    'placeholder' => 'Rechercher par titre'
                ]
            ])
        ->add('isCheck',CheckboxType::class,[
            'label'=>'Voir uniquement les comptes-rendus à valider',
            'required' => false,
        ]);
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