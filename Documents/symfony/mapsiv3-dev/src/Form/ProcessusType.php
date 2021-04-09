<?php

namespace App\Form;

use App\Entity\Processus;
use App\Entity\Activite;
use App\Entity\TypeProcessus;
use App\Entity\People;
use App\Entity\Metier;
use App\Entity\Objectif;
use App\Entity\Action;
use App\Entity\Risque;

use App\Repository\PeopleRepository;
use App\Repository\MetierRepository;
use App\Repository\ActiviteRepository;
use App\Repository\TypeProcessusRepository;
use App\Repository\ActionRepository;
use App\Repository\RisqueRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProcessusType extends AbstractType
{

	 public function __construct(PeopleRepository $PeopleRepository, 
	 								MetierRepository $MetierRepository, 
	 								ActiviteRepository $ActiviteRepository, 
	 								TypeProcessusRepository $TypeProcessusRepository,
	 								RisqueRepository $RisqueRepository,
	 								ActionRepository $ActionRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->MetierRepository = $MetierRepository;
        $this->ActiviteRepository = $ActiviteRepository;
        $this->ActionRepository = $ActionRepository;
        $this->TypeProcessusRepository = $TypeProcessusRepository;
        $this->RisqueRepository = $RisqueRepository;
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('designation', null, [
            'attr' => ['class' => 'title-input','placeholder' => 'Désignation'],
            ])
            ->add('description', null, [
                'attr' => array(
                    'placeholder' => 'Rédiger une description courte du processus',
                    'class' => 'fiche'
                )
                ])
            ->add('commentaire')
            ->add('code', TextType::class, [
                'attr' => ['class' => 'title-input','placeholder' => 'Code'],
                ])
            ->add('finalite', null, [
                'attr' => array(
                    'placeholder' => 'Quelle est la finalité du processus ?',
                    'class' => 'fiche'
                )
                ])
            ->add('objectifs', CollectionType::class, [
            'entry_type' => ObjectifType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'delete_empty' => true,
			'attr' => [
                   'class' => "objectifs",
               ],
            'by_reference' => false,
			])
            ->add('pilotage', null, [
                'attr' => array(
                    'placeholder' => 'Décrivez les modes de pilotage du processus',
                    'class' => 'fiche'
                )
                ])
            ->add('responsable', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Responsable',
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
                return $people->getFirstname() . ' ' . $people->getLastname();
                },
            ])
            ->add('suppleant', EntityType::class, [
            'class' => People::class,
            'placeholder' => 'Suppléant',
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
				return $people->getFirstname() . ' ' . $people->getLastname();
				}
            ])
            ->add('redacteur', EntityType::class, [
				'class' => People::class,
				'placeholder' => 'Rédacteur',
				'required'   => true,
				'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
				'choice_label' => function (People $people) {
					return $people->getFirstname() . ' ' . $people->getLastname();
					}
				])
            ->add('peoples', EntityType::class, [
                'class' => People::class,
                'multiple' => 'true',
                'placeholder' => 'Contributeurs',
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
            ])
			->add('metier', EntityType::class, [
            'class' => Metier::class,
            'placeholder' => 'Quel est le métier pilote ?',
            'required'   => false,
            'choice_label' => 'designation',
            'choices' => $this->MetierRepository->findByCustomer($options['userCustomer']),
			])
            ->add('activites', EntityType::class, [
            'class' => Activite::class,
			'multiple' => 'true',
			'placeholder' => 'Quelles sont les activités du processus ?',
			'required'   => false,
            'by_reference' => false,
            'choices' => $this->ActiviteRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Activite $activite) {
				return 'A'.$activite->getID() . ' ' . $activite->getDesignation();
				}
			])
			->add('actions', EntityType::class, [
            'class' => Action::class,
			'multiple' => 'true',
			'placeholder' => 'Quelles sont les actions associées à ce processus ?',
			'required'   => false,
            'by_reference' => false,
            'choices' => $this->ActionRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Action $action) {
				return 'ACT'.$action->getID() . ' ' . $action->getDesignation();
				}
			])
			->add('risques', EntityType::class, [
            'class' => Risque::class,
			'multiple' => 'true',
			'placeholder' => 'Quels sont les risques du processus ?',
			'required'   => false,
            'by_reference' => false,
            'choices' => $this->RisqueRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (Risque $risque) {
				return 'RI'.$risque->getID() . ' ' . $risque->getDesignation();
				}
			])
			->add('typeprocessus', EntityType::class, [
            'class' => TypeProcessus::class,
            'choice_label' => 'designation',
            'placeholder' => 'Quel type de processus ?',
            'expanded' => false,
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->TypeProcessusRepository->findByCustomer($options['userCustomer']),
			])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Processus::class,
            'userCustomer' => null,
            'userPeople' => null
        ]);
    }
}
