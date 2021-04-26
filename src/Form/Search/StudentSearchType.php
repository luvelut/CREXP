<?php


namespace App\Form\Search;


use App\Model\Search\StudentSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>false,
                'required'=>false,
                'attr'=> [
                    'placeholder' => 'Rechercher par nom'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>StudentSearch::class
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}