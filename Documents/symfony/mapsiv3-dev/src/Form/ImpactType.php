<?php

namespace App\Form;

use App\Entity\Impact;
use App\Entity\TypeAspectEnv;
use App\Entity\TypeSituation;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ImpactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('designation')
            ->add('gravite')
            ->add('probabilite')
            ->add('sensibilite')
            ->add('maitrise')
            ->add('critere', TextType::class, array(
                'attr' => array(
                    'readonly' => true,
                ),
            ))
            ->add('criticite', TextType::class, array(
                'attr' => array(
                    'readonly' => true,
                ),
            ))
            ->add('typesituation', EntityType::class, [
                'class' => TypeSituation::class,
                'choice_label' => 'designation',
                'expanded' => false,
                'required'   => false,
                'placeholder' => 'Sélectionner',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Impact::class,
            'userCustomer' => null,
        ]);
    }
}


