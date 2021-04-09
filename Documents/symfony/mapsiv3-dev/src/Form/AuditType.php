<?php

namespace App\Form;

use App\Entity\Audit;
use App\Entity\RgpdAudit;
use App\Entity\RgpdViolation;
use App\Entity\RgpdAccess;
use App\Entity\People;
use App\Entity\Flux;
use App\Entity\Processus;
use App\Entity\Site;
use App\Entity\Action;
use App\Entity\TypeAudit;
use App\Entity\Tier;
use App\Entity\TypeConformite;

use App\Repository\PeopleRepository;
use App\Repository\FluxRepository;
use App\Repository\ActionRepository;
use App\Repository\TypeStatutRepository;
use App\Repository\TierRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\ProcessusRepository;
use App\Repository\SiteRepository;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AuditType extends AbstractType
{
    public function __construct(PeopleRepository $PeopleRepository,
								FluxRepository $FluxRepository,
								TierRepository $TierRepository,
								ActionRepository $ActionRepository,
                                TypeStatutRepository $TypeStatutRepository,
                                TypeConformiteRepository $TypeConformiteRepository,
                                ProcessusRepository $ProcessusRepository,
                                SiteRepository $SiteRepository
	 						 	)
    {
        $this->PeopleRepository = $PeopleRepository;
        $this->FluxRepository = $FluxRepository;
        $this->ActionRepository = $ActionRepository;
        $this->TypeStatutRepository = $TypeStatutRepository;
        $this->TierRepository = $TierRepository;
        $this->ProcessusRepository = $ProcessusRepository;
        $this->SiteRepository = $SiteRepository;
        $this->TypeConformiteRepository = $TypeConformiteRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description')
            ->add('auditeur')
            ->add('organisme')
            ->add('progres')
            ->add('PreparedAt', DateType::class, [
                'widget' => 'single_text'
                ])
            ->add('StartedAt', DateType::class, [
                'widget' => 'single_text'
                ])
            ->add('FinishedAt', DateType::class, [
                'widget' => 'single_text'
                ])
            ->add('resultat')
            ->add('resultatlight')
            ->add('commentaire')

            ->add('typeaudit', EntityType::class, [
                'placeholder' => 'Sélectionner le type d\'audit',
                'class' => TypeAudit::class,
                'required'   => false,
                'choice_label' => 'designation'
                ])

            ->add('responsable', EntityType::class, [
            'placeholder' => 'Sélectionner le suppleant',
            'class' => People::class,
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
                return $people->getFirstname() . ' ' . $people->getLastname();
                }
            ])
            ->add('suppleant', EntityType::class, [
                'placeholder' => 'Sélectionner le suppleant',
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
            'placeholder' => 'Sélectionner',
            'required'   => false,
            'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
            'choice_label' => function (People $people) {
                return $people->getFirstname() . ' ' . $people->getLastname();
                }
            ])
            ->add('actions', EntityType::class, [
            'class' => Action::class,
            'multiple' => 'true',
            'placeholder' => 'Sélectionner',
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
            ->add('traitements', EntityType::class, [
                'class' => Flux::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Choose an option',
                'required'   => false,
                'choices' => $this->FluxRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (Flux $flux) {
                    return 'F-'.$flux->getId() . ' ' . $flux->getDesignation();
                    }
                ])
            ->add('processuses', EntityType::class, [
                'class' => Processus::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Choose an option',
                'required'   => false,
                'choices' => $this->ProcessusRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (Processus $processus) {
                    return 'P-'.$processus->getId() . ' ' . $processus->getDesignation();
                    }
                ])
            ->add('sites', EntityType::class, [
                'class' => Site::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Choose an option',
                'required'   => false,
                'choices' => $this->SiteRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (Site $site) {
                    return 'S-'.$site->getId() . ' ' . $site->getDesignation();
                    }
                ])
            ->add('tiers', EntityType::class, [
                'class' => Tier::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Choose an option',
                'required'   => false,
                'choices' => $this->TierRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (Tier $tier) {
                    return 'T-'.$tier->getId() . ' ' . $tier->getDesignation();
                    }
            ])
            ->add('typeconformite', EntityType::class, [
                'class' => TypeConformite::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'choices' => $this->TypeConformiteRepository->findByCustomer($options['userCustomer']),
                ])
            ->add('nonconformites', CollectionType::class, [
                'entry_type' => NonConformiteType::class,
                'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'delete_empty' => true,
                'attr' => [
                        'class' => "nonconformites",
                    ],
                'by_reference' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Audit::class,
            'userCustomer' => null,
            'userPeople' => null
        ]);
    }
}
