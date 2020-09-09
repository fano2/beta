<?php

namespace App\Form;

use App\Entity\Specialiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SpecialisteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('specialisteName')
            ->add('specialisteAge')
            ->add('job')
            ->add('submit', SubmitType::class, [ 'label'=> 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Specialiste::class,
        ]);
    }
}
