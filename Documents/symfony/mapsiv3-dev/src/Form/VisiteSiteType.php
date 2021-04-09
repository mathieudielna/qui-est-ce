<?php

namespace App\Form;

use App\Entity\VisiteSite;
use App\Entity\Audit;
use App\Entity\RgpdAudit;
use App\Entity\RgpdViolation;
use App\Entity\RgpdAccess;
use App\Entity\People;
use App\Entity\Flux;
use App\Entity\Processus;
use App\Entity\Site;
use App\Entity\Action;
use App\Entity\Dysfonctionnement;
use App\Entity\TypeAudit;
use App\Entity\Tier;
use App\Entity\TypeConformite;
use App\Entity\Ressource;


use App\Repository\PeopleRepository;
use App\Repository\FluxRepository;
use App\Repository\ActionRepository;
use App\Repository\TypeStatutRepository;
use App\Repository\TierRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\ProcessusRepository;
use App\Repository\SiteRepository;
use App\Repository\RessourceRepository;
use App\Repository\DysfonctionnementRepository;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class VisiteSiteType extends AbstractType
{
    public function __construct(PeopleRepository $PeopleRepository,
								FluxRepository $FluxRepository,
								TierRepository $TierRepository,
								ActionRepository $ActionRepository,
                                TypeStatutRepository $TypeStatutRepository,
                                TypeConformiteRepository $TypeConformiteRepository,
                                ProcessusRepository $ProcessusRepository,
                                SiteRepository $SiteRepository,
                                RessourceRepository $RessourceRepository,
                                DysfonctionnementRepository $DysfonctionnementRepository
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
        $this->RessourceRepository = $RessourceRepository;
        $this->DysfonctionnementRepository = $DysfonctionnementRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('description', null, [
                'attr' => array(
                    'placeholder' => 'Rédiger une description de la visite',
                    'class' => 'fiche'
                )
            ])
            ->add('commentaire')
            
            ->add('responsable', EntityType::class, [
                'placeholder' => 'Responsable',
                'class' => People::class,
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                return $people->getFirstname() . ' ' . $people->getLastname();
                }
            ])
            ->add('ressources', EntityType::class, [
                'class' => Ressource::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Ressources',
                'required'   => false,
                'choices' => $this->RessourceRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (Ressource $ressource) {
                    return 'RES-'.$ressource->getId() . ' ' . $ressource->getDesignation();
                    }
                ])
                ->add('dysfonctionnements', EntityType::class, [
                    'class' => Dysfonctionnement::class,
                    'choice_label' => 'designation',
                    'multiple' => 'true',
                    'placeholder' => 'Dysfonctionnnements',
                    'required'   => false,
                    'choices' => $this->DysfonctionnementRepository->findByCustomer($options['userCustomer']),
                    'choice_label' => function (Dysfonctionnement $dysfonctionnement) {
                        return 'DYS-'.$dysfonctionnement->getId() . ' ' . $dysfonctionnement->getDesignation();
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
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                return $people->getFirstname() . ' ' . $people->getLastname();
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
            ->add('sites', EntityType::class, [
                'class' => Site::class,
                'choice_label' => 'designation',
                'multiple' => 'true',
                'placeholder' => 'Sélectionner',
                'required'   => false,
                'choices' => $this->SiteRepository->findByCustomer($options['userCustomer']),
                ])
                ->add('VisitedAt', DateType::class, [
                    'widget' => 'single_text',
                    'required'   => true,
                    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VisiteSite::class,
            'userCustomer' => null,
            'userPeople' => null
        ]);
    }
}
