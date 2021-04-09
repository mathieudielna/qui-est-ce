<?php
namespace App\Form;

use App\Entity\Activite;
use App\Entity\TypeAppli;
use App\Entity\People;
use App\Entity\Application;
use App\Entity\Tier;
use App\Entity\Ressource;
use App\Entity\Flux;
use App\Entity\Criticite;
use App\Entity\OuiNon;
use App\Entity\Processus;
use App\Entity\NiveauImpact;
use App\Entity\User;
use App\Entity\TypeActivite;

use App\Repository\PeopleRepository;
use App\Repository\ProcessusRepository;
use App\Repository\FluxRepository;
use App\Repository\ApplicationRepository;
use App\Repository\TierRepository;
use App\Repository\RessourceRepository;
use App\Repository\OuiNonRepository;
use App\Repository\CriticiteRepository;
use App\Repository\NiveauImpactRepository;
use App\Repository\ActiviteRepository;
use App\Repository\TypeActiviteRepository;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ActiviteType extends AbstractType
{
	 public function __construct(ActiviteRepository $ActiviteRepository,
	 							 PeopleRepository $PeopleRepository, 
	 							 ProcessusRepository $ProcessusRepository, 
	 							 FluxRepository $FluxRepository, 
	 							 ApplicationRepository $ApplicationRepository, 
	 							 TierRepository $TierRepository, 
	 							 RessourceRepository $RessourceRepository, 
	 							 OuiNonRepository $OuiNonRepository, 
	 							 CriticiteRepository $CriticiteRepository,
	 							 NiveauImpactRepository $NiveauImpactRepository,
	 							 TypeActiviteRepository $TypeActiviteRepository
	 							 )
    {
        $this->ActiviteRepository = $ActiviteRepository;
        $this->PeopleRepository = $PeopleRepository;
        $this->ProcessusRepository = $ProcessusRepository;
        $this->FluxRepository = $FluxRepository;
        $this->ApplicationRepository = $ApplicationRepository;
        $this->TierRepository = $TierRepository;
        $this->RessourceRepository = $RessourceRepository;
        $this->OuiNonRepository = $OuiNonRepository;
        $this->CriticiteRepository = $CriticiteRepository;
        $this->NiveauImpactRepository = $NiveauImpactRepository;
        $this->TypeActiviteRepository = $TypeActiviteRepository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('responsable', EntityType::class, [
                'class' => People::class,
                'placeholder' => 'Responsable',
                'required'   => false,
                'choices' => $this->PeopleRepository->findByCustomer($options['userCustomer']),
                'choice_label' => function (People $people) {
                    return $people->getFirstname() . ' ' . $people->getLastname();
                    },
                ])
            ;
                
        $builder
            ->add('designation', null, [
                'attr' => array(
                    'placeholder' => 'Désignation',
                    'class' => 'fiche'
                )
            ])
            ->add('fluxConnectActivites', CollectionType::class, [
            'entry_type' => FluxConnectActiviteType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'attr' => [
                   'class' => "fluxConnectActivites",
               ],
            'by_reference' => false,
			])
			->add('appConnectActivites', CollectionType::class, [
            'entry_type' => AppConnectActiviteType::class,
            'entry_options' => ['label' => false, 'userCustomer' => $options['userCustomer']],
            'allow_add' => true,
            'allow_delete' => true,
			'prototype' => true,
			'attr' => [
                   'class' => "appConnectActivites",
               ],
            'by_reference' => false,
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

			->add('description', null, [
                'attr' => array(
                    'placeholder' => 'Rédiger une courte description de l\'activité',
                    'class' => 'fiche'
                )
            ])
			->add('commentaire')
			
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
            ->add('dima1', EntityType::class, [
            'class' => Criticite::class,
            'placeholder' => 'DIMA',
            'choice_label' => 'designation',
            'required'   => false,
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
            ->add('pdma1', EntityType::class, [
            'class' => Criticite::class,
            'placeholder' => 'PDMA',
            'choice_label' => 'designation',
            'required'   => false,
			'choices' => $this->CriticiteRepository->findByCustomer($options['userCustomer']),
			])
            ->add('periodepic', null, [
                'attr' => array(
                    'placeholder' => 'Périodes de pic',
                    'class' => 'fiche'
                )
            ])
            ->add('pca', EntityType::class, [
            'class' => OuiNon::class,
            'placeholder' => 'PCA',
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
            ->add('niveaureprise', null, [
                'attr' => array(
                    'placeholder' => 'Niveau de reprise'
                )
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
			 ->add('tiers', EntityType::class, [
            'class' => Tier::class,
            'choice_label' => 'designation',
			'multiple' => 'true',
			'placeholder' => 'Tiers',
			'required'   => false,
			'choices' => $this->TierRepository->findByCustomer($options['userCustomer']),
			'choice_label' => function (Tier $tier) {
				return 'T-'.$tier->getId() . ' ' . $tier->getDesignation();
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
			->add('perteca', null, [
                'attr' => array(
                    'placeholder' => 'Perte de CA'
                )
            ])
			->add('perteactivite', null, [
                'attr' => array(
                    'placeholder' => 'Perte d\'activité',
                    'class' => 'fiche'
                )
            ])
			->add('impactimg', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'placeholder' => 'Impact image',
            'expanded' => false,
            'required'   => false,
			'empty_data' => 'Non défini',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impactactionnaire', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'placeholder' => 'Impact partenaire et actionnaire',
            'expanded' => false,
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impactinterne', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'placeholder' => 'Impact en interne',
            'expanded' => false,
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impactcollaborateur', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'placeholder' => 'Impact collaborateurs',
            'expanded' => false,
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('activitebusinessfutur', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'placeholder' => 'Impact opportunités commerciales',
            'expanded' => false,
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impact4h', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => '4 heures',
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impact1j', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => '1 jour',
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impact3j', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'placeholder' => '3 jours',
            'required'   => false,
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impact1s', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => '1 semaine',
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impact2s', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => '2 semaines',
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
			])
			->add('impact1m', EntityType::class, [
            'class' => NiveauImpact::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => '1 mois',
			'empty_data' => '0',
			'choices' => $this->NiveauImpactRepository->findByCustomer($options['userCustomer']),
            ])
            ->add('perturbationinterne', null, [
                'attr' => array(
                    'placeholder' => 'Détailler les perturbations internes',
                    'class' => 'fiche'
                )
            ])
			->add('perturbationexterne', null, [
                'attr' => array(
                    'placeholder' => 'Détailler les perturbations externes',
                    'class' => 'fiche'
                )
            ])
            ->add('procedurepca', EntityType::class, [
            'class' => OuiNon::class,
            'choice_label' => 'designation',
            'expanded' => false,
            'required'   => false,
            'placeholder' => 'Procédure PCA',
			'empty_data' => '0',
			'choices' => $this->OuiNonRepository->findByCustomer($options['userCustomer']),
			])
			->add('latencepca', null, [
                'attr' => array(
                    'placeholder' => 'Délais de démarrage',
                    'class' => 'fiche'
                )
            ])
			->add('traitementimmediat', null, [
                'attr' => array(
                    'placeholder' => 'Traitement immédiat',
                    'class' => 'fiche'
                )
            ])
			->add('conditionmaintien', null, [
                'attr' => array(
                    'placeholder' => 'Conditions au maintien',
                    'class' => 'fiche'
                )
            ])				
			;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activite::class,
            'userCustomer' => null,
            'userPeople' => null,
        ]);
    }
}



