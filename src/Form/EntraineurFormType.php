<?php

namespace App\Form;

use App\Entity\Entraineur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  

class EntraineurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entraineurName')
            ->add('EntraineurAge')
            ->add('entraineurSexe')
            ->add('submit', SubmitType::class, [ 'label'=> 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entraineur::class,
        ]);
    }
}
