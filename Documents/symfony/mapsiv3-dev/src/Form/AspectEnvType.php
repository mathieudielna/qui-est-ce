<?php

namespace App\Form;

use App\Entity\AspectEnv;
use App\Entity\Audit;
use App\Entity\RgpdAudit;
use App\Entity\RgpdViolation;
use App\Entity\RgpdAccess;
use App\Entity\People;
use App\Entity\Flux;
use App\Entity\Activite;
use App\Entity\Site;
use App\Entity\Action;
use App\Entity\Impact;
use App\Entity\TypeAudit;
use App\Entity\Tier;
use App\Entity\TypeAspectEnv;

use App\Repository\PeopleRepository;
use App\Repository\FluxRepository;
use App\Repository\ActionRepository;
use App\Repository\TypeStatutRepository;
use App\Repository\TierRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\ActiviteRepository;
use App\Repository\SiteRepository;
use App\Repository\TypeAspectEnvRepository;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class AspectEnvType extends AbstractType
{
    public function __construct(PeopleRepository $PeopleRepository,
								FluxRepository $FluxRepository,
								TierRepository $TierRepository,
								ActionRepository $ActionRepository,
                                TypeStatutRepository $TypeStatutRepository,
                                TypeConformiteRepository $TypeConformiteRepository,
                                ActiviteRepository $ActiviteRepository,
                                SiteRepository $SiteRepository
	 						 	)
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->FluxRepository = $FluxRepository;
        $this->ActionRepository = $ActionRepository;
        $this->TypeStatutRepository = $TypeStatutRepository;
        $this->TierRepository = $TierRepository;
        $this->ActiviteRepository = $ActiviteRepository;
        $this->SiteRepository = $SiteRepository;
        $this->TypeConformiteRepository = $TypeConformiteRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description', null, [
                'attr' => array(
                    'placeholder' => 'Rédiger une description de l\'aspect environnemental significatif',
                    'class' => 'fiche'
                )
            ])
            ->add('commentaire', null, [
                'attr' => array(
                    'placeholder' => '',
                    'class' => 'fiche'
                )
            ])
            ->add('criticite', TextType::class, array(
                'attr' => array(
                    'readonly' => true,
                ),
            ))
            ->add('typeaspectenv', EntityType::class, [
                'class' => TypeAspectEnv::class,
                'choice_label' => 'designation',
                'expanded' => false,
                'required'   => false,
                'placeholder' => 'Sélectionner',
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
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Contributeurs',
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    }
                ])
            ->add('Actions', EntityType::class, [
                'class' => Action::class,
                'multiple' => 'true',
                'placeholder' => 'Actions',
                'required'   => false,
                'by_reference' => false,
                'choices' => $this->ActionRepository->findBy([
                    'customer' => $options['userCustomer'],
                    'archive' => null
                ]),
                'choice_label' => function (Action $action) {
                    return 'AC-'.$action->getId() . ' ' . $action->getDesignation();
                    }
                ])
            ->add('activites', EntityType::class, [
                'class' => Activite::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Activités',
                'required'   => false,
                'choices' => $this->ActiviteRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (Activite $activite) {
                    return 'AC-'.$activite->getId() . ' ' . $activite->getDesignation();
                    }
                ])
            ->add('impacts', CollectionType::class, [
                'entry_type' => ImpactType::class,
                'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'delete_empty' => true,
                'attr' => [
                        'class' => "impacts",
                    ],
                'by_reference' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AspectEnv::class,
            'userCustomer' => null,
            'userPeople' => null
        ]);
    }
}
