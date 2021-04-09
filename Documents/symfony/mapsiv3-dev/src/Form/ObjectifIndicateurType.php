<?php

namespace App\Form;

use App\Entity\ObjectifIndicateur;
use App\Entity\Objectif;
use App\Repository\ObjectifRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;

class ObjectifIndicateurType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valeur')
            ->add('PublishedAt', DateType::class, [
			    'widget' => 'single_text',
			    'required'   => true,
                ])
            ->add('objectif', EntityType::class, [
                'class' => Objectif::class,
                'choice_label' => 'designation',
                'required'   => false,
                'placeholder' => 'Sélectionner un objectif',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ObjectifIndicateur::class,
            'userCustomer' => null,
        ]);
    }
}
