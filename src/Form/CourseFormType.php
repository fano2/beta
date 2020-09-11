<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Entraineur;
use App\Entity\Horse;
use App\Entity\Jockey;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CourseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('distance', IntegerType::class)
            ->add('numero', IntegerType::class)
            ->add('gains')
            ->add('cote')
            ->add('date')
            ->add('entraineur',EntityType::class,[
                'class' => Entraineur::class,
                'choice_label' => 'entraineurName',
            ])
            ->add('horse',EntityType::class,[
                'class' => Horse::class,
                'choice_label' => 'horseName',
            ])
            ->add('jockey',EntityType::class,[
                'class' => Jockey::class,
                'choice_label' => 'jockeyName',
            ])
            ->add('submit', SubmitType::class, [ 'label'=> 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
