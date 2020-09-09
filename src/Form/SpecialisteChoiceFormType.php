<?php

namespace App\Form;

use App\Entity\SpecialisteChoice;
use App\Entity\Course;
use App\Entity\Specialiste;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\ChoiceList\ChoiceList;

class SpecialisteChoiceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $date = $options['date']
        $builder
            ->add('course', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'numero',
                // 'query_builder' => function (EntityRepository $er) use ($date){
                //     return $er->createQueryBuilder('course')
                //             ->andWhere('course.date= :date')
                //             ->setParameter('date', $date);
                // }
                
            ])
            ->add('specialiste', EntityType::class,[
                'class' => Specialiste::class,
                'choice_label' => 'specialisteName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SpecialisteChoice::class,
            'date' => null
        ]);
    }
}
