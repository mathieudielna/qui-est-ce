<?php

namespace App\Form;

use App\Entity\Objectif;
use App\Entity\ObjectifIndicateur;
use App\Entity\People;
use App\Entity\TypeConformite;
use App\Entity\Processus;

use App\Repository\PeopleRepository;
use App\Repository\ObjectifIndicateurRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\ProcessusRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ObjectifType extends AbstractType
{
     public function __construct(PeopleRepository $PeopleRepository,
                                TypeConformiteRepository $typeConformiteRepository,
                                ProcessusRepository $ProcessusRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->TypeConformiteRepository = $typeConformiteRepository;
        $this->ProcessusRepository = $ProcessusRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('designation', TextType::class, [
            'attr' => array(
                'placeholder' => 'Objectif'
            )
            ])
            ->add('description', null, [
                'attr' => array(
                    'placeholder' => 'Rédiger une description courte de l\'objectif',
                    'class' => 'fiche'
                )
                ])
            ->add('commentaire')
            ->add('valeurcible', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Valeur cible'
                )
                ])
            ->add('type', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Unité'
                )
                ])
            ->add('indicateurs', CollectionType::class, [
                'entry_type' => ObjectifIndicateurType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'delete_empty' => true,
                'attr' => [
                       'class' => "objectifindicateurs",
                   ],
                'by_reference' => false,
            ])
            ->add('responsable', EntityType::class, [
                'placeholder' => 'Responsable',
                'class' => People::class,
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
            ])
            ->add('suppleant', EntityType::class, [
                'placeholder' => 'Suppleant',
                'class' => People::class,
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
            ->add('peoples', EntityType::class, [
                'class' => People::class,
                'multiple' => 'true',
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
            ->add('typeconformites', EntityType::class, [
                'class' => TypeConformite::class,
                'multiple' => 'true',
                'choices' => $this->TypeConformiteRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (TypeConformite $tc) {
                    return $tc->getDesignation();
                    }
                ])
            ->add('processus', EntityType::class, [
                'class' => Processus::class,
                'placeholder' => 'Processus',
                'required'   => true,
                'choices' => $this->ProcessusRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (Processus $processus) {
                    return 'P-'.$processus->getId() . ' ' . $processus->getDesignation();
                    }
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Objectif::class,
            'userCustomer' => null,
            'userPeople' => null
        ]);
    }
}
