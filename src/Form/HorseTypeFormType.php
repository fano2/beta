<?php

namespace App\Form;

use App\Entity\Horse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorseTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('horseName')
            ->add('sexe')
            ->add('courseResume')
            ->add('age')
            ->add('proprietaire')
            ->add('submit', SubmitType::class, [ 'label'=> 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horse::class,
        ]);
    }
}
